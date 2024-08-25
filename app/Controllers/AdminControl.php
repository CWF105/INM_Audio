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

        $session->destroy();
        return redirect()->to('/');
    }





// ------------------------------------------------------------------------------------------------------------------------------------------//
// creating new admin account
    public function create_new_admin() 
    {
        
    }
}