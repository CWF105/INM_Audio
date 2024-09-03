<?php

namespace App\Controllers;
use App\Models\Admin_Account_Model as adminAccount;
use App\Models\User_Account_Model as userAccount;

class Login_SignupController extends BaseController
{
## ---------------------------------------------------------------------
//signup user controller
    public function signup_user()
    {
        $userAccount = new userAccount();
        $session = session();
        $firstName = $this->request->getPost('fname');
        $lastName = $this->request->getPost('lname');
        $email = $this->request->getPost('email');
        $phonenumber = $this->request->getPost('pnum');
        $username = $this->request->getPost('user');
        $password = $this->request->getPost('pass');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $prepareData = [
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'phone_number' => $phonenumber,
            'username' => $username,
            'password' => $hashedPassword
        ];

        $usernameExist = $userAccount->getUser('username', $username);
        $emailExist = $userAccount->getUser('email', $email);

        if ($usernameExist && $emailExist) {
            $session->setFlashdata('userError1', 'Both username and email are already in use.');
            return redirect()->to('/login');
        }
        elseif ($usernameExist) {
            $session->setFlashdata('userError2', 'Username is already in use.');
            return redirect()->to('/login');
        } 
        elseif ($emailExist) {
            $session->setFlashdata('userError3', 'Email is already in use.');
            return redirect()->to('/login');
        } 
        else {
            $userAccount->save($prepareData);
            $session->setFlashdata('successRegister', 'Account created successfully.');
            return redirect()->to('/login');
        }
    }


## ---------------------------------------------------------------------
// login controller - for admin and user
    public function loginAdminAndUser()
    {
        $adminAccount = new adminAccount();
        $userAccount = new userAccount();
        helper('cookie');
        $session = session();

        $usernameOrEmail = $this->request->getPost('username');
        $password = $this->request->getPost('pass');
        $rememberMe = $this->request->getPost('remember');

        $error = 'Wrong login credentials!.';
        $welcome = "Welcome Administrator";

        #adminAccount
        $adminUsername = $adminAccount->getUser('username', $usernameOrEmail);
        $adminEmail = $adminAccount->getUser('email', $usernameOrEmail);

        if($adminUsername || $adminEmail) {
            if(is_array($adminUsername) && password_verify($password, $adminUsername['password'])) {
                $session->set([
                    'admin_id' => $adminUsername['admin_account_id'],
                    'username' => $adminUsername['username'],
                    'email' => $adminUsername['email'],
                    'type' => 'admin',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);    

                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $adminAccount->update($adminUsername['admin_account_id'], ['remember_token' => $token]);
                    set_cookie('remember_token', $token, 7200);  // set 300 to expires in 5 mins, set 7200 to expires in 2hrs
                }
                $session->setFlashdata('welcome', $welcome);                
                return redirect()->to('/admin/dashboard');
            }
            else if(is_array($adminEmail) && password_verify($password, $adminEmail['password'])) {
                $session->set([
                    'admin_id' => $adminEmail['admin_account_id'],
                    'username' => $adminEmail['username'],
                    'email' => $adminEmail['email'],
                    'type' => 'admin',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);    

                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $adminAccount->update($adminEmail['admin_account_id'], ['remember_token' => $token]);
                    set_cookie('remember_token', $token, 7200);  // set 300 to expires in 5 mins, set 7200 to expires in 2hrs
                }
                $session->setFlashdata('welcome', $welcome);
                return redirect()->to('/admin/dashboard');
            }
            else {
                session()->setFlashdata('error', $error);
                return redirect()->to('/login');            
            }
        }

        #userLogin
        $userUsername = $userAccount->getUser('username', $usernameOrEmail);
        $userEmail = $userAccount->getuser('email', $usernameOrEmail);
        if($userUsername || $userEmail) {
            $session = session();
            if(is_array($userUsername) && password_verify($password, $userUsername['password'])) {
                $session->set([
                    'user_account_id' => $userUsername['user_id'],
                    'username' => $userUsername['username'],
                    'email' => $userUsername['email'],
                    'type' => 'user',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);  

                // remember me check box
                if(isset($rememberMe)) {
                    $token = bin2hex(random_bytes(16));
                    $userAccount->update($userUsername['user_id'], ['remember_token' => $token]);
    
                    // set to expires in 30 days
                    set_cookie('remember_token', $token, 3600*24*30);
                    return redirect()->to('/');
                }
                return redirect()->to('/');
            }
            else if(is_array($userEmail) && password_verify($password, $userEmail['password'])) {
                $session->set([
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
                    $userAccount->update($userEmail['user_id'], ['remember_token' => $token]);
    
                    // set to expires in 30 days
                    set_cookie('remember_token', $token, 3600*24*30);
                    return redirect()->to('/');
                }
                return redirect()->to('/');
            }
        }
        $session->setFlashdata('error', $error);
        return redirect()->to('/login');
        }
    }
