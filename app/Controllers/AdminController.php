<?php

namespace App\Controllers;
require FCPATH . '../vendor/autoload.php';
use App\Controllers\EmailVerificationController as EVerify;


use Config\Session as SessionConfig;
use App\Models\Admin_Account_Model as adminAccount;
use App\Models\User_Account_Model as userAccount;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gears;

class AdminController extends BaseController
{
    protected $session;
    protected $sessionConfig;
    protected $expirationTime;
    protected $userAccount;
    protected $adminAccount;
    protected $categories;
    protected $gears;
    protected $EVerify;




## ----- THIS PREVENTS LOADING MODELS AND MEMORY ISSUES ----- ##
## call this methods to load models
    // load session method
    private function loadSession() {
        if(!$this->session) {
            $this->session = Session();
        }
    }
    // load session expiration time 
    private function loadExpirationTime() {
        if(!$this->expirationTime){
            $this->sessionConfig = new SessionConfig();
            $this->expirationTime = $this->sessionConfig->expiration;
        }
    }
    // load categories model
    private function loadAdminAccount() {
        if(!$this->adminAccount) {
            $this->adminAccount = new adminAccount();
        }
    }
    // load categories model
    private function loadUserAccount() {
        if(!$this->userAccount) {
            $this->userAccount = new userAccount();
        }
    }
    // load categories model
    private function loadCategories() {
        if(!$this->categories) {
            $this->categories = new categories();
        }
    }
    // load gears model
    private function loadGears() {
        if(!$this->gears) {
            $this->gears = new gears();
        }
    }
    // load email verification controller
    private function loadEmailVerification() {
        if(!$this->EVerify) {
            $this->EVerify = new EVerify();
        }
    }
## ----- END ----- ##





## ----- FOR REDERING VIEWS AND CHECKING SESSIONS AND EXPIRATIONS ----- ##
    ## check sessions and redirect to views
    public function checkSessionThenRedirect($path, $isDisplaying = false){
        if(!$this->isAdminAccount()) {
            return redirect()->to('/');
        }
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession();
            return redirect()->to('/');
        }
        return $this->renderView($path, $isDisplaying);
    }
        ## check if use is logged in using an admin account
        private function isAdminAccount(){
            $this->loadSession();
            return  $this->session->get('type') == "admin" && 
                    $this->session->get('isLoggedIn') && 
                    $this->session->get('admin_id');
        }

        ## check if session is expired (if expired return true, else return false)
        private function isSessionExpired(){
            $this->loadSession();
            $this->loadExpirationTime();
            return  $this->session->get('timeLoggedIn') && 
                    (time() - $this->session->get('timeLoggedIn')) > $this->expirationTime;
        }

        ## delete both cookies and session
        private function deleteCookiesAndSession(){
            helper('cookie');
            $this->loadSession();
            $this->loadAdminAccount();
            $user_id = $this->session->get('admin_id');
            $username = $this->session->get('username');
            $this->adminAccount->update($user_id , ['remember_token' => null]);
            $this->adminAccount->update($username, ['remember_token' => null]);
            delete_cookie('remember_token');
        }

        private function renderView($path, $isDisplaying)
        {
            if ($isDisplaying) {
                // Load models here to avoid initializing them in the constructor
                $this->loadGears();
                $this->loadCategories();
                $this->loadSession();
                $this->loadAdminAccount();
                $data = [
                    'adminAccount' => $this->adminAccount->getUser('admin_account_id', $this->session->get('admin_id')),
                    'gears' => $this->gears->getGearLeftJoinCategory(),
                    'categories' => $this->categories->getAll(),
                ];

                if (!$data['adminAccount']) {
                    return redirect()->to('/admin/loggingOut');
                }

                return view($path, $data);
            }

            return view($path);
        }
## ----- END ----- ##





## ----- LOGOUT ----- ##
    public function logout(){
        helper('cookie');
        $this->loadSession();
        $this->loadAdminAccount();
        
        $admin_id = $this->session->get('admin_id');
        if($admin_id) {
            $this->adminAccount->update($admin_id, ['remember_token' => null]);
        }
        
        $this->session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }
## ----- END ----- ##



