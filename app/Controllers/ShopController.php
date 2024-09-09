<?php

namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\User_Account_Model as userAccount;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gearProduct;


class ShopController extends BaseController
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
        $container['gears'] = $gearProduct->getGearLeftJoinCategory();
        $container['userAccount'] = $userAccount->getUser('user_id', $session->get('user_id'));

        return view($path, $container);
    }
    return view($path);
}



## ---------------------------------------------------------------------
    public function shop()
    {
        return $this->isSessionSetThenRedirect('shop/shop', true);
    }

    public function viewItem($id)
    {
        return $this->isSessionSetThenRedirect('shop/shop#'. $id, true);
    }

    public function cart()
    {
        return $this->isSessionSetThenRedirect('shop/cart', true);
    }

    public function buynow()
    {
        return $this->isSessionSetThenRedirect('shop/buynow', true);
    }

    public function donePurchase()
    {
        return $this->isSessionSetThenRedirect('shop/purchase-success');
    }
}