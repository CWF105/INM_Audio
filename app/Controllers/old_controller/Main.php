<?php

namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\User_Account_Model as userAccount;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gearProduct;


class Main extends BaseController
{
// check if session is set to admin account, user account or is not set to any account
    public function isSessionSetThenRedirect($path, $isDisplaying = false)
    {
        helper('cookie');
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;
        $userAccount = new userAccount();
        $categories = new categories();
        $gearProduct = new gearProduct();


        $user_id = $session->get('user_id');
        $username = $session->get('username');

        if($session->get('type') == "admin" && $session->get('isLoggedIn') && $session->get('admin_id')) {
            return redirect()->to('/admin/dashboard');
        }

        if($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
            $userAccount->update($user_id, ['remember_token' => null]);
            $userAccount->update($username, ['remember_token' => null]);
            delete_cookie('remember_token');
            return redirect()->to('/');
        }   

        if($isDisplaying == true) {
            $container = []; 
            $container['categories'] = $categories->getAll();
            $container['gearsPerCategory'] = $gearProduct->getAll();

            return view($path, $container);
        }
        return view($path);
    }


// logout controller
    public function logout()
    {
        helper('cookie');
        $session = session();
        $userAccount = new userAccount();
        
        $user_id = $session->get('admin_account_id');
        if($user_id) {
            $userAccount->update($user_id, ['remember_token' => null]);
        }
        
        $session->destroy();    
        delete_cookie('remember_token');
        return redirect()->to('/');
    }










## ---------------------------------------------------------------------
// redirect to homepage 
    public function homepage()
    {
        return $this->isSessionSetThenRedirect('homepage');
    }

// redirect to gear library 
    public function library()
    {
        return $this->isSessionSetThenRedirect('library', true);
    }


// redirect to  community
    public function community()
    {
        return $this->isSessionSetThenRedirect('community', true);
    }

// redirect to customize 
    public function customize()
    {
        return $this->isSessionSetThenRedirect('customize', true);
    }


// redirect to customize 
    public function login()
    {
        return $this->isSessionSetThenRedirect('signup_login');
    }










## ---------------------------------------------------------------------
// User Setting
    public function userSettings() 
    {
        return $this->isSessionSetThenRedirect('UserSide/userSettings', true);
    }
}
