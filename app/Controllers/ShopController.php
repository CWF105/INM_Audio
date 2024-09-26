<?php

namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\User_Account_Model as userAccountModel;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gears;
use App\Models\Cart_Model as cartModel;
use App\Models\Cart_Item_Model as cartItemModel;

class ShopController extends BaseController
{
    // global variables
    protected $session;
    protected $sessionConfig;
    protected $expirationTime;
    protected $userAccount;
    protected $categories;
    protected $gears;
    protected $carts;
    protected $cartItems;





## ----- THIS PREVENTS LOADING MODELS AND MEMORY ISSUES ----- ##
## call this methods to load models
    // load session method
    private function loadSession() {
        if(!$this->session) {
            $this->session = session();
        }
    }
    // load session expiration time 
    private function loadExpirationTime() {
        if(!$this->expirationTime){
            $this->sessionConfig = new SessionConfig();
            $this->expirationTime = $this->sessionConfig->expiration;
        }
    }
    // load user account model 
    private function loadUserAccount(){
        if(!$this->userAccount) {
            $this->userAccount = new userAccountModel();
        }
    }
    // load categories model
    private function loadCategories() {
        if(!$this->categories) {
            $this->categories = new categories();
        }
    }
    // load gears model
    private function loadGears() {
        if(!$this->gears) {
            $this->gears = new gears();
        }
    }
    // load carts model
    private function loadCarts() {
        if(!$this->carts) {
            $this->carts = new cartModel();
        }
    }
    // load carts model
    private function loadCartsItems() {
        if(!$this->cartItems) {
            $this->cartItems = new cartItemModel();
        }
    }
## ----- END ----- ##



## ----- FOR REDERING VIEWS AND CHECKING SESSIONS AND EXPIRATIONS ----- ##
    ## check sessions and redirect to views
    public function isSessionSetThenRedirect($path, $isDisplaying = false) {
        if($this->isAdmin()) {
            return redirect()->to('/admin/dashboard');
        }
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession();
            return redirect()->to('/');
        }
        return $this->renderView($path, $isDisplaying);
    }
         ## check if session is set to admin
        private function isAdmin(){
            $this->loadSession();
            return  $this->session->get('type') == "admin" && 
                    $this->session->get('isLoggedIn') && 
                    $this->session->get('admin_id');
        }
        ## check if session is expired
        private function isSessionExpired() {
            $this->loadSession();
            $this->loadExpirationTime();
            return  $this->session->get('timeLoggedIn') && 
                    (time() - $this->session->get('timeLoggedIn')) > $this->expirationTime;
        }
        ## delete both cookies and session
        private function deleteCookiesAndSession(){
            $this->loadSession();
            $this->loadUserAccount();
            $user_id = $this->session->get('user_id');
            $username = $this->session->get('username');
            $this->userAccount->update($user_id , ['remember_token' => null]);
            $this->userAccount->update($username, ['remember_token' => null]);
        }
        ## render view 
        private function renderView($path, $isDisplaying){
            $this->loadGears();
            $this->loadSession();
            $this->loadCategories();
            $this->loadUserAccount();
            $this->loadCarts();
            $this->loadCartsItems();

            $user_id = $this->session->get('user_id'); $username = $this->session->get('username');
            if ($isDisplaying) {
                $container = [
                    'categories' => $this->categories->getAll(),
                    'gearsPerCategory' => $this->gears->getAll(),
                    'gears' => $this->gears->getGearLeftJoinCategory()
                ];
                $cart = $this->carts->getUserCartById($user_id);
                if($cart) {
                    $container['cart_items'] = $this->cartItems->get_cart_items($cart['cart_id']);
                    $totalQuantity = 0;
                    $totalPrice = 0;
                    foreach($container['cart_items'] as $item) {
                        $totalQuantity += $item['quantity'];
                        $totalPrice += $item['price'] * $item['quantity'];
                    }
                    $container['totalQuantity'] = $totalQuantity;
                    $container['totalPrice'] = $totalPrice;
                }
                $container['name'] = $this->session->get('user_id');
                return view($path, $container);
            }
            return view($path);
        }
## ----- END ----- ##





## ----- ROUTES ----- ##
    // redirect to shop
    public function shop(){
        return $this->isSessionSetThenRedirect('shop/shop', true);
    }
    // redirect to viewItem
    public function viewItem($id){
        return $this->isSessionSetThenRedirect('shop/shop#'. $id, true);
    }
    // redirect to cart
    public function cart(){
        return $this->isSessionSetThenRedirect('shop/cart', true);
    }
    // redirect to buynow
    public function buynow(){
        return $this->isSessionSetThenRedirect('shop/buynow', true);
    }
    // redirect to donePurchase
    public function donePurchase(){
        return $this->isSessionSetThenRedirect('shop/purchase-success');
    }
## ----- END ----- ##





## ----- CART CONTROLLERS ----- ##
    // add item to cart by id
    public function addToCart($product_id){
        $this->loadSession();
        $this->loadCarts();
        $this->loadCartsItems();
        $user_id = $this->session->get('user_id');
        if(!$user_id) {
            return redirect()->to('/login');
        }

        $cart = $this->carts->checkIfCartisActive('user_id', $user_id);
        if(!$cart) {
            $cart_id = $this->carts->createNewCartForuser($user_id);
        }else {
            $cart_id = $cart['cart_id'];
        }

        $quantity = $this->request->getPost('quantity');
        // $price = $this->request->getPost('price');  
        $defQuantity = 1;
        $ifItemExist = $this->cartItems->checkIfProductIsExisting($cart_id, $product_id); 
        if ($ifItemExist) {
            if ($quantity > 1) {
                $this->cartItems->updateQuantity($ifItemExist['cart_item_id'], $quantity);
            } else {
                $this->cartItems->updateQuantity($ifItemExist['cart_item_id'], $defQuantity);
            }
        } 
        else {
            if($quantity > 1) {
                $this->cartItems->addProduct($cart_id, $product_id, $quantity);
            }
            else {
                $this->cartItems->addProduct($cart_id, $product_id, $defQuantity);
            }
        } 
        return redirect()->to('/cart')->with('successAddToCart', 'Item Added!');
    }





    // remove Item by ID
    public function removeItem($cart_product_id){   
        $this->loadCartsItems();
        $this->cartItems->deleteItem($cart_product_id);
        return redirect()->to('/cart');
    }





    // remove all items to from the cart
    public function removeAllItems(){
        $this->loadSession();
        $this->loadCarts();
        $this->loadCartsItems();
        $user_id = $this->session->get('user_id');
        $cart = $this->carts->getUserCartById($user_id);
        if($cart) {
            $this->cartItems->removeAllProduct($cart['cart_id']);
        }
        return redirect()->to('/cart');
    }
## ----- END ----- ##
}
