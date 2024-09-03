<?php

namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\Admin_Account_Model as adminAccount;
use App\Models\User_Account_Model as userAccount;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gears;

class AdminController extends BaseController
{
// check if session is set to admin account or is not set to any account
    public function isSessionSetThenRedirect($path, $isDisplaying = false)
    {
        helper('cookie');
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;
        $adminAccount = new adminAccount();

        $admin_id = $session->get('admin_id');
        $username = $session->get('username');

        if(!$session->get('isLoggedIn') && !$session->get('type')) {
            return redirect()->to('/');
        }

        if($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
            $adminAccount->update($admin_id, ['remember_token' => null]);
            $adminAccount->update($username, ['remember_token' => null]);
            $session->destroy();
            delete_cookie('remember_token');
            return redirect()->to('/');
        }

        if($session->get('type') !== "admin" && !$session->get('isLoggedIn') && !$session->get('admin_id'))
        {
            $session->destroy();
            return redirect()->to('/');
        }

        if($isDisplaying == true) {
            $container = [];
            return view($path, $container);
        }
        return view($path);
    }


// logout controller
    public function logout()
    {
        helper('cookie');
        $session = session();
        $adminAccount = new adminAccount();
        
        $admin_id = $session->get('admin_account_id');
        if($admin_id) {
            $adminAccount->update($admin_id, ['remember_token' => null]);
        }
        
        $session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }










## ---------------------------------------------------------------------
// redirect to dashboard
    public function dashboard() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/dashboard'); 
    }


// redirect to transactions
    public function transactions() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/transactions'); 
    }


// redirect to gearManagement
    public function gearManagement() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/gearManagement'); 
    }


// redirect to register
    public function register() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/registerA'); 
    }


// redirect to registerUser
    public function registerUser() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/registerU'); 
    }


// redirect to accountSetting
    public function accountSetting() 
    { 
        return $this->isSessionSetThenRedirect('AdminSide/accountSetting'); 
    }









## ---------------------------------------------------------------------
// create admin account
    public function createNewAdmin()
    {
        
    }


// create user account
    public function createNewUser()
    {

    }
}