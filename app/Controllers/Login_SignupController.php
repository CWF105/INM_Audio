<?php

namespace App\Controllers;
require FCPATH . '../vendor/autoload.php';
use App\Models\Admin_Account_Model as adminAccountModel;
use App\Models\User_Account_Model as userAccountModel;
use App\Controllers\EmailVerificationController as EVerify;

class Login_SignupController extends BaseController
{
    protected $session;
    protected $adminAccount;
    protected $userAccount;
    protected $EVerify;

## ----- THIS PREVENTS LOADING MODELS AND MEMORY ISSUES ----- ##
## call this methods to load models
    // load session method
    private function loadSession() {
        if(!$this->session) {
            $this->session = session();
        }
    }
    // load user account model 
    private function loadUserAccount(){
        if(!$this->userAccount) {
            $this->userAccount = new userAccountModel();
        }
    }
    // load admin account model 
    private function loadAdminAccount(){
        if(!$this->adminAccount) {
            $this->adminAccount = new adminAccountModel();
        }
    }
    // load email verification controller
    private function loadEmailVerification() {
        if(!$this->EVerify) {
            $this->EVerify = new EVerify();
        }
    }
## ----- END ----- ##





## ----- SIGN UP CONTROLLER FOR USER ----- ##
    // getting the post request for input fields then setting it temporarily in session for future access and use
    // after this method it redirects to checkIfExist() method
    public function signup_user() {
        $this->loadSession();
        $this->session->set([
            'firstName' => $this->request->getPost('fname'),
            'lastName' => $this->request->getPost('lname'),
            'email' => $this->request->getPost('email'),
            'phonenumber' => $this->request->getPost('pnum'),
            'username' => $this->request->getPost('user'),
            'password' => $this->request->getPost('pass'),
            'cpassword' => $this->request->getPost('cpass'),
            'signupAccountType' => 'user'
        ]); 
        if($this->session->get('pass') == $this->session->get('cpass')) {
            return $this->checkIfExist();
        }
        else {
            $this->session->setFlashdata('userError', 'password did not match');
            return redirect()->to('/login');
        }
    }
        // check is data is existing in the database
        // then redirect back to login page, or else redirect to EmailVerificationController::sendEmailVerification() method
        private function checkIfExist(){
            $this->loadSession();
            $this->loadEmailVerification();
            $this->loadUserAccount();
            $this->loadAdminAccount();
            $adminUsernameExist = $this->userAccount->getUser('username', $this->session->get('username'));
            $adminEmailExist = $this->userAccount->getUser('email', $this->session->get('email'));
            $userUsernameExist = $this->userAccount->getUser('username', $this->session->get('username'));
            $userEmailExist = $this->userAccount->getUser('email', $this->session->get('email'));
            if(($adminUsernameExist && $adminEmailExist) || ($userUsernameExist && $userEmailExist)) {
                $this->session->setFlashdata('userError', 'Both username and email are already in use.');
                return redirect()->to('/login'); 
            }
            else if ($adminUsernameExist || $userUsernameExist) {
                $this->session->setFlashdata('userError', 'Username is already in use.');
                return redirect()->to('/login');
            }
            else if ($adminEmailExist || $userEmailExist) {
                $this->session->setFlashdata('userError', 'Email is already in use.');
                return redirect()->to('/login');
            }
            else {
                return $this->EVerify->sendEmailVerification($this->session->get('email'));
            }
        }





