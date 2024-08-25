<?php

namespace App\Controllers;

class Home extends BaseController
{
// Sessions



// ----------------------------------------------------------------------------------------------------------------------------------------------------- //
// redirect to homepage
    public function homepage()
    {
        return view("homepage");
    }


// redirect to library
    public function library()
    {
        return view("library");
    }


// redirect to community
    public function community()
    {
        return view("community");
    }


// redirect to customize
    public function customize()
    {
        return view("customize");
    }




// redirect to login and signup page
    public function login()
    {
        return view("signup_login");
    }
}
