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
        return $this->checkSessionThenRedirect('UserSide/userprof', true);
    }
    ## User purchase history
    public function myPurchase() {
        return $this->checkSessionThenRedirect('UserSide/myPurchase', true);
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- Controller functions ----- ##
    ## change profile picture
        public function changeProfile() {
            $this->load->requireMethod('userAccount');
            $userId = $this->load->session->get('user_id');

            $pfp = $this->request->getFile('pfp');
            if(!empty($pfp) && $pfp->isValid()) {
                $data['profile_pic'] = file_get_contents($pfp->getTempName());
                $this->load->userAccount->update($userId, $data);
                return redirect()->back()->with('profileUpdated', '*Profile Picture successfully updated.');
            }
            return redirect()->back();
        }

    ## change username
        public function changeUsername() {
            $this->load->requireMethod('userAccount');
            $userId = $this->load->session->get('user_id');
            $username = $this->request->getPost('username');

            if(!empty($username)) {
                $this->load->userAccount->update($userId, ['username' => $username]);
                return redirect()->back()->with('profileUpdated', '*Username successfully updated.');
            }
            return redirect()->back();
        }

    ## change firstname
        public function changeFirstname() {
            $this->load->requireMethod('userAccount');
            $firstname = $this->request->getPost('firstname');
            $userId = $this->load->session->get('user_id');

            if(!empty($firstname)) {
                $this->load->userAccount->update($userId, ['firstname' => $firstname]);
                return redirect()->back()->with('profileUpdated', '*Firstname successfully updated.');
            }
            return redirect()->back();
        }

    ## change lastname
        public function changeLastname() {
            $this->load->requireMethod('userAccount');
            $lastname = $this->request->getPost('lastname');
            $userId = $this->load->session->get('user_id');

            if(!empty($lastname)) {
                $this->load->userAccount->update($userId, ['lastname' => $lastname]);
                return redirect()->back()->with('profileUpdated', '*Lastname successfully updated.');
            }
            return redirect()->back();
        }

    ## change email
        public function changeEmail() {
            $this->load->requireMethod('userAccount');
            $email = $this->request->getPost('email');
            $userId = $this->load->session->get('user_id');

            if(!empty($email)) {
                $this->load->userAccount->update($userId, ['email' => $email]);
                return redirect()->back()->with('profileUpdated', '*Email successfully updated.');
            }
            return redirect()->back();
        }

    ## change phone number
        public function changePhone() {
            $this->load->requireMethod('userAccount');
            $phonenumber = $this->request->getPost('phonenumber');
            $userId = $this->load->session->get('user_id');

            if(!empty($phonenumber)) {
                $this->load->userAccount->update($userId, ['phone_number' => $phonenumber]);
                return redirect()->back()->with('profileUpdated', '*Phone number successfully updated.');
            }
            return redirect()->back();
        }

    ## change home address
        public function changeAddress() {
            $this->load->requireMethod('userAccount');
            $address = $this->request->getPost('address');
            $userId = $this->load->session->get('user_id');

            if(!empty($address)) {
                $this->load->userAccount->update($userId, ['address' => $address]);
                return redirect()->back()->with('profileUpdated', '*Address successfully updated.');
            }
            return redirect()->back();
        }

    ## change state/city/municipality
        public function changeCityMunicipality() {
            $this->load->requireMethod('userAccount');
            $cityMunicipality = $this->request->getPost('cityMunicipality');
            $userId = $this->load->session->get('user_id');

            if(!empty($cityMunicipality)) {
                $this->load->userAccount->update($userId, ['city_municipality' =>  $cityMunicipality] );
                return redirect()->back()->with('profileUpdated', '*City/municipality successfully updated.');
            }
            return redirect()->back();
        }

    ## change zipcode
        public function changeZipcode() {
            $this->load->requireMethod('userAccount');
            $zipcode = $this->request->getPost('zipcode');
            $userId = $this->load->session->get('user_id');

            if(!empty($zipcode)) {
                $this->load->userAccount->update($userId, ['zipcode'=> $zipcode]);
                return redirect()->back()->with('profileUpdated', '*Zipcode successfully updated.');
            }
            return redirect()->back();
        }

    ## change country
        public function changeCountry() {
            $this->load->requireMethod('userAccount');
            $country = $this->request->getPost('country');
            $userId = $this->load->session->get('user_id');

            if(!empty($country)) {
                $this->load->userAccount->update($userId, ['country'=> $country]);
                return redirect()->back()->with('profileUpdated', '*Country successfully updated.');
            }
            return redirect()->back();
        }

    ## change password
        public function cahngePassword() {
            $this->load->requireMethod('userAccount');
            $userId = $this->load->session->get('user_id');
            $currentPass = $this->request->getPost('currentPass');
            $newPass = $this->request->getPost('newPass');

            if(empty($currentPass) ) {
                $this->load->session->setFlashdata('cpassEmpty', 'This field is empty');
                return redirect()->back();
            }
            if(empty($newPass)) {
                $this->load->session->setFlashdata('npassEmpty', '*This field is empty');
                return redirect()->back();
            }

            if(!empty($currentPass) && !empty($newPass)) {
                $pass = $this->load->userAccount->getUser('user_id', $userId);
                if(password_verify($currentPass, $pass['password'])) {
                    if($currentPass == $newPass) {
                        $this->load->session->setFlashdata('npassInvalid', '*Password is already in use.');
                        return redirect()->back();
                    }

                    $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT);

                    $this->load->userAccount->update($userId, ['password' => $hashedPassword]);
                    $this->load->session->setFlashdata('profileUpdated', '*Password Changed successfully.');
                    return redirect()->back();
                }
                else {
                $this->load->session->setFlashdata('cpassInvalid', '*Input your current password!');
                    return redirect()->back();
                }
            }
            return redirect()->back();
        }
}