<?php

namespace App\Controllers;
/*
## for a group of methods
# for a method


## Redirect to pages
    #homepage
    #library
    #community
    #login-and-signup
    #customize
    
OTHER METHODS
    #session

*/

use App\Models\admin_account_model;
use App\Models\category_table_model;
use App\Models\products_table_model;
use App\Models\user_account_model;

use Config\Session as SessionConfig;

class Home extends BaseController
{

    #session
    public function isSessionSetThenRedirect($page, $isDisplaying = false)
    {
        helper('cookie');
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;
        $userAccount = new user_account_model();
        $categoryModel = new category_table_model();
        $productsModel = new products_table_model();

        $user_id = $session->get('user_account_id');
        $user_username = $session->get('username');

        if($session->get('isLoggedIn') && $session->get('account_type') == 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        if($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
            $userAccount->update($user_id, ['remember_token' => null]);
            $userAccount->update($user_username, ['remember_token' => null]);
            $session->destroy();
            delete_cookie('remember_token');
            return redirect()->to('/');
        }

        if($isDisplaying == true) {
            $container = [];
            $container['categories'] = $categoryModel->getcategories();
            $container['showProducts'] = $productsModel->getGearAlongWIthCategory();
            
            return view($page, $container);
        }
        return view($page);
    }


## Redirect to Pages ##
    #homepage
    public function homepage()
    {
        return $this->isSessionSetThenRedirect('homepage');
    }


    #library
    public function library()
    {
        return $this->isSessionSetThenRedirect('library', true);
    }


    #community
    public function community()
    {
        return $this->isSessionSetThenRedirect('community', true);
    }


    #customize
    public function customize()
    {
        return $this->isSessionSetThenRedirect('customize');
    }


    #login-and-signup
    public function login()
    {
        return $this->isSessionSetThenRedirect('signup_login');
    }
}
