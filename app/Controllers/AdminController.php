<?php

namespace App\Controllers;

class AdminController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- FOR REDERING VIEWS AND CHECKING SESSIONS AND EXPIRATIONS ----- ##
    ## check sessions and redirect to views
    public function checkSessionThenRedirect($path, $isDisplaying = false){
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession("admin");
            return redirect()->to('/');
        }
        return $this->renderView($path, $isDisplaying);
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## Render View
    private function renderView($path, $isDisplaying, $gears = null)
    {
        if ($isDisplaying) {
            // Load models here to avoid initializing them in the constructor
            $this->load->requireMethod('gears');
            $this->load->requireMethod('categories');
            $this->load->requireMethod('adminAccount');
            $this->load->requireMethod('transactions');
            
            $data = [
                'adminAccount' => $this->load->adminAccount->getUser('admin_account_id', $this->load->session->get('admin_id')),
                'gears' => $gears ? $gears : $this->load->gears->getGearLeftJoinCategory(),
                'categories' => $this->load->categories->getAll(),
                'transactions' => $this->load->transactions->getAll() 
            ];

            if (!$data['adminAccount']) {
                return redirect()->to('/admin/loggingOut');
            }

            return view($path, $data);
        }

        return view($path);
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
    public function transactions() { 
        return $this->checkSessionThenRedirect('AdminSide/transactions/transactions', true); 
    }
    ## redirect to gearManagement / addGear / addCategory
    public function gearManagement() { 
        return $this->checkSessionThenRedirect('AdminSide/gearManagement/gearManagement', true); 
    }
    ## redirect to add gears page
    public function addGears() {
        return $this->checkSessionThenRedirect('AdminSide/gearManagement/addGear', true);;
    }
    ## redirect to add categories page
    public function addCategories(){
        return $this->checkSessionThenRedirect('AdminSide/gearManagement/addCategory', true);;
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
    public function accountSetting() { 
        return $this->checkSessionThenRedirect('AdminSide/accountSetting', true); 
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

        $gearName = $this->request->getPost('gear');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');
        $category = $this->request->getPost('categorySelected');
        $gearImageUrl = $this->request->getFile('image');

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
## ----- remove gear----- ##
    public function removeGear($id) {
        $this->load->requireMethod('gears');
        if ($this->load->gears->delete($id)) {
            return redirect()->to('/admin/gears')->with('removeSuccess', 'Product deleted successfully.');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- view order / shipping for specific transaction ----- ##
    public function viewTransaction($id) {
        $this->load->requireMethod('userAccount');
        $name = $this->load->userAccount->getUser('user_id', $id);

        $data = [
            'id' => $id,
            'user' => $name['firstname']." ".$name['lastname']
        ];
        return view('AdminSide/transactions/viewTransaction', $data);
    }

## ----- update transaction ----- ##
    public function updateStatus(){
        $this->load->requireMethod('transactions');
        $transactionId = $this->request->getPost('transaction_id');
        $status = $this->request->getPost('status');

        // Update the status in the database
        $this->load->transactions->update($transactionId, ['status' => $status]);

        // Redirect back to the transaction management page
        return redirect()->to('/admin/transactions');
    }


## ----- remove transaction ----- ##
    public function removeTransaction($id) {
        $this->load->requireMethod('transactions');
        if($this->load->transactions->delete($id)) {
            return redirect()->to('/admin/transactions')->with('removeSuccess', 'Transaction deleted successfully.');
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
            return redirect()->to('/admin/gears/addCategory')->with('catDeleted', 'Category deleted successfully.');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- update admin account - admin settings panel ----- ##
    public function updateAdmin() {
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('adminAccount');

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
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

        // if the conditions above didnt turn true, proceed with this one below
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