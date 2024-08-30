<?php

namespace App\Controllers;
use App\Models\admin_account_model;
use App\Models\user_account_model;

class OtherControl extends BaseController
{
    public function deleteCookie()
    {
        $session = session();
        helper('cookie');
        $adminAccount = new admin_account_model();
        $userAccount = new user_account_model();

        $userAdmin_id = $session->get('user_account_id');
        $userAdmin_username = $session->get('username');
        
        $Admin_id = $session->get('admin_account_id');
        $Admin_username = $session->get('username');

        $adminAccount->where('user_id', $userAdmin_id)->update(['remember_token' => null]);
        $adminAccount->where('username', $userAdmin_username)->update(['remember_token' => null]);

        $userAccount->where('admin_account_id', $Admin_id)->update(['remember_token' => null]);
        $userAccount->where('username', $Admin_username)->update(['remember_token' => null]);


        $session->destroy();
        delete_cookie('remember_token');

        return redirect()->to('/');
    }

    public function deleteSession()
    {

    }
}