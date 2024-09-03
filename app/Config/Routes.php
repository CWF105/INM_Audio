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



## ---------------------------------------------------------------------
// Home page Routing
$routes->group('', function($routes) 
{
    $routes->get('/', 'Main::homepage');
    $routes->get('/library', 'Main::library');
    $routes->get('/community', 'Main::community');
    $routes->get('/customize', 'Main::customize');

    $routes->get('/login', 'Main::login');
});

## ---------------------------------------------------------------------
// shop routing
$routes->group('', function($routes){
    $routes->get('/shop', 'Shop::shop');
    $routes->get('/cart', 'Shop::cart');
    $routes->get('/buy', 'Shop::buynow');
    $routes->get('/donePurchase', 'Shop::donePurchase');
});

## ---------------------------------------------------------------------
// account routing [admins/users]
$routes->group('/account/', function($routes){
    $routes->post('signup', 'Login_SignupController::signup_user');
    $routes->post('login', 'Login_SignupController::loginAdminAndUser');
});

## ---------------------------------------------------------------------
// admin routers
$routes->group('/admin/', function($routes) {
    $routes->get('accountSetting', 'AdminController::accountSetting');
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('transactions', 'AdminController::transactions');
    $routes->get('gears', 'AdminController::gearManagement');
    
    // logging out admin account
    $routes->get('loggingOut', 'AdminController::logout');

    // register new admin or user account
    $routes->get('registerA', 'AdminController::register');
    $routes->get('registerU', 'AdminController::registerUser');

});



//admin and user account routes
$routes->group('/admin/', function($routes){
    //admins
    $routes->get('dashboard', 'AdminControl::dashboard');
    $routes->get('transactions', 'AdminControl::transactions');
    $routes->get('manageusers', 'AdminControl::manageusers');

    //products
    $routes->get('products', 'AdminControl::products');
    //add products
    $routes->post('products/add', 'AdminControl::addGears');

    //category
    $routes->post('category', 'AdminControl::addNewCategory');

    // register view and controller for admin
    $routes->get('registerAd', 'AdminControl::register');
    $routes->post('registerAdminController', 'AdminControl::create_new_admin');
    // register view and controller for user in admin
    $routes->get('registerUs', 'AdminControl::registerUser');
    $routes->post('registerUserController', 'AdminControl::create_new_user');

    $routes->get('logoutAd', 'AdminControl::logout');


    //users
});





$routes->group('/config/', function($routes) {
    $routes->get('dc', 'defaultConfig::deleteCookie');
    $routes->get('ds', 'defaultConfig::deleteSession');
});