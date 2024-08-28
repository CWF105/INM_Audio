<?php

namespace App\Controllers;

class Shop extends BaseController
{
// check session Sessions
    public function checkIfSessionIsSet($admin, $user, $ifNotSet) 
    {
        // helper('cookie');

        if(session()->get('isLoggedIn') && session()->get('account_type') === 'admin') {
            return redirect()->to($admin);
        }
        else if(session()->get('isLoggedIn') && session()->get('account_type') === 'user') {
            return redirect()->to($user);
        }
        return view($ifNotSet);
    }


    
// ----------------------------------------------------------------------------------------------------------------------------------------------------- //
    // redirect to shop
    public function shop()
    {
        $checkSession = new Home();
        return $checkSession->checkIfSessionIsSet('/admin/dashboard', '/', "shop");
    }

// redirect to cart
     public function cart()
     {
        $checkSession = new Home();
        return $checkSession->checkIfSessionIsSet('/admin/dashboard', '/', "cart");
     }

// --------------------------------------------------------------------------------------------------------------------------//
// purchasing page
    public function buynow()
    {
        $checkSession = new Home();
        return $checkSession->checkIfSessionIsSet('/admin/dashboard', '/', "buynow");
    }

// done purchasing / paying
    public function donePurchase() 
    {   
        $checkSession = new Home();
        return $checkSession->checkIfSessionIsSet('/admin/dashboard', '/', "purchase-success");
    }
}