<?php

namespace App\Controllers;
use App\Models\user_account_model;

class UserControl extends BaseController
{
    public function logout() 
    {
        $session = session();
        $userAccount = new user_account_model();
        $user_id = $session->get('user_account_id');

        if($user_id) {
            $userAccount->update($user_id, ['remember_token' => null]);
        }

        delete_cookie('remember_toker');
        $session->destroy();
        return redirect()->to('/');
    }
}
