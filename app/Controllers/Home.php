<?php

namespace App\Controllers;
use Config\Session as SessionConfig;

class Home extends BaseController
{
// check session Sessions
    public function checkIfSessionIsSet($admin, $user, $ifNotSet) 
    {
        $control = new Home();
        if(session()->get('isLoggedIn') && session()->get('account_type') === 'admin') {
            $this->lastLoggedIn();
            return redirect()->to($admin);
        }
        else if(session()->get('isLoggedIn') && session()->get('account_type') === 'user') {
            $this->lastLoggedIn();
            return redirect()->to($user);
        }
        return view($ifNotSet);
    }

    // check if user time of logged in passes the set time in session
    public function lastLoggedIn() 
    {
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;

        if ($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
            $session->destroy();
            return redirect()->to('/');
        }
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
