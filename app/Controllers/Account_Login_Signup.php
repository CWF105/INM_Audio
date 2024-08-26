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

        $firstname = $this->request->getPost('fname');
        $lastname = $this->request->getPost('lname');
        $email = $this->request->getPost('email');
        $phoneNum = $this->request->getPost('pnum');
        $username = $this->request->getPost('user');
        $password = $this->request->getPost('pass');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    }







// login admin and user account
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
                // session()->setFlashdata('success', 'Welcome Administrator!');
                // return redirect()->to('/admin/dashboard');
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
                // session()->setFlashdata('success', 'Welcome Administrator!');
                // return redirect()->to('/admin/dashboard');
            }
            else {
                session()->setFlashdata('error', $error);
                return redirect()->to('/login');            
            }
        }



        // for user account
        if(false) {

        }

        session()->setFlashdata('error', $error);
        return redirect()->to('/login');
    }
}