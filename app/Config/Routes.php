<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*
 *   NOTE: The firts parameter '/' is used to route to the pages declared in the second
 *         parameter whic is 'Home::homepage'. and, 
 *         The 'Home::homepage', the 'Home' is the name of the controller, and the 'homepage'
 *         is the name of the method inside the Home controller where it returns the view folder and the php file. 
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
    $routes->get('/shop', 'ShopController::shop');
    $routes->get('/shop/(:num)', 'ShopController::viewItem/$1');

// cart - routes for add item, viewing the cart items, delete items from the cart
    $routes->get('/cart', 'ShopController::cart');
    $routes->post('/cart/add/(:num)', 'ShopController::addToCart/$1');
    $routes->get('/cart/delete/(:num)', 'ShopController::removeItem/$1');
    $routes->post('/cart/delete', 'ShopController::removeAllItems');


    $routes->get('/buy', 'ShopController::buynow');
    $routes->get('/donePurchase', 'ShopController::donePurchase');
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

// gear management
    $routes->get('gears', 'AdminController::gearManagement');
    $routes->get('gears/addGears', 'AdminController::addGears');// redirect to gear view
    $routes->post('gears/addGear', 'AdminController::addGear'); // gear controller for adding new gear{POST}
    $routes->get('gears/removeGears/(:num)', 'AdminController::removeGear/$1'); // gear controller for removing a gear

    $routes->get('gears/addCategory', 'AdminController::addCategories'); //  redirect to category view
    $routes->post('gears/addCat', 'AdminController::addNewCategory'); // category controller for adding new category{POST}
    $routes->get('gears/removeCats/(:num)', 'AdminController::removeCategory/$1'); // category controller for removing a category

// logging out admin account
    $routes->get('loggingOut', 'AdminController::logout');

// register new admin or user account
    $routes->get('registerA', 'AdminController::register');
    $routes->post('registerAdmin', 'AdminController::createNewAdmin');

    $routes->get('registerU', 'AdminController::registerUser');
    $routes->post('registerUser', 'AdminController::createNewUser');

// admin account setting management
    $routes->post('updateAccount', 'AdminController::updateAdmin');
    $routes->get('deleteAccount/(:num)', 'AdminController::deleteAdmin/$1');

});

## ---------------------------------------------------------------------
// Users Routers
$routes->group('/user/', function($routes) {

});


## ---------------------------------------------------------------------
// trash --------------------------------------------------------
$routes->group('/config/', function($routes) {
    $routes->get('dc', 'defaultConfig::deleteCookie');
    $routes->get('ds', 'defaultConfig::deleteSession');
});