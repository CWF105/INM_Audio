<?php

namespace App\Controllers;
use App\Models\admin_account_model;
use App\Models\user_account_model;
use Config\Session as SessionConfig;

class AdminControl extends BaseController
{



// >>>>>   NAVIGATIONS AND VALIDATIONS OF PAGES    <<<<< //
// CHECK SESSIONS AND REDIRECT
    public function checkIfSessionIsSet($admin, $ifNotSet) 
    {
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;
        $adminAccount = new admin_account_model();
        $userAdmin_id = $session->get('admin_account_id');
        $userAdmin_username = $session->get('username');
        helper('cookie');

        if(session()->get('isLoggedIn') && session()->get('account_type') === 'admin') {
            // check if user time of logged in passes the set time in session
            if($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
                $adminAccount->update($userAdmin_id, ['remember_token' => null]);
                $adminAccount->update($userAdmin_username, ['remember_token' => null]);
                $session->destroy();
                delete_cookie('remember_token');
                return redirect()->to('/');
            }
            else {    
                return view($admin);
            }
        }
        return redirect()->to($ifNotSet);
    }

// >>>>> .......... <<<<< //
// DIRECT TO ADMINISTRATOR PAGES
    // redirect to dashboard (main page after login)
    public function dashboard()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminIndex', '/');
    }


    // direct to transactions (management of tracsactions made)
    public function transactions()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminTransactions', '/');
    }


    // direct to manageusers (management of user accounts included the admin accounts)
    public function manageusers()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminManageUsers', '/');
    }


    // direct to products (management of products)
    public function products()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminProducts', '/');
    }
    public function productsTable(){        
        return view("AdminSide/others/productsTable");
    }


    // direct to register (page dedicated to the creation of administrator account)
    public function register()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminRegister', '/');
    }

    // direct to register (page dedicated to the creation of User accounts)
    public function registerUser()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminRegisterUser', '/');
    }

// >>>>>  functions to LOGOUT of admin page and redirect back to homepage(no account)
    // remove/unset and destroy the current session and redirect to homepage
    public function logout() 
    {
        $session = session();
        $adminAccount = new admin_account_model();
        helper('cookie');
        
        $userAdmin_id = $session->get('admin_account_id');
        if($userAdmin_id) {
            $adminAccount->update($userAdmin_id, ['remember_token' => null]);
        }
        
        $session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }





// >>>>>    FUNCTION FOR ADMIN PAGES     <<<<< //
    // creating new admin account
    public function create_new_admin() 
    {
        $adminAccountModel = new admin_account_model();

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $prepareData = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ];

        // Check if the username or email already exists
        $usernameExists = $adminAccountModel->checkUsername($username);
        $emailExists = $adminAccountModel->checkEmail($email);
        // redirects and set a error or success message using session
        if ($usernameExists && $emailExists) {
            session()->setFlashdata('errorAdmin', 'Both username and email are already in use.');
            return redirect()->to('/admin/registerAd');
        } elseif ($usernameExists) {
            session()->setFlashdata('errorAdmin', 'Username is already in use.');
            return redirect()->to('/admin/registerAd');
        } elseif ($emailExists) {
            session()->setFlashdata('errorAdmin', 'Email is already in use.');
            return redirect()->to('/admin/registerAd');
        } else {
            $adminAccountModel->save($prepareData);
            session()->setFlashdata('successAdmin', 'Administrator account created successfully.');
            return redirect()->to('/admin/registerAd');
        }
    }

    // creating new user account through admin panel though
    public function create_new_user()
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
                session()->setFlashdata('errorUser', 'Both username and email are already in use.');
                return redirect()->to('/admin/registerUs');
            } elseif ($usernameExist) {
                session()->setFlashdata('errorUser', 'Username is already in use.');
                return redirect()->to('/admin/registerUs');
            } elseif ($emailExist) {
                session()->setFlashdata('errorUser', 'Email is already in use.');
                return redirect()->to('/admin/registerUs');
            } else {
                $userAccount->save($prepareData);
                session()->setFlashdata('successUser', 'Account created successfully.');
                return redirect()->to('/admin/registerUs');
            }
        }

    // user account management ( managing accounts for users of this website : i will also include later the management of admin accounts)
    public function manageAccounts() 
    {

    }
}