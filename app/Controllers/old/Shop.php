<?php

namespace App\Controllers;
use App\Models\admin_account_model;
use App\Models\category_table_model;
use App\Models\products_table_model;
use App\Models\user_account_model;
use Config\Session as SessionConfig;

class Shop extends BaseController
{
// check session Sessions
 
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

    
// ----------------------------------------------------------------------------------------------------------------------------------------------------- //
    // redirect to shop
    public function shop()
    {
        $checkSession = new Home();
        return $checkSession->isSessionSetThenRedirect("shop", true);
    }

// redirect to cart
     public function cart()
     {
        $checkSession = new Home();
        return $checkSession->isSessionSetThenRedirect("cart");
     }

// --------------------------------------------------------------------------------------------------------------------------//
// purchasing page
    public function buynow()
    {
        $checkSession = new Home();
        return $checkSession->isSessionSetThenRedirect( "buynow");
    }

// done purchasing / paying
    public function donePurchase() 
    {   
        $checkSession = new Home();
        return $checkSession->isSessionSetThenRedirect("purchase-success");
    }
}