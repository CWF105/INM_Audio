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
use App\Models\Order_Items_Model as orderItems;
use App\Models\Transaction_Model as transactions;

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
    public $orderItems;
    public $transactions;
    public $emailVerify;
    public $logResCon;
    public $adminCon;
    public $homeCon;

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
            case "carts":
                $this->loadCarts();
                break;
            case "cartItems":
                $this->loadCartItems();
                break;
            case "orders":
                $this->loadOrders();
                break;
            case "orderItems":
                $this->loadOrderItems();
                break;
            case "transactions":
                $this->loadTransactions();
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
            }
        }
    
    /**
     * --------------------------------------------------------------------
     * METHODS TO LOAD MODELS
     * --------------------------------------------------------------------
     */
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

    ## Load Order Items ##
    private function loadOrderItems() {
        if(!$this->orderItems) {
            $this->orderItems = new orderItems();
        }
    }

    ## Load Transactions ##
    private function loadTransactions() {
        if(!$this->transactions) {
            $this->transactions = new transactions();
        }
    }

    ## Load Email Verify ##
    private function loadEVerify() {
        if(!$this->emailVerify) {
            $this->emailVerify = new emailVerify();
        }
    }

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
}