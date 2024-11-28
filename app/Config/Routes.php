<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 
## ---------------------------------------------------------------------
// Home page Routing
$routes->group('', function($routes) {
    $routes->get('/', 'HomeController::home'); 
    $routes->get('/home', 'HomeController::home');
    $routes->get('/library', 'HomeController::library');
    $routes->get('/community', 'HomeController::community');
    $routes->get('/customize', 'HomeController::customize');
    $routes->get('/login', 'HomeController::login');
    $routes->get('/signup', 'HomeController::signup');
});


## ---------------------------------------------------------------------
// Users Routers
$routes->group('', function($routes){
    // post -------------------------------------------------------------
        $routes->post('/user/updateProfile', 'UserController::updateAccount');

    // get -------------------------------------------------------------
        $routes->get('/user/setting', 'UserController::userSettings');
        $routes->get('/user/mypurchase', 'UserController::myPurchase');
        $routes->get('/user/logout', 'UserController::logout');
});

## ---------------------------------------------------------------------
// shop routing
$routes->group('', function($routes) {
    // post -------------------------------------------------------------
        $routes->post('/cart/add/(:num)', 'ShopController::addToCart/$1');
        $routes->post('/cart/delete', 'ShopController::removeAllItems');
        $routes->post('/orderPlaced', 'ShopController::placeOrder');
        
    // get -------------------------------------------------------------
        $routes->get('/shop', 'ShopController::shop');
        $routes->get('/shop/(:num)', 'ShopController::viewItem/$1');
        $routes->get('/cart', 'ShopController::cart');
        $routes->get('/cart/delete/(:num)', 'ShopController::removeItem/$1');
        $routes->get('/buy', 'ShopController::buynow');
        $routes->get('/buy(:any)', 'ShopController::buynow/$1');
        $routes->get('/searchGears', 'ShopController::searchGears');

        $routes->get('/donePurchase', 'ShopController::donePurchase');
        // $routes->get('/checkOutFailed', 'ShopController::checkOutFailed');
});



## ---------------------------------------------------------------------
// admin routers
$routes->group('/admin/', function($routes) {
    // post-------------------------------------------------------------
        ## gear management
        $routes->post('gears/addGear', 'AdminController::addGear'); 
        $routes->post('gears/addCat', 'AdminController::addNewCategory'); 
        ## register new admin or user account
        $routes->post('registerAdmin', 'AdminController::createNewAdmin');
        $routes->post('registerUser', 'AdminController::createNewUser');
        ## admin account setting management
        $routes->post('updateAccount', 'AdminController::updateAdmin');
        ## admin transactions update/remove
        $routes->post('transaction/updateStatus', 'AdminController::updateStatus');

    // get -------------------------------------------------------------
        ## routes
        $routes->get('account', 'AdminController::account');
        $routes->get('dashboard', 'AdminController::dashboard');
        $routes->get('orders_transactions', 'AdminController::transactions');
        ## gear management
        $routes->get('management', 'AdminController::gearManagement');
        $routes->get('gears/addGears', 'AdminController::addGears');
        $routes->get('gears/removeGears/(:num)', 'AdminController::removeGear/$1');
        $routes->get('gears/addCategory', 'AdminController::addCategories'); 
        $routes->get('gears/removeCats/(:num)', 'AdminController::removeCategory/$1'); 
        $routes->get('gears/searchGears', 'AdminController::searchGears');
        ## transaction
        $routes->get('transaction/removeTransaction/(:num)', 'AdminController::removeTransaction/$1');
        $routes->get('transaction/view/(:num)', 'AdminController::viewTransaction/$1');
        ## customers
        $routes->get('customers', 'AdminController::customers');
        ## logging out admin account
        $routes->get('loggingOut', 'AdminController::logout');
        ## register new admin or user account
        $routes->get('registerA', 'AdminController::register');
        $routes->get('registerU', 'AdminController::registerUser');
        ## admin account setting management
        $routes->get('deleteAccount/(:num)', 'AdminController::deleteAdmin/$1');

});


## --------------------------------------------------------------------
// account routing [admins/users]
$routes->group('/account/', function($routes){
    // post
    $routes->post('login', 'Login_SignupController::loginAdminAndUser');
    $routes->post('resetPass', 'Login_SignupController::resetPass');
    $routes->post('signup', 'Login_SignupController::signup_user');
    $routes->post('verify-Email', 'Helpers\EmailVerificationController::checkAccount');
    $routes->post('resend-verification', 'Helpers\EmailVerificationController::resendVerificationCode');
    $routes->post('checkEmail', 'Login_SignupController::checkEmail');
    $routes->post('resetPassword', 'Login_SignupController::resetPass');
    // get
    $routes->get('verify-email', 'Helpers\EmailVerificationController::verificationPage');
    $routes->get('forgotPass', 'Login_SignupController::forgotPass');
    $routes->get('createNewPass', 'Login_SignupController::createNewPass');
    $routes->get('successReset', 'Login_SignupController::successReset');
});