    ## verify if verification code is valid
    //after this method, redirects to saveData() method or redirect back to EmailVerificationController::verificationPage() method
    public function checkIfVerificationCodeIsValid($verificationCode){
        $this->loadSession();
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





        // save account and proceed to logged in
        // save to database table 'user_accounts' then set success message, and unset session data, then redirect to login page
        private function saveData() {
            $this->loadSession();
            $this->loadUserAccount();
            $this->userAccount->save([
                'firstname' => $this->session->get('firstName'), 
                'lastname' => $this->session->get('lastName'), 
                'email' => $this->session->get('email'),
                'phone_number' => $this->session->get('phonenumber'),
                'username' => $this->session->get('username'),
                'password' => password_hash($this->session->get('password'), PASSWORD_DEFAULT)
            ]);
        
            $this->session->setFlashdata('successRegister', 'Account created successfully.');
            $this->session->remove('firstname');
            $this->session->remove('lastname');
            $this->session->remove('email');
            $this->session->remove('phonenumber');
            $this->session->remove('username');
            $this->session->remove('password');
            $this->session->remove('signupAccountType');
            $this->session->setFlashdata('successRegister', 'account created');
            return redirect()->to('/login');
        }
## ----- END ----- ##





## -----  LOGIN CONTROLLER FOR USER ----- ##
    ## checks if logging in to user or admin
     public function loginAdminAndUser(){
        helper('cookie');
        $this->loadSession();
        $this->loadAdminAccount();
        $this->loadUserAccount();

        $usernameOrEmail = $this->request->getPost('username');
        $password = $this->request->getPost('pass');
        $rememberMe = $this->request->getPost('remember');

        #adminAccount
        $adminUsername = $this->adminAccount->getUser('username', $usernameOrEmail);
        $adminEmail = $this->adminAccount->getUser('email', $usernameOrEmail);
        #userAccount
        $userUsername = $this->userAccount->getUser('username', $usernameOrEmail);
        $userEmail = $this->userAccount->getuser('email', $usernameOrEmail);

        #adminAccount
        if($adminUsername || $adminEmail) {
            if(is_array($adminUsername) && password_verify($password, $adminUsername['password'])) {
                $this->session->set([
                    'admin_id' => $adminUsername['admin_account_id'],
                    'username' => $adminUsername['username'],
                    'email' => $adminUsername['email'],
                    'type' => 'admin',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);    
                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $this->adminAccount->update($adminUsername['admin_account_id'], ['remember_token' => $token]);
                    set_cookie('remember_token', $token, 7200);  // set 300 to expires in 5 mins, set 7200 to expires in 2hrs
                }
                $this->session->setFlashdata('welcome_admin', 'Welcome Administrator');                
                return redirect()->to('/admin/dashboard');
            }
            else if(is_array($adminEmail) && password_verify($password, $adminEmail['password'])) {
                $this->session->set([
                    'admin_id' => $adminEmail['admin_account_id'],
                    'username' => $adminEmail['username'],
                    'email' => $adminEmail['email'],
                    'type' => 'admin',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);    
                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $this->adminAccount->update($adminEmail['admin_account_id'], ['remember_token' => $token]);
                    set_cookie('remember_token', $token, 7200);  // set 300 to expires in 5 mins, set 7200 to expires in 2hrs
                }
                $this->session->setFlashdata('welcome_admin', 'Welcome Administrator');
                return redirect()->to('/admin/dashboard');
            }
            else {
                $this->session->setFlashdata('error', 'Wrong login credentials!.');
                return redirect()->to('/login');            
            }
        }


        #userLogin
        if($userUsername || $userEmail) {
            if(is_array($userUsername) && password_verify($password, $userUsername['password'])) {
                $this->session->set([
                    'user_id' => $userUsername['user_id'],
                    'username' => $userUsername['username'],
                    'email' => $userUsername['email'],
                    'type' => 'user',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);  
                // remember me check box
                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $this->userAccount->update($userUsername['user_id'], ['remember_token' => $token]);
    
                    // set to expires in 30 days
                    set_cookie('remember_token', $token, 3600*24*30);
                }
                $this->session->setFlashdata('welcome_user', 'Welcome' . $userUsername['username']);
                return redirect()->to('/');
            }
            else if(is_array($userEmail) && password_verify($password, $userEmail['password'])) {
                $this->session->set([
                    'user_account_id' => $userEmail['user_id'],
                    'username' => $userEmail['username'],
                    'email' => $userEmail['email'],
                    'type' => 'user',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]); 

                // remember me check box
                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $this->userAccount->update($userEmail['user_id'], ['remember_token' => $token]);
    
                    // set to expires in 30 days
                    set_cookie('remember_token', $token, 3600*24*30);
                }
                $this->session->setFlashdata('welcome_user', 'Welcome' . $userUsername['username']);
                return redirect()->to('/');
            }
        }
        $this->session->setFlashdata('error', 'Wrong login credentials!.');
        return redirect()->to('/login');
        }
## ----- END ----- ##





## ----- FORGOT PASSWORD ----- ##
        ## forgot password
        public function forgotPass() {
            return view('UserSide/forgotpassword');
        }


