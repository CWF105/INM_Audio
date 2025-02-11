<?php

namespace App\Controllers;

use function PHPUnit\Framework\isEmpty;

class Login_SignupController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- SIGN UP CONTROLLER FOR USER ----- ##
    // getting the post request for input fields then setting it temporarily in session for future access and use
    // after this method it redirects to checkIfExist() method
    public function signup_user() {
        $this->load->session->set([
            'firstName' => $this->request->getPost('fname'),
            'lastName' => $this->request->getPost('lname'),
            'email' => $this->request->getPost('email'),
            'phonenumber' => $this->request->getPost('pnum'),
            'username' => $this->request->getPost('user'),
            'password' => $this->request->getPost('pass'),
            'cpassword' => $this->request->getPost('cpass'),
            'signupAccountType' => 'user'
        ]); 
        if($this->load->session->get('pass') == $this->load->session->get('cpass')) {
            return $this->checkIfExist();
        }
        else {
            $this->load->session->setFlashdata('userError', 'password did not match');
            return redirect()->to('/signup');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // check is data is existing in the database
    // then redirect back to login page, or else redirect to EmailVerificationController::sendEmailVerification() method
    private function checkIfExist(){
        $this->load->requireMethod('emailVerify');
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('adminAccount');

        $adminUsernameExist = $this->load->userAccount->getUser('username', $this->load->session->get('username'));
        $adminEmailExist = $this->load->userAccount->getUser('email', $this->load->session->get('email'));
        $userUsernameExist = $this->load->userAccount->getUser('username', $this->load->session->get('username'));
        $userEmailExist = $this->load->userAccount->getUser('email', $this->load->session->get('email'));
        if(($adminUsernameExist && $adminEmailExist) || ($userUsernameExist && $userEmailExist)) {
            $this->load->session->setFlashdata('userError', 'Both username and email are already in use.');
            return redirect()->to('/signup'); 
        }
        else if ($adminUsernameExist || $userUsernameExist) {
            $this->load->session->setFlashdata('userError', 'Username is already in use.');
            return redirect()->to('/signup');
        }
        else if ($adminEmailExist || $userEmailExist) {
            $this->load->session->setFlashdata('userError', 'Email is already in use.');
            return redirect()->to('/signup');
        }
        else {
            return $this->load->emailVerify->sendEmailVerification($this->load->session->get('email'));
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## verify if verification code is valid
    //after this method, redirects to saveData() method or redirect back to EmailVerificationController::verificationPage() method
    public function checkIfVerificationCodeIsValid($verificationCode){
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
    // save account and proceed to logged in
    // save to database table 'user_accounts' then set success message, and unset session data, then redirect to login page
    private function saveData() {
        $this->load->requireMethod('userAccount');
        $this->load->userAccount->save([
            'firstname' => $this->load->session->get('firstName'), 
            'lastname' => $this->load->session->get('lastName'), 
            'email' => $this->load->session->get('email'),
            'phone_number' => $this->load->session->get('phonenumber'),
            'username' => $this->load->session->get('username'),
            'password' => password_hash($this->load->session->get('password'), PASSWORD_DEFAULT),
            'activation' => 'activated'
        ]);
    
        $this->load->session->setFlashdata('successRegister', 'Account created successfully.');
        $this->removeTempSession(1);
        $this->load->session->setFlashdata('successRegister', 'account created');
        return redirect()->to('/login');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## -----  LOGIN CONTROLLER FOR USER ----- ##
## checks if logging in to user or admin
    public function loginAdminAndUser(){
        helper('cookie');
        ## checks if there is an account logged in
        if($this->load->session->has('isLoggedIn')) {
            return redirect()->to('/');
        }
        
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('userAccount');

        $usernameOrEmail = $this->request->getPost('username');
        $password = $this->request->getPost('pass');
        $rememberMe = $this->request->getPost('remember');

        #adminAccount
        $adminUsername = $this->load->adminAccount->getUser('username', $usernameOrEmail);
        $adminEmail = $this->load->adminAccount->getUser('email', $usernameOrEmail);

        #adminAccount
        if($adminUsername || $adminEmail) {
            if(is_array($adminUsername) && password_verify($password, $adminUsername['password'])) {
                $this->load->session->set([
                    'admin_id' => $adminUsername['admin_account_id'],
                    'username' => $adminUsername['username'],
                    'email' => $adminUsername['email'],
                    'type' => 'admin',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);    
                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $this->load->adminAccount->update($adminUsername['admin_account_id'], ['remember_token' => $token]);
                    set_cookie('remember_token', $token, 7200);  // set 300 to expires in 5 mins, set 7200 to expires in 2hrs
                }
                $this->load->session->setFlashdata('welcome_admin', 'Welcome Administrator');                
                return redirect()->to('/admin/dashboard');
            }
            else if(is_array($adminEmail) && password_verify($password, $adminEmail['password'])) {
                $this->load->session->set([
                    'admin_id' => $adminEmail['admin_account_id'],
                    'username' => $adminEmail['username'],
                    'email' => $adminEmail['email'],
                    'type' => 'admin',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);    
                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $this->load->adminAccount->update($adminEmail['admin_account_id'], ['remember_token' => $token]);
                    set_cookie('remember_token', $token, 7200);  // set 300 to expires in 5 mins, set 7200 to expires in 2hrs
                }
                $this->load->session->setFlashdata('welcome_admin', 'Welcome Administrator');
                return redirect()->to('/admin/dashboard');
            }
            else {
                $this->load->session->setFlashdata('error', 'Wrong login credentials!.');
                return redirect()->to('/login');            
            }
        }


        #userAccount
        $userUsername = $this->load->userAccount->getUser('username', $usernameOrEmail);
        $userEmail = $this->load->userAccount->getuser('email', $usernameOrEmail);

        #userLogin
        // if(!$userUsername || !$userEmail || !$adminUsername || !$adminEmail) {
        //     return redirect()->back()->with('accountTerminated', '*No account found!');
        // }
        if($userUsername || $userEmail) {
            if($userUsername['activation'] == "deactivated") {
                return redirect()->back()->with('accountTerminated', 'Account Block, Contact Administrator');
            }
            if(is_array($userUsername) && password_verify($password, $userUsername['password'])) {
                $this->load->session->set([
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
                    $this->load->userAccount->update($userUsername['user_id'], ['remember_token' => $token]);

                    // set to expires in 30 days
                    set_cookie('remember_token', $token, 3600*24*30);
                }
                $this->load->session->setFlashdata('welcome_user', 'Welcome' . $userUsername['username']);
                return redirect()->to('/');
            }
            else if(is_array($userEmail) && password_verify($password, $userEmail['password'])) {
                $this->load->session->set([
                    'user_id' => $userEmail['user_id'],
                    'username' => $userEmail['username'],
                    'email' => $userEmail['email'],
                    'type' => 'user',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]); 

                // remember me check box
                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $this->load->userAccount->update($userEmail['user_id'], ['remember_token' => $token]);

                    // set to expires in 30 days
                    set_cookie('remember_token', $token, 3600*24*30);
                }
                $this->load->session->setFlashdata('welcome_user', 'Welcome' . $userEmail['email']);
                return redirect()->to('/');
            }
        }
        $this->load->session->setFlashdata('error', 'Wrong login credentials!.');
        return redirect()->to('/login');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- FORGOT PASSWORD ----- ##
    ## forgot password
    public function forgotPass() {
        return view('UserSide/others/forgotpassword');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## check email if valid
    public function checkEmail() {
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('emailVerify');


        $emailToReset = $this->request->getPost('email');
        if($this->load->adminAccount->getUser('email', $emailToReset)) {
            $this->load->session->set(['resetPassFor' => 'admin', 'emailToReset' => $emailToReset]);
            return $this->load->emailVerify->sendEmailVerification($emailToReset);
        }
        else if($this->load->userAccount->getUser('email', $emailToReset)) {
            $this->load->session->set(['resetPassFor' => 'admin', 'emailToReset' => $emailToReset]);
            return $this->load->emailVerify->sendEmailVerification($emailToReset);
        }
        else {
            $this->load->session->setFlashdata('error', 'Invalid Email');
            return redirect()->to('/account/forgotPass');
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## verify the code then redirect to creating new pass
    public function verifyCode($verificationCode){
        $expiryTime = $this->load->session->get('verification_expiry');
    
        if ($this->load->session->get('verification') == $verificationCode) {
            if (time() < $expiryTime) {
                $this->load->requireMethod('unsetEmailSessionVerification');
                return $this->createNewPass();
            } else {
                $this->load->session->setFlashdata('userError', 'The verification code has expired.');
                return redirect()->to('/account/verify-email');
            }
        }
        $this->load->session->setFlashdata('userError', 'Invalid verification code.');
        return redirect()->to('/account/verify-email');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## create new pass after email is check and is valid
    public function createNewPass() {
        return view('UserSide/others/CreateNewPassword');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## resets password then redirect
    public function resetPass() {
        $this->load->requireMethod('adminAccount');
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('emailVerify');

        $newPass = $this->request->getPost('pass');
        $confirmPass = $this->request->getPost('cpass');
        if($newPass == $confirmPass) {
            $emailToReset = $this->load->session->get('emailToReset');
            $data = ['password' => password_hash($newPass, PASSWORD_DEFAULT)];
            if ($this->load->session->get('resetPassFor') == "admin" && $this->load->adminAccount->where('email', $emailToReset)->first()) {
                $this->load->adminAccount->where('email', $emailToReset)->set($data)->update();
                $this->load->emailVerify->sendNotifPaswordReset();
                $this->removeTempSession(2);
                return redirect()->to('/account/successReset');
            }
            else if($this->load->session->get('resetPassFor') == "admin" && $this->load->userAccount->where('email', $emailToReset)->first()) {
                $this->load->userAccount->where('email', $emailToReset)->set($data)->update();
                $this->load->emailVerify->sendNotifPaswordReset();
                $this->removeTempSession(2);
                return redirect()->to('/account/successReset');
            }
        }
        $this->load->session->setFlashdata('error', 'Password did not match');
        return redirect()->to('/account/createNewPass');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## clear session 
    private function removeTempSession($val) {
        if($val == 1) {
            $this->load->session->remove([
                'firstname', 'lastname', 'email', 'phonenumber', 'username', 'password', 'signupAccountType'
            ]);
        }
        else if($val == 2) {
            $this->load->session->remove([
                'emailToReset', 'resetPassFor'
            ]);
        }
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    ## redirect to success reset page
    public function successReset() {
        return view('UserSide/others/successfulReset');
    }
}