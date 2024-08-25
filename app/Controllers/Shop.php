<?php

namespace App\Controllers;

class Shop extends BaseController
{
    // redirect to shop
    public function shop()
    {
        return view("shop");
    }


// redirect to cart
     public function cart()
     {
         return view("cart");
     }

// --------------------------------------------------------------------------------------------------------------------------//
// purchasing page
    public function buynow()
    {
        return view("buynow");
    }

// done purchasing / paying
    public function donePurchase() 
    {   
        return view('purchase-success');
    }
}