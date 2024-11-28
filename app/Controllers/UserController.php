<?php
namespace App\Controllers;

class UserController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- FOR REDERING VIEWS AND CHECKING SESSIONS AND EXPIRATIONS ----- ##
    ## check sessions and redirect to views
    public function checkSessionThenRedirect($path, $isDisplaying = false){
        if($this->isAdmin()) {
            return redirect()->to('/admin/dashboard');
        }

        if(!$this->isUser()) {
            return redirect()->to('/');
        }
        
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession("user");
            return redirect()->to('/');
        }
        return $this->renderView($path, $isDisplaying);
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## render view 
    private function renderView($path, $isDisplaying, $data=null){
        $this->load->requireMethod('userAccount');
        $session_id = $this->load->session->get('user_id');
        if($isDisplaying) {    
            $data = [
                'userAccount' => $this->load->userAccount->getUser('user_id', $session_id),
                'message' => $data
            ];
            return view($path, $data);
        }
        return view($path); 
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- LOGOUT ----- ##
    ## logout method
    public function logout(){
        $this->load->requireMethod('userAccount');

        helper('cookie');
        
        $user_id = $this->load->session->get('user_id');
        if($user_id) {
            $this->load->userAccount->update($user_id, ['remember_token' => null]);
        }
        
        $this->load->session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- ROUTES ----- ##
    ## User Setting
    public function userSettings() {
        return $this->checkSessionThenRedirect('UserSide/userAccount', true);
    }
    ## User purchase history
    public function myPurchase() {
        return $this->checkSessionThenRedirect('UserSide/myPurchase', true);
    }
    ## User likes
    public function myLikes() {
        
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- Controller functions ----- ##
    public function updateAccount() {
        $this->load->requireMethod('userAccount');
        $data = [
            'userId' => $this->load->session->get('user_id'),
            'pfp' => $this->request->getFile('pfp'),
            'username' => $this->request->getPost('username'),
            'firstname' => $this->request->getPost('firstname'),
            'lastname' => $this->request->getPost('lastname'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phonenumber'),
            'address' => $this->request->getPost('address'),
            'citymunicipality' => $this->request->getPost('cityMunicipality'),
            'zipcode' => $this->request->getPost('zipcode'),
            'country' =>  $this->request->getPost('country'), 
            'cpass' =>  $this->request->getPost('currentPass'),
            'npass' => $this->request->getPost('newPass') 
        ];
         ## change profile picture
        if(!empty($data['pfp']) && $data['pfp']->isValid()) {
            $dataPfp['profile_pic'] = file_get_contents($data['pfp']->getTempName());
            $this->load->userAccount->update($data['userId'], $dataPfp);
        }
        ## change username
        if(isset($data['username'])) {
            $this->load->userAccount->update($data['userId'], ['username' => $data['username']]);
        }
        ## change firstname
        if(isset($data['firstname'])) {
            $this->load->userAccount->update($data['userId'], ['firstname' => $data['firstname']]);
        }
        ## change lastname
        if(isset($data['lastname'])) {
            $this->load->userAccount->update($data['userId'], ['lastname' => $data['lastname']]);
        }
        ## change email
        if(isset($data['email'])) {
            $this->load->userAccount->update($data['userId'], ['email' => $data['email']]);
        }
        ## change phone number
        if(isset($data['phone'])) {
            $this->load->userAccount->update($data['userId'], ['phone_number' => $data['phone']]);
        }
        ## change home address
        if(isset($data['address'])) {
            $this->load->userAccount->update($data['userId'], ['address' => $data['address']]);
        }
        ## change state/city/municipality
        if(isset($data['citymunicipality'])) {
            $this->load->userAccount->update($data['userId'], ['city_municipality' =>  $data['citymunicipality']] );
        }
        ## change zipcode
        if(isset($data['zipcode'])) {
            $this->load->userAccount->update($data['userId'], ['zipcode'=> $data['zipcode']]);
        }
        ## change country
        if(isset($data['country'])) {
            $this->load->userAccount->update($data['userId'], ['country'=> $data['country']]);
        }
        ## change password
        if($data['cpass'] && $data['npass']) {
            $pass = $this->load->userAccount->getUser('user_id', $data['userId']);
            if(password_verify($data['cpass'], $pass['password'])) {
                if($data['cpass'] == $data['npass']) {
                    $this->load->session->setFlashdata('npassInvalid', '*Password is already in use.');
                    return redirect()->back();
                }

                $hashedPassword = password_hash($data['npass'], PASSWORD_DEFAULT);

                $this->load->userAccount->update($data['userId'], ['password' => $hashedPassword]);
                $this->load->session->setFlashdata('profileUpdated', '*Password Changed successfully.');
                return redirect()->back();
            }
            else {
                $this->load->session->setFlashdata('cpassInvalid', '*Input your current password!');
                return redirect()->back();
            }
        }
        return redirect()->back()->with('profileUpdated', '*Account updated.');
    }
}