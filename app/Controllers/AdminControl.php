<?php

namespace App\Controllers;
use App\Models\admin_account_model;
use Config\Session as SessionConfig;

class AdminControl extends BaseController
{

// check session Sessions
    public function checkIfSessionIsSet($admin, $ifNotSet) 
    {
        $control = new AdminControl();
        if(session()->get('isLoggedIn') && session()->get('account_type') === 'admin') {
            $this->lastLoggedIn();
            return view($admin);
        }
        session()->destroy();
        return redirect()->to($ifNotSet);
    }

    // check if user time of logged in passes the set time in session
    public function lastLoggedIn() 
    {
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;
        $adminAccount = new admin_account_model();
        helper('cookie');
        
        $userAdmin_id = $session->get('admin_account_id');
        if($userAdmin_id) {
            $adminAccount->update($userAdmin_id, ['remember_token' => null]);
        }
        delete_cookie('remember_token');

        if ($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
            $session->destroy();
            return redirect()->to('/');
        }
    }


    
// -------------------------------------------------------------------------------------------------------------------------
// direct to dashboard
    public function dashboard()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminIndex', '/');
    }


// direct to transactions
    public function transactions()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminTransactions', '/');
    }


// direct to manageusers
    public function manageusers()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminMangeUsers', '/');
    }


// direct to products
    public function products()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminProducts', '/');
    }


// direct to register
    public function register()
    {
        $checkSession = new AdminControl();
        return $checkSession->checkIfSessionIsSet('AdminSide/adminRegister', '/');
    }

    
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

        delete_cookie('remember_token');
        $session->destroy();    
        return redirect()->to('/');
    }





// ------------------------------------------------------------------------------------------------------------------------------------------//
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
}