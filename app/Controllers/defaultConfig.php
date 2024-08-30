<?php

namespace App\Controllers;

use App\Models\admin_account_model;
use App\Models\user_account_model;
use CodeIgniter\Controller;

class defaultConfig extends Controller
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
        $token = ['remember_token' => null];

        if(!empty($token)) {
            $row = $adminAccount->where('user_id', $userAdmin_id)->update($token);

            if($row === 0) {
                return redirect()->back();
            }
            else { 
                $session->destroy();
                delete_cookie('remember_token');
                return redirect()->to('/');
            }
        }
        
        if(!empty($token)) {
            $row = $adminAccount->where('username', $userAdmin_username)->update($token);

            if($row === 0) {
                return redirect()->back();
            }
            else { 
                $session->destroy();
                delete_cookie('remember_token');
                return redirect()->to('/');
            }
        } 

        if(!empty($token)) {
            $row = $adminAccount->where('admin_account_id', $Admin_id)->update($token);

            if($row === 0) {
                return redirect()->back();
            }
            else { 
                $session->destroy();
                delete_cookie('remember_token');
                return redirect()->to('/');
            }       
        } 

        if(!empty($token)) {
            $row = $adminAccount->where('username', $Admin_username)->update($token);

            if($row === 0) {
                return redirect()->back();
            }
            else { 
                $session->destroy();
                delete_cookie('remember_token');
                return redirect()->to('/');
            }
        } 

        $session->destroy();
        delete_cookie('remember_token');

        return redirect()->to('/');
    }


    public function deleteSession()
    {

    }
}