        ## check email if valid
        public function checkEmail() {
            $this->loadSession(); $this->loadAdminAccount(); $this->loadUserAccount(); $this->loadEmailVerification();
            $emailToReset = $this->request->getPost('email');
            if($this->adminAccount->getUser('email', $emailToReset)) {
                $this->session->set(['resetPassFor' => 'admin', 'emailToReset' => $emailToReset]);
                return $this->EVerify->sendEmailVerification($emailToReset);
            }
            else if($this->userAccount->getUser('email', $emailToReset)) {
                $this->session->set(['resetPassFor' => 'admin', 'emailToReset' => $emailToReset]);
                return $this->EVerify->sendEmailVerification($emailToReset);
            }
            else {
                $this->session->setFlashdata('error', 'Invalid Email');
                return redirect()->to('/account/forgotPass');
            }
        }


        ## verify the code then redirect to creating new pass
        public function verifyCode($verificationCode){
            $this->loadSession();
            $expiryTime = $this->session->get('verification_expiry');
        
            if ($this->session->get('verification') == $verificationCode) {
                if (time() < $expiryTime) {
                    return $this->createNewPass();
                } else {
                    $this->session->setFlashdata('userError', 'The verification code has expired.');
                    return redirect()->to('/account/verify-email');
                }
            }
            $this->session->setFlashdata('userError', 'Invalid verification code.');
            return redirect()->to('/account/verify-email');
        }


        ## create new pass after email is check and is valid
        public function createNewPass() {
            return view('UserSide/CreateNewPassword');
        }

        ## resets password then redirect
        public function resetPass() {
            $this->loadSession(); $this->loadAdminAccount(); $this->loadUserAccount(); $this->loadEmailVerification();
            $newPass = $this->request->getPost('pass');
            $confirmPass = $this->request->getPost('cpass');
            if($newPass == $confirmPass) {
                $emailToReset = $this->session->get('emailToReset');
                $data = ['password' => password_hash($newPass, PASSWORD_DEFAULT)];
                if ($this->session->get('resetPassFor') == "admin" && $this->adminAccount->where('email', $emailToReset)->first()) {
                    $this->adminAccount->where('email', $emailToReset)->set($data)->update();
                    $this->EVerify->sendNotifPaswordReset();
                    $this->session->remove('emailToReset');
                    $this->session->remove('resetPassFor');
                    return redirect()->to('/account/successReset');
                }
                else if($this->session->get('resetPassFor') == "admin" && $this->userAccount->where('email', $emailToReset)->first()) {
                    $this->userAccount->where('email', $emailToReset)->set($data)->update();
                    $this->EVerify->sendNotifPaswordReset();
                    $this->session->remove('emailToReset');
                    $this->session->remove('resetPassFor');
                    return redirect()->to('/account/successReset');
                }
            }
            $this->session->setFlashdata('error', 'Password did not match');
            return redirect()->to('/account/createNewPass');
        }

        ## redirect to success reset page
        public function successReset() {
            return view('UserSide/successfulReset');
        }
## ----- END ----- ##

}