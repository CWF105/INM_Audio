<?php

namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\User_Account_Model as userAccount;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gears;

class UserControl extends BaseController
{
// check if session is set to admin account or is not set to any account
    public function isSessionSetThenRedirect($path, $isDisplaying = false)
    {
        helper('cookie');
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;
        $userAccount = new userAccount();

        $user_id = $session->get('user_id');
        $username = $session->get('username');

        if($session->get('type') == "admin" && $session->get('isLoggedIn') && $session->get('admin_id')) {
            return redirect()->to('/admin/dashboard');
        }
        return view($path);
    }
}
