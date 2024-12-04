<?php

namespace App\Controllers;

class AdminController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- FOR REDERING VIEWS AND CHECKING SESSIONS AND EXPIRATIONS ----- ##
    ## check sessions and redirect to views
    public function checkSessionThenRedirect($path, $isDisplaying = false, $config = null){
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession("admin");
            return redirect()->to('/');
        }
        if($isDisplaying) {
            return $this->renderView($path, $isDisplaying, $config);
        }
        return $this->renderView($path);
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## Render View
    private function renderView($path, $data = null, $dataVal = null)
    {
        $id = $this->load->session->get('admin_id');
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('gears');
        $this->load->requireMethod('categories');   

        $data = [
            'dashboard' => $dataVal,
            'adminAccount' => $this->load->adminAccount->getUser('admin_account_id', $id),
            'categories' => $this->load->categories->getAll(),
            'gears' => $dataVal ? $dataVal : $this->load->gears->getGearLeftJoinCategory(),        
        ];

        if (!$data['adminAccount']) {
            return redirect()->to('/admin/loggingOut');
        }
        return view($path, $data);
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- LOGOUT ----- ##
    public function logout(){
        helper('cookie');
        $this->load->requireMethod('adminAccount');
        
        $admin_id = $this->load->session->get('admin_id');
        if($admin_id) {
            $this->load->adminAccount->update($admin_id, ['remember_token' => null]);
        }
        
        $this->load->session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- ROUTES ----- ##
    ## redirect to dashboard
    public function dashboard() { 

        return $this->checkSessionThenRedirect('AdminSide/dashboard', true); 
    }
    ## redirect to transactions
    public function orders_transactions() { 
        return $this->checkSessionThenRedirect('AdminSide/orders_transactions', true); 
    }
    ## redirect to gearManagement / addGear / addCategory
    public function gearManagement() {      
        return $this->checkSessionThenRedirect('AdminSide/management', true); 
    }
    ## redirect to gearManagement / addGear / addCategory
    public function customers() { 
        return $this->checkSessionThenRedirect('AdminSide/customers'); 
    }
    ## redirect to register
    public function register() { 
        return $this->checkSessionThenRedirect('AdminSide/register/registerA'); 
    }
    ## redirect to registerUser
    public function registerUser() { 
        return $this->checkSessionThenRedirect('AdminSide/register/registerU'); 
    }
    ## redirect to accountSetting
    public function account() { 
        // return $this->checkSessionThenRedirect('AdminSide/accountSetting', true); 
        return $this->checkSessionThenRedirect('AdminSide/account'); 
    }
## ----- END ----- ##


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- CREATE ACCOUNT FOR USER AND ADMINISTRATOR ----- ##
    ## create new admin
    public function createNewAdmin() {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');

        if($password == $cpassword) {
            $this->load->session->set([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'signupAccountType' => 'admin_admin'
            ]);
            return $this->checkIfExist();
        }
        else {
            $this->load->session->setFlashdata('error', 'Password did not match');
            return redirect()->to('/admin/registerA');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## create new user
    public function createNewUser() {  
        $password = $this->request->getPost('pass');
        $cpassword = $this->request->getPost('cpass');
        if($password == $cpassword) {
            $this->load->session->set([
                'fname' => $this->request->getPost('fname'),
                'lname' => $this->request->getPost('lname'),
                'email' => $this->request->getPost('email'),
                'phonenumber' => $this->request->getPost('pnum'),
                'username' => $this->request->getPost('user'),
                'password' => $password,
                'signupAccountType' => 'admin_user'
            ]);
            return $this->checkIfExist();
        }
        else {
            $this->load->session->setFlashdata('error', 'Password did not match');
            return redirect()->to('/admin/registerU');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## check if user or admin account existing
    private function checkIfExist() {  
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('emailVerify');

        $isAdminUsernameExist = $this->load->adminAccount->getUser('username', $this->load->session->get('username'));
        $isAdminEmailExist = $this->load->adminAccount->getUser('email', $this->load->session->get('email'));
        $isUserUsernameExist = $this->load->userAccount->getUser('username', $this->load->session->get('username'));
        $isUserEmailExist = $this->load->userAccount->getUser('email', $this->load->session->get('email'));
        if(($isAdminUsernameExist && $isAdminEmailExist) || ($isUserUsernameExist && $isUserEmailExist)) {
            $this->load->session->setFlashdata('error', 'Both username and email are already in use.');
            if($this->load->session->get('signupAccountType') == "admin_admin") {
                return redirect()->to('/admin/registerA');
            }
            else if($this->load->session->get('signupAccountType') == "admin_user") {
                return redirect()->to('/admin/registerU');
            }
        }
        else if($isAdminUsernameExist || $isUserUsernameExist) {
            $this->load->session->setFlashdata('error', 'Username is already in use.');
            if($this->load->session->get('signupAccountType') == "admin_admin") {
                return redirect()->to('/admin/registerA');
            }
            else if($this->load->session->get('signupAccountType') == "admin_user") {
                return redirect()->to('/admin/registerU');
            }
        }
        else if($isAdminEmailExist || $isUserEmailExist) {
            $this->load->session->setFlashdata('error', value: 'Email is already in use.');
            if($this->load->session->get('signupAccountType') == "admin_admin") {
                return redirect()->to('/admin/registerA');
            }
            else if($this->load->session->get('signupAccountType') == "admin_user") {
                return redirect()->to('/admin/registerU');
            }
        }
        else {
            return $this->load->emailVerify->sendEmailVerification($this->load->session->get('email'));
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## check if verification code is valid or not
    public function checkIfVerificationCodeIsValid($verificationCode){
        $this->load->requireMethod('expirationTime');

        $expiryTime = $this->load->session->get('verification_expiry');
    
        if ($this->load->session->get('verification') == $verificationCode) {
            if (time() < $expiryTime) {
                return $this->saveData();
            } else {
                $this->load->session->setFlashdata('userError', 'The verification code has expired.');
                return redirect()->to('/account/verify-email');
            }
        }
    
        $this->load->session->setFlashdata('userError', 'Invalid verification code.');
        return redirect()->to('/account/verify-email');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## saves data 
    private function saveData() {
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('userAccount');

        if($this->load->session->get('signupAccountType') == "admin_admin") {
            $this->load->adminAccount->save([
                'username' => $this->load->session->get('username'),
                'email' => $this->load->session->get('email'),
                'password' => password_hash($this->load->session->get('password'), PASSWORD_DEFAULT)
            ]);
            $this->removeTempSession(1);

            $this->load->session->setFlashdata('success', 'account created');
            return redirect()->to('/admin/registerA');
        }
        else if($this->load->session->get('signupAccountType') == "admin_user") {
            $this->load->userAccount->save([
                'firstname' => $this->load->session->get('fname'), 
                'lastname' => $this->load->session->get('lname'), 
                'email' => $this->load->session->get('email'),
                'phone_number' => $this->load->session->get('phonenumber'),
                'username' => $this->load->session->get('username'),
                'password' => password_hash($this->load->session->get('password'), PASSWORD_DEFAULT)
            ]);
            $this->removeTempSession(2);
            $this->load->session->setFlashdata('success', 'account created');
            return redirect()->to('/admin/registerU');
        }      
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- SEARCH GEAR ----- ##
    public function searchGears() {
        $this->load->requireMethod('gears');
        $query = $this->request->getGet('search');
        $gears = $this->load->gears->searchGears($query);
        return $this->renderView('AdminSide/gearManagement/gearManagement', true, $gears);
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- add new gear ----- ##
    public function addGear() {
        $this->load->requireMethod('gears');

        $gearName = $this->request->getPost('gearname');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('stock');
        $category = $this->request->getPost('category');
        $gearImageUrl = $this->request->getFile('img');

        $gearIsExist = $this->load->gears->getGear('product_name', $gearName);
        
        if ($gearIsExist) {
            return redirect()->back()->with('gearError', '\'' . $gearName . '\' gear already exists');
        }
        if($category == "") { $category = null; }

        if ($gearImageUrl->isValid() && !$gearImageUrl->hasMoved()) {
            $generatedRandomName = $gearImageUrl->getRandomName();
            $gearImageUrl->move('admin/uploads/', $generatedRandomName);
            $imageUrlPath = base_url('admin/uploads/' . $generatedRandomName);

            $this->load->gears->save([
                'category_id' => $category,
                'product_name' => $gearName,
                'description' => $description,
                'price' => $price,
                'stock_quantity' => $quantity,
                'image_url' => $imageUrlPath
            ]);

            if($category == "") {
                return redirect()->back()->with('gearAdded', '\'' . $gearName . '\' Gear Added, but category is not set');
            }
            return redirect()->back()->with('gearAdded', '\'' . $gearName . '\' Gear Added');
        }
        return redirect()->back()->with('gearError', 'Image is not set or not valid!');
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- update gear----- ##
    public function updateGear($gearID) {
        $this->load->requireMethod('gears');
        $gearName = $this->request->getPost('gearName');
        $description = $this->request->getPost('description');
        $category = $this->request->getPost('category');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('stock');
        $gearImageUrl = $this->request->getFile('img');

        if ($gearImageUrl->isValid() && !$gearImageUrl->hasMoved()) {
            $generatedRandomName = $gearImageUrl->getRandomName();
            $gearImageUrl->move('admin/uploads/', $generatedRandomName);
            $imageUrlPath = base_url('admin/uploads/' . $generatedRandomName);
            $this->load->gears->update($gearID,[
                'image_url' => $imageUrlPath,
                'product_name' => $gearName,
                'description' => $description,
                'category_id' => $category,
                'price' => $price,
                'stock_quantity' => $quantity
            ]);
            return redirect()->back()->with('gearAdded', 'a gear is updated');
        }
        $this->load->gears->update($gearID,[
            'product_name' => $gearName,
            'description' => $description,
            'category_id' => $category,
            'price' => $price,
            'stock_quantity' => $quantity
        ]);
        return redirect()->back()->with('gearAdded', 'a gear is updated');    
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- remove gear----- ##
    public function removeGear($id) {
        $this->load->requireMethod('gears');
        if ($this->load->gears->delete($id)) {
            return redirect()->to('/admin/management')->with('removeSuccess', 'Product deleted successfully.');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- add new category----- ##
    public function addNewCategory(){
        $this->load->requireMethod('categories');
        $category = $this->request->getPost('category');
        $retrieveCategory = $this->load->categories->getCategory('category', $category);

        if($retrieveCategory) {
            return redirect()->back()->with('catError', '\'' . $category . '\' category already exist');
        }
        $this->load->categories->save(['category' => $category]);
        return redirect()->back()->with('catAdded', '\''. $category .'\' category Added');          
    }
## ----- END ----- ##


## ----- remove category by id ----- ##
    public function removeCategory($id){
        $this->load->requireMethod('categories');
        if ($this->load->categories->delete($id)) {
            return redirect()->to('/admin/management')->with('catDeleted', 'Category deleted successfully.');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- update admin account - admin settings panel ----- ##
    public function updateAdmin() {
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('adminAccount');

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $cpassword = $this->request->getPost('cpassword');
        $password = $this->request->getPost('password');
        $admin = $this->load->adminAccount->getUser('admin_account_id', $this->load->session->get('admin_id'));
        $userUsername = $this->load->userAccount->getUser('username', $username);
        $userEmail = $this->load->userAccount->getUser('email', $email);

        // check if the image file is empty - if not empty proceed with this if statement
        if(!empty($this->request->getFile('profile_pic')) && $this->request->getFile('profile_pic')->isValid()) {
            $pfp = $this->request->getFile('profile_pic');
            $data['profile_pic'] = file_get_contents($pfp->getTempName());

            $this->load->adminAccount->update($admin, $data);
            return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
        }

        // check if username, email or both are existing and already in use by another or currently in used
        $admin_Username = $this->load->adminAccount->checkIfDataIsUsedByAnotherUser('username', $username, '!=');
        $admin_email = $this->load->adminAccount->checkIfDataIsUsedByAnotherUser('email', $email, '!=');

        if($admin['username'] == $username) {
            $this->load->session->setFlashdata('existingUsername', 'Username is already using');
            return redirect()->back();
        }
        if($admin['email'] == $email) {
            $this->load->session->setFlashdata('existingEmail', 'Email is already using');
            return redirect()->back();
        }
        if(password_verify($password, $admin['password'])) {
            $this->load->session->setFlashdata('existingEmail', 'Already using the new password input');
            return redirect()->back();
        }
        if($admin_Username > 0 || $userUsername) {
            $this->load->session->setFlashdata('existingUsername', 'Username is already in use');
            return redirect()->back();
        }
        if($admin_email > 0 || $userEmail) {
            $this->load->session->setFlashdata('existingEmail', 'Email is already in use');
            return redirect()->back();
        }
        if($admin_Username > 0 && $admin_email > 0 || $userUsername && $userEmail) {
            $this->load->session->setFlashdata('existingBoth', 'Username and Email is already in use');
            return redirect()->back();
        }

        // check if the password field is empty if empty proceed and update without the password
        if(empty($cpassword)) {
           if(empty($password)) {
                $data = [
                    'username' => $username,
                    'email' => $email
                ];
                if($this->request->getFile('profile_pic')->isValid()) {
                    $pfp = $this->request->getFile('profile_pic');
                    $data['profile_pic'] = file_get_contents($pfp->getTempName());
                }
                $this->load->adminAccount->update($admin, $data);
                $this->load->session->set([
                    'username' => $username,
                    'email' => $email
                ]);
                return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
           }
           return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
        }

        // if the conditions above didnt turn true, proceed with this one below
        if($cpassword == $password) {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPass
            ];
    
            if($this->request->getFile('profile_pic')->isValid()) {
                $pfp = $this->request->getFile('profile_pic');
                $data['profile_pic'] = file_get_contents($pfp->getTempName());
            }
    
            $this->load->session->set([
                'username' => $username,
                'email' => $email
            ]);
            $this->load->adminAccount->update($admin, $data);
            return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
        }
        return redirect()->back()->with('passwordErr', 'password did not match');
    }
    


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- delete admin account - admin settings panel ----- ##
    public function deleteAdmin($id){
        helper('cookie');
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('carts');

        $this->load->carts->deleteCartById($id);
        $this->load->session->destroy();    
        delete_cookie('remember_token');
        $this->load->adminAccount->delete($id);
        return redirect()->to('/');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    private function removeTempSession($val) {
        if($val == 1) {
            $this->load->session->remove([
                'username', 'email', 'password', 'signupAccountType'
            ]);
        }
        else if($val == 2) {
            $this->load->session->remove([
                'fname', 'lname', 'email', 'phonenumber', 'username', 'password', 'signupAccountType'
            ]);
        }
    }
}   