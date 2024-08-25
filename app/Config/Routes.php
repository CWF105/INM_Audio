<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*
    NOTE: The firts parameter '/' is used to route to the pages declared in the second
          parameter whic is 'Home::homepage'. and, 
          The 'Home::homepage', the 'Home' is the name of the controller, and the 'homepage'
          is the name of the method inside the Home controller where it returns the view folder and the php file. 
*/

// Home page Routing
$routes->group('', function($routes) 
{
    $routes->get('/', 'Home::homepage');
    $routes->get('/library', 'Home::library');
    $routes->get('/community', 'Home::community');
    $routes->get('/customize', 'Home::customize');

    $routes->get('/login', 'Home::login');
    
});


// shop routing
$routes->group('', function($routes){
    $routes->get('/shop', 'Shop::shop');
    $routes->get('/cart', 'Shop::cart');
    $routes->get('/buy', 'Shop::buynow');
    $routes->get('/donePurchase', 'Shop::donePurchase');
});


// account routing [admins/users]
$routes->group('/account/', function($routes){
    $routes->post('login', 'Account_Login_Signup::login_admin_or_user');
    $routes->post('signup', 'Account_Login_Signup::signup_user');
});

//admin and user account routes
$routes->group('/admin/', function($routes){
    //admins
    $routes->get('dashboard', 'AdminControl::dashboard');
    $routes->get('transactions', 'AdminControl::transactions');
    $routes->get('manageusers', 'AdminControl::manageusers');
    $routes->get('products', 'AdminControl::products');

    $routes->get('registerAd', 'AdminControl::register');
    $routes->post('registerAdminController', 'AdminControl::create_new_admin');

    $routes->get('logoutAd', 'AdminControl::logout');


    //users
});