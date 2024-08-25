<?php

namespace App\Controllers;
use App\Models\admin_account_model;
use App\Models\user_account_model;

class Account_Login_Signup extends BaseController
{
    // signup user controller
    public function signup_user()
    {
        $error = [];
        $fnameErr = $lnameErr = $emailErr = $phoneNumErr = $usernameErr = $passErr = "";

        $userAccount = new user_account_model();

        $firstname = $this->request->getPost('fname');
        $lastname = $this->request->getPost('lname');
        $email = $this->request->getPost('email');
        $phoneNum = $this->request->getPost('pnum');
        $username = $this->request->getPost('user');
        $password = $this->request->getPost('pass');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if(empty($firstname)) {
            $fnameErr = "firstname field is empty";
            $error[] = $fnameErr;
        }
        if(empty($lastname)) {
            $lnameErr = "firstname field is empty";
            $error[] = $lnameErr;
        }
        if(empty($email)) {
            $emailErr = "firstname field is empty";
            $error[] = $emailErr;
        }
        if(empty($phoneNum)) {
            $phoneNumErr = "firstname field is empty";
            $error[] = $phoneNumErr;
        }
        if(empty($username)) {
            $usernameErr = "firstname field is empty";
            $error[] = $usernameErr;
        }
        if(empty($password)) {
            $passErr = "firstname field is empty";
            $error[] = $passErr;
        }
        
        if(!empty($error)) {
            session()->setFlashdata('error', $error);
            return redirect()->to('/login');
        }else {
            $username = $userAccount->checkUsername($username);
            $email = $userAccount->checkEmail($email);
            if($username) {
                session()->setFlashdata('error', 'Username is already in used');
            }
            else if($email) {
                session()->setFlashdata('error', 'Email is already in used');
            }
            else if($username && $email) {
                session()->setFlashdata('error', 'both Email and Username is already in used');
            }
            else {
                $prepareData = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'phoneNum' => $phoneNum,
                    'username' => $username,
                    'password' => $password
                ];

                $userAccount->save($prepareData);
                session()->setFlashdata('success', 'Signup Successful');
                return redirect()->to('/login');
            }
        }  

        session()->setFlashdata('error', $error);
        return redirect()->to('/login');
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
            if(password_verify($password, $username['password'])) {
                session()->setFlashdata('success', 'Welcome Administrator!');
                return redirect()->to('/admin/dashboard');
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