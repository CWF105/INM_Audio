<?php

namespace App\Controllers\Helpers;
require FCPATH . '../vendor/autoload.php';
use App\Controllers\Helpers\EmailVerificationController as emailVerify;
use App\Controllers\HomeController as homeCon;
use App\Controllers\AdminController as adminCon;
use App\Controllers\Login_SignupController as logResCon;

use Config\Session as sessionConfig;
use App\Models\User_Account_Model as userAccount;
use App\Models\Admin_Account_Model as adminAccount;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gears;
use App\Models\Cart_Model as carts;
use App\Models\Cart_Item_Model as cartItems;
use App\Models\Order_Model as orders;
use App\Models\Comments_Model as comments;
use App\Models\Shipping_Model as shippings;
use App\Models\Placed_Orders_Model as placed;
use App\Models\My_Likes_Model as likes;
class LoadersController
{   
    ## GLOBAL VARIABLES ##
    public $session;
    public $sessionConfig;
    public $expirationTime;
    public $userAccount;
    public $adminAccount;
    public $categories;
    public $gears;
    public $carts;
    public $cartItems;
    public $orders;
    public $shippings;
    public $placed;
    public $likes;
    public $comments;
    public $emailVerify;
    public $logResCon;
    public $adminCon;
    public $homeCon;
    public $unsetEmailSessionVerification;
/**
 * --------------------------------------------------------------------
 *  Call this method to require some models or controllers on your class
 *  This will instantiate models and controllers to access their functions 
 *  and global variables
 * --------------------------------------------------------------------
 */
    public function requireMethod($toLoad) {
        switch($toLoad) {
            case "session":
                $this->loadSession();
                break;
            case "expirationTime":
                $this->loadExpirationTime();
                break;
            case "userAccount":
                $this->loadUserAccount();
                break;
            case "adminAccount":
                $this->loadAdminAccount();
                break;
            case "categories":
                $this->loadCategories();
                break;
            case "gears":
                $this->loadGears();
                break;
            case "likes":
                $this->loadMyLikes();
                break;
            case "carts":
                $this->loadCarts();
                break;
            case "cartItems":
                $this->loadCartItems();
                break;
            case "orders":
                $this->loadOrders();
                break;
            case "comments":
                $this->loadComments();
                break;
            case "shippings":
                $this->loadShippings();
                break;
            case "placed":
                $this->loadPlacedOrders();
                break;
            case "emailVerify":
                $this->loadEVerify();
                break;
            case "logResCon":
                $this->loadLoginSignupController();
                break;
            case "homeCon":
                $this->loadHomeController();
                break;
            case "adminCon":
                $this->loadAdminController();
                break;
            case "unsetEmailSessionVerification":
                $this->loadUnsetEmailSessionVerification();
            }
        }
    
/**
 * --------------------------------------------------------------------
 * METHODS TO LOAD FOR MODELS
 * --------------------------------------------------------------------
 */
    ## Load placed orders model ##
    private function loadPlacedOrders() {
        if(!$this->placed) {
            $this->placed = new placed();
        }
    }
    ## Load comments model ##
    private function loadComments() {
        if(!$this->comments) {
            $this->comments = new comments();
        }
    }
    ## Load shippings model ##
    private function loadShippings() {
        if(!$this->shippings) {
            $this->shippings = new shippings();
        }
    }
    ## Load Session ##
    private function loadSession() {
        if(!$this->session) {
            $this->session = Session();
        }
    }

    ## Load session expiration time ##
    private function loadExpirationTime() {
        if(!$this->expirationTime) {
            $this->sessionConfig = new sessionConfig();
            $this->expirationTime = $this->sessionConfig->expiration;
        }
    }

    ## Load User Accounts ##
    private function loadUserAccount() {
        if(!$this->userAccount) {
            $this->userAccount = new userAccount();
        }
    }

    ## Load Admin Accounts ##
    private function loadAdminAccount() {
        if(!$this->adminAccount) {
            $this->adminAccount = new adminAccount();
        }
    }

    ## Load My Likes model ##
    private function loadMyLikes() {
        if(!$this->likes) {
            $this->likes = new likes();
        }
    }
    ## Load Categories ##
    private function loadCategories() {
        if(!$this->categories) {
            $this->categories = new categories();
        }
    }

    ## Load Gears ##
    private function loadGears() {
        if(!$this->gears) {
            $this->gears = new gears();
        }
    }

    ## Load Carts ##
    private function loadCarts() {
        if(!$this->carts) {
            $this->carts = new carts();
        }
    }

    ## Load Cart Items ##
    private function loadCartItems() {
        if(!$this->cartItems) {
            $this->cartItems = new cartItems();
        }
    }

    ## Load Orders ##
    private function loadOrders() {
        if(!$this->orders) {
            $this->orders = new orders();
        }
    }

    ## Load Email Verify ##
    private function loadEVerify() {
        if(!$this->emailVerify) {
            $this->emailVerify = new emailVerify();
        }
    }


/**
 * --------------------------------------------------------------------
 * METHODS TO LOAD FOR CONTROLLERS
 * --------------------------------------------------------------------
 */
    ## Load Home Controller file
    private function loadLoginSignupController() {
        if(!$this->logResCon) {
            $this->logResCon = new logResCon();
        }
    }

    ## Load Admin Controller file
    private function loadAdminController() {
        if(!$this->adminCon) {
            $this->adminCon = new adminCon();
        }
    }

    ## Load Home Controller file
    private function loadHomeController() {
        if(!$this->homeCon) {
            $this->homeCon = new homeCon();
        }
    }


/**
 * --------------------------------------------------------------------
 * METHODS TO LOAD FOR CONTROLLERS
 * --------------------------------------------------------------------
 */
    private function loadUnsetEmailSessionVerification() {
        $this->loadSession();
        $this->session->remove(['emailSendTo', 'verification', 'verification_expiry']);
    }
}