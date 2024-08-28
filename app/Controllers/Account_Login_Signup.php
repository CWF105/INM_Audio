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

        $usernameOrEmail = $this->request->getPost('username');
        $password = $this->request->getPost('pass');

        $error = 'Wrong login credentials!.';

        // for administrator account
        $username = $adminAccount->checkUsername($usernameOrEmail);
        $email = $adminAccount->checkEmail($usernameOrEmail);

        if($username || $email) {
            $session = session();
            if(is_array($username) && password_verify($password, $username['password'])) {
                $session->set([
                    'account_id' => $username['admin_account_id'],
                    'username' => $username['username'],
                    'password' => $username['email'],
                    'isLoggedIn' => true
                ]);    
                $session->setFlashdata('success', 'Welcome Administrator!');
                $message['success'] = $session->getFlashdata('success');  
                return view('AdminSide/adminIndex', $message);
            }
            else if(is_array($email) && password_verify($password, $email['password'])) {
                $session->set([
                    'account_id' => $email['admin_account_id'],
                    'username' => $email['username'],
                    'password' => $email['email'],
                    'isLoggedIn' => true
                ]); 
                $session->setFlashdata('success', 'Welcome Administrator!');
                $message['success'] = $session->getFlashdata('success');  
                return view('AdminSide/adminIndex', $message);
            }
            else {
                session()->setFlashdata('error', $error);
                return redirect()->to('/login');            
            }
        }


        $username = $userAccount->checkUsername($usernameOrEmail);
        $email = $userAccount->checkEmail($usernameOrEmail);
        // for user account
        if($username || $email) {
            $session = session();
            if(is_array($username) && password_verify($password, $username['password'])) {
                $session->set([
                    'account_id' => $username['user_id'],
                    'username' => $username['username'],
                    'password' => $username['email'],
                    'isLoggedIn' => true
                ]);  
                $session->setFlashdata('success', 'Welcome' . $username["username"] . '!');
                $message['success'] = $session->getFlashdata('success');  
                return view('', $message);
            }
            else if(is_array($email) && password_verify($password, $email['password'])) {
                $session->set([
                    'account_id' => $email['user_id'],
                    'username' => $email['username'],
                    'password' => $email['email'],
                    'isLoggedIn' => true
                ]); 
                $session->setFlashdata('success', 'Welcome' . $username["username"] . '!');
                $message['success'] = $session->getFlashdata('success'); 
                return view('', $message);
            }
        }

        session()->setFlashdata('error', $error);
        return redirect()->to('/login');
    }
}