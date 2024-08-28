<?php

namespace App\Controllers;
use App\Models\admin_account_model;
use App\Models\user_account_model;

class Account_Login_Signup extends BaseController
{

    // signup user controller
    public function signup_user()
    {
        $userAccount = new user_account_model();
        
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

        
        // Check if the username or email already exists
        $usernameExist = $userAccount->checkUsername($username);
        $emailExist = $userAccount->checkEmail($email);

        if ($usernameExist && $emailExist) {
            session()->setFlashdata('userError1', 'Both username and email are already in use.');
            return redirect()->to('/login');
        } elseif ($usernameExist) {
            session()->setFlashdata('userError2', 'Username is already in use.');
            return redirect()->to('/login');
        } elseif ($emailExist) {
            session()->setFlashdata('userError3', 'Email is already in use.');
            return redirect()->to('/login');
        } else {
            $userAccount->save($prepareData);
            session()->setFlashdata('successRegister', 'Account created successfully.');
            return redirect()->to('/login');
        }
    }







// login admin and user account and set session
    public function login_admin_or_user() 
    {
        $adminAccount = new admin_account_model();
        $userAccount = new user_account_model();
        helper('cookie');

        $usernameOrEmail = $this->request->getPost('username');
        $password = $this->request->getPost('pass');
        $rememberMe = $this->request->getPost('remember');

        $error = 'Wrong login credentials!.';

        // for administrator account
        $usernameA = $adminAccount->checkUsername($usernameOrEmail);
        $emailA = $adminAccount->checkEmail($usernameOrEmail);

        if($usernameA || $emailA) {
            $session = session();
            if(is_array($usernameA) && password_verify($password, $usernameA['password'])) {
                $session->set([
                    'admin_account_id' => $usernameA['admin_account_id'],
                    'username' => $usernameA['username'],
                    'password' => $usernameA['email'],
                    'account_type' => 'admin',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);    

                if($rememberMe) {
                    $token = bin2hex(random_bytes(16));
                    $adminAccount->update($usernameA['admin_account_id'], ['remember_token' => $token]);
    
                    // set to expires in 5 mins
                    set_cookie('remember_token', $token, 300);
                    $session->setFlashdata('success', 'Welcome Administrator!');
                    return redirect()->to('/admin/dashboard');
                }

                $session->setFlashdata('success', 'Welcome Administrator!');                
                return redirect()->to('/admin/dashboard');
            }
            else if(is_array($emailA) && password_verify($password, $emailA['password'])) {
                $session->set([
                    'admin_account_id' => $emailA['admin_account_id'],
                    'username' => $emailA['username'],
                    'password' => $emailA['email'],
                    'account_type' => 'admin',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]); 

                if($rememberMe) {
                    $token = bin2hex(random_bytes(16));
                    $adminAccount->update($usernameA['admin_account_id'], ['remember_token' => $token]);
    
                    // set to expires in 5 mins
                    set_cookie('remember_token', $token, 300);
                    $session->setFlashdata('success', 'Welcome Administrator!');                    
                    return redirect()->to('/admin/dashboard');
                }

                $session->setFlashdata('success', 'Welcome Administrator!');
                return redirect()->to('/admin/dashboard');
            }
            else {
                session()->setFlashdata('error', $error);
                return redirect()->to('/login');            
            }
        }

        $usernameU = $userAccount->checkUsername($usernameOrEmail);
        $emailU = $userAccount->checkEmail($usernameOrEmail);
        // for user account
        if($usernameU || $emailU) {
            $session = session();
            if(is_array($usernameU) && password_verify($password, $usernameU['password'])) {
                $session->set([
                    'user_account_id' => $usernameU['user_id'],
                    'username' => $usernameU['username'],
                    'password' => $usernameU['email'],
                    'account_type' => 'user',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]);  
                $session->setFlashdata('success', 'Welcome' . $usernameU["username"] . '!');

                // remember me check box
                if($rememberMe) {
                    $token = bin2hex(random_bytes(16));
                    $userAccount->update($usernameU['user_id'], ['remember_token' => $token]);
    
                    // set to expires in 30 days
                    set_cookie('remember_token', $token, 3600*24*30);
                    return redirect()->to('');
                }
                return redirect()->to('');
            }
            else if(is_array($emailU) && password_verify($password, $emailU['password'])) {
                $session->set([
                    'user_account_id' => $emailU['user_id'],
                    'username' => $emailU['username'],
                    'password' => $emailU['email'],
                    'account_type' => 'user',
                    'timeLoggedIn' => time(),
                    'isLoggedIn' => true
                ]); 
                $session->setFlashdata('success', 'Welcome' . $usernameU["username"] . '!');

                // remember me check box
                if($rememberMe) {
                    $token = bin2hex(random_bytes(16));
                    $userAccount->update($usernameU['user_id'], ['remember_token' => $token]);
    
                    // set to expires in 30 days
                    set_cookie('remember_token', $token, 3600*24*30);
                    return redirect()->to('');
                }
                return redirect()->to('');
            }
        }

        session()->setFlashdata('error', $error);
        return redirect()->to('/login');
    }
}