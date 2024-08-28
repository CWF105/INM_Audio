<?php

namespace App\Controllers;
use App\Models\admin_account_model;

class AdminControl extends BaseController
{
    public function dashboard()
    {
        return view('AdminSide\adminIndex');
    }

    public function transactions()
    {
        return view('AdminSide\adminTransactions');
    }

    public function manageusers()
    {
        return view('AdminSide\adminManageUsers');
    }

    public function products()
    {
        return view('AdminSide\adminProducts');
    }

    public function register()
    {
        return view('AdminSide\adminRegister');
    }

    
// remove/unset and destroy the current session and redirect to homepage
    public function logout() 
    {
        $session = session();
        $session->remove('account_id');
        $session->remove('username');
        $session->remove('email');
        $session->remove('isLoggedIn');

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