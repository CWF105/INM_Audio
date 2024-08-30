<?php

namespace App\Controllers;
use App\Models\admin_account_model;
use App\Models\user_account_model;

use Config\Session as SessionConfig;

class Home extends BaseController
{
// check session Sessions
    public function checkIfSessionIsSet($admin, $user, $ifNotSet) 
    {
        // helper('cookie');
        // $session = session();
        // $sessionConfig = new SessionConfig();
        // $expirationTime = $sessionConfig->expiration;
        // $adminAccount = new admin_account_model();
        // $userAccount = new user_account_model();

        // $userAdmin_id = $session->get('admin_account_id');
        // $userAdmin_username = $session->get('username');
        // $user_id = $session->get('user_account_id');
        // $user_username = $session->get('username');

        if(session()->get('isLoggedIn') && session()->get('account_type') === 'admin') {
            return redirect()->to($admin);
        }
        else if(session()->get('isLoggedIn') && session()->get('account_type') === 'user') {
            return redirect()->to($user);
        }
        return view($ifNotSet);
    }



// ----------------------------------------------------------------------------------------------------------------------------------------------------- //
// redirect to homepage
    public function homepage()
    {
        $checkSession = new Home();
        return $checkSession->checkIfSessionIsSet('/admin/dashboard', '/', "homepage");
    }


// redirect to library
    public function library()
    {
        $checkSession = new Home();
        return $checkSession->checkIfSessionIsSet('/admin/dashboard','/','library');
    }


// redirect to community
    public function community()
    {
        $checkSession = new Home();
        return $checkSession->checkIfSessionIsSet('/admin/dashboard','/','community');
    }


// redirect to customize
    public function customize()
    {
        $checkSession = new Home();
        return $checkSession->checkIfSessionIsSet('/admin/dashboard','/','customize');
    }




// redirect to login and signup page
    public function login()
    {
        $checkSession = new Home();
        return $checkSession->checkIfSessionIsSet('/admin/dashboard','/','signup_login');
    }
}