## ----- ROUTES ----- ##
    ## redirect to dashboard
    public function dashboard() { 
        return $this->checkSessionThenRedirect('AdminSide/dashboard', true); 
    }
    ## redirect to transactions
    public function transactions() { 
        return $this->checkSessionThenRedirect('AdminSide/transactions', true); 
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





## ----- CREATE ACCOUNT FOR USER AND ADMINISTRATOR ----- ##
    ## create new admin
    public function createNewAdmin() {
        $this->loadSession();
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');

        if($password == $cpassword) {
            $this->session->set([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'signupAccountType' => 'admin_admin'
            ]);
            return $this->checkIfExist();
        }
        else {
            $this->session->setFlashdata('error', 'Password did not match');
            return redirect()->to('/admin/registerA');
        }
    }
    ## create new user
    public function createNewUser() {
        $this->loadSession();
        $password = $this->request->getPost('pass');
        $cpassword = $this->request->getPost('cpass');
        if($password == $cpassword) {
            $this->session->set([
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
            $this->session->setFlashdata('error', 'Password did not match');
            return redirect()->to('/admin/registerU');
        }
    }

        ## check if user or admin account existing
        private function checkIfExist() {
            $this->loadSession();            
            $this->loadEmailVerification();
            $this->loadAdminAccount();
            $this->loadUserAccount();
            $isAdminUsernameExist = $this->adminAccount->getUser('username', $this->session->get('username'));
            $isAdminEmailExist = $this->adminAccount->getUser('email', $this->session->get('email'));
            $isUserUsernameExist = $this->userAccount->getUser('username', $this->session->get('username'));
            $isUserEmailExist = $this->userAccount->getUser('email', $this->session->get('email'));
            if(($isAdminUsernameExist && $isAdminEmailExist) || ($isUserUsernameExist && $isUserEmailExist)) {
                $this->session->setFlashdata('error', 'Both username and email are already in use.');
                if($this->session->get('signupAccountType') == "admin_admin") {
                    return redirect()->to('/admin/registerA');
                }
                else if($this->session->get('signupAccountType') == "admin_user") {
                    return redirect()->to('/admin/registerU');
                }
            }
            else if($isAdminUsernameExist || $isUserUsernameExist) {
                $this->session->setFlashdata('error', 'Username is already in use.');
                if($this->session->get('signupAccountType') == "admin_admin") {
                    return redirect()->to('/admin/registerA');
                }
                else if($this->session->get('signupAccountType') == "admin_user") {
                    return redirect()->to('/admin/registerU');
                }
            }
            else if($isAdminEmailExist || $isUserEmailExist) {
                $this->session->setFlashdata('error', value: 'Email is already in use.');
                if($this->session->get('signupAccountType') == "admin_admin") {
                    return redirect()->to('/admin/registerA');
                }
                else if($this->session->get('signupAccountType') == "admin_user") {
                    return redirect()->to('/admin/registerU');
                }
            }
            else {
                return $this->EVerify->sendEmailVerification($this->session->get('email'));
            }
        }

        ## check if verification code is valid or not
        public function checkIfVerificationCodeIsValid($verificationCode){
            $this->loadSession();
            $this->loadExpirationTime();
            $expiryTime = $this->session->get('verification_expiry');
        
            if ($this->session->get('verification') == $verificationCode) {
                if (time() < $expiryTime) {
                    return $this->saveData();
                } else {
                    $this->session->setFlashdata('userError', 'The verification code has expired.');
                    return redirect()->to('/account/verify-email');
                }
            }
        
            $this->session->setFlashdata('userError', 'Invalid verification code.');
            return redirect()->to('/account/verify-email');
        }
            ## saves data 
            private function saveData() {
                $this->loadSession();
                if($this->session->get('signupAccountType') == "admin_admin") {
                    $this->loadAdminAccount();
                    $this->adminAccount->save([
                        'username' => $this->session->get('username'),
                        'email' => $this->session->get('email'),
                        'password' => password_hash($this->session->get('password'), PASSWORD_DEFAULT)
                    ]);
                    $this->session->remove('username');
                    $this->session->remove('email');
                    $this->session->remove('password');
                    $this->session->remove('signupAccountType');
                    $this->session->setFlashdata('success', 'account created');
                    return redirect()->to('/admin/registerA');
                }
                else if($this->session->get('signupAccountType') == "admin_user") {
                    $this->loadUserAccount();
                    $this->userAccount->save([
                        'firstname' => $this->session->get('fname'), 
                        'lastname' => $this->session->get('lname'), 
                        'email' => $this->session->get('email'),
                        'phone_number' => $this->session->get('phonenumber'),
                        'username' => $this->session->get('username'),
                        'password' => password_hash($this->session->get('password'), PASSWORD_DEFAULT)
                    ]);
                    $this->session->remove('fname');
                    $this->session->remove('lname');
                    $this->session->remove('email');
                    $this->session->remove('phonenumber');
                    $this->session->remove('username');
                    $this->session->remove('password');
                    $this->session->remove('signupAccountType');
                    $this->session->setFlashdata('success', 'account created');
                    return redirect()->to('/admin/registerU');
                }      
            }
## ----- END ----- ##





## ----- add new gear ----- ##
    public function addGear() 
    {
        $productGear = new gears();

        $gearName = $this->request->getPost('gear');
        $description = $this->request->getPost('description');
        $price = $this->request->getPost('price');
        $quantity = $this->request->getPost('quantity');
        $category = $this->request->getPost('categorySelected');
        $gearImageUrl = $this->request->getFile('image');

        $gearIsExist = $productGear->getGear('product_name', $gearName);
        
        if ($gearIsExist) {
            return redirect()->back()->with('gearError', '\'' . $gearName . '\' gear already exists');
        }
        if($category == "") { $category = null; }

        if ($gearImageUrl->isValid() && !$gearImageUrl->hasMoved()) {
            $generatedRandomName = $gearImageUrl->getRandomName();
            $gearImageUrl->move('admin/uploads/', $generatedRandomName);
            $imageUrlPath = base_url('admin/uploads/' . $generatedRandomName);

            $productGear->save([
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
## ----- END ----- ##



## ----- remove gear----- ##
    public function removeGear($id) 
    {
        $gears = new Gears();
        
        if ($gears->delete($id)) {
            return redirect()->to('/admin/gears')->with('removeSuccess', 'Product deleted successfully.');
        }
    }
## ----- END ----- ##




## ----- add new category----- ##
    public function addNewCategory()
    {
        $categories = new categories();
        $category = $this->request->getPost('category');
        $retrieveCategory = $categories->getCategory('category', $category);

        if($retrieveCategory) {
            return redirect()->back()->with('catError', '\'' . $category . '\' category already exist');
        }
        $categories->save(['category' => $category]);
        return redirect()->back()->with('catAdded', '\''. $category .'\' category Added');          
    }
## ----- END ----- ##


## ----- remove category by id ----- ##
    public function removeCategory($id)
    {
        $categories = new categories();
        if ($categories->delete($id)) {
            return redirect()->to('/admin/gears/addCategory')->with('catDeleted', 'Category deleted successfully.');
        }
    }
## ----- END ----- ##




## ----- update admin account - admin settings panel ----- ##
    public function updateAdmin() 
    {
        $session = session();
        $adminAccount = new adminAccount();
        $userAccount = new userAccount();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $adminAccount->getUser('admin_account_id', $session->get('admin_id'));
        $userUsername = $userAccount->getUser('username', $username);
        $userEmail = $userAccount->getUser('email', $email);

        // check if the image file is empty - if not empty proceed with this if statement
        if(!empty($this->request->getFile('profile_pic')) && $this->request->getFile('profile_pic')->isValid()) {
            $pfp = $this->request->getFile('profile_pic');
            $data['profile_pic'] = file_get_contents($pfp->getTempName());

            $adminAccount->update($admin, $data);
            return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
        }


        // check if username, email or both are existing and already in use by another or currently in used
        $admin_Username = $adminAccount->checkIfDataIsUsedByAnotherUser('username', $username, '!=');
        $admin_email = $adminAccount->checkIfDataIsUsedByAnotherUser('email', $email, '!=');

        if($admin_Username > 0 || $userUsername) {
            $session->setFlashdata('existingUsername', 'Username is already in use');
            return redirect()->back();
        }
        if($admin_email > 0 || $userEmail) {
            $session->setFlashdata('existingEmail', 'Email is already in use');
            return redirect()->back();
        }
        if($admin_Username > 0 && $admin_email > 0 || $userUsername && $userEmail) {
            $session->setFlashdata('existingBoth', 'Username and Email is already in use');
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
            $adminAccount->update($admin, $data);
            $session->set([
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

        $session->set([
            'username' => $username,
            'email' => $email
        ]);
        $adminAccount->update($admin, $data);
        return redirect()->back()->with('successUpdateProfile', 'Profile updated successfully.');
    }
## ----- END ----- ##



## ----- delete admin account - admin settings panel ----- ##
    public function deleteAdmin($id)
    {
        helper('cookie');
        $session = session();
        $adminAccount = new adminAccount();

        $session->destroy();    
        delete_cookie('remember_token');
        $adminAccount->delete($id);
        return redirect()->to('/');
    }
## ----- END ----- ##

}   