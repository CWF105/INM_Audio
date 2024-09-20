<?php

namespace App\Controllers;
use Config\Session as SessionConfig;
use App\Models\User_Account_Model as userAccount;
use App\Models\Category_Model as categories;
use App\Models\Gear_Product_Model as gearProduct;
use App\Models\Cart_Model as carts;
use App\Models\Cart_Item_Model as cartItems;



class ShopController extends BaseController
{
    protected $userAccount;
    protected $categories;
    protected $gearProduct;
    protected $carts;
    protected $cartItems;

// contructor //
    public function __construct()
    {
        $this->userAccount = new userAccount();
        $this->categories = new categories();
        $this->gearProduct = new gearProduct();
        $this->carts = new carts();
        $this->cartItems = new cartItems();
    }




// check if session is set to admin account, user account or is not set to any account CONTROLLER
    public function isSessionSetThenRedirect($path, $isDisplaying = false)
    {
        helper('cookie');
        $session = session();
        $sessionConfig = new SessionConfig();
        $expirationTime = $sessionConfig->expiration;


        $user_id = $session->get('user_id');
        $username = $session->get('username');

        if($session->get('type') == "admin" && $session->get('isLoggedIn') && $session->get('admin_id')) {
            return redirect()->to('/admin/dashboard');
        }

        if($session->get('timeLoggedIn') && (time() - $session->get('timeLoggedIn')) > $expirationTime) {
            $this->userAccount->update($user_id, ['remember_token' => null]);
            $this->userAccount->update($username, ['remember_token' => null]);
            delete_cookie('remember_token');
            return redirect()->to('/');
        }

        if($isDisplaying == true) {
            $container = []; 
            $container['categories'] = $this->categories->getAll();
            $container['gearsPerCategory'] = $this->gearProduct->getAll();
            $container['gears'] = $this->gearProduct->getGearLeftJoinCategory();
            $container['userAccount'] = $this->userAccount->getUser('user_id', $session->get('user_id'));

            $cart = $this->carts->getUserCartById($user_id);
            if($cart) {
                $container['cart_items'] = $this->cartItems->get_cart_items($cart['cart_id']);
                $totalQuantity = 0;
                $totalPrice = 0;

                foreach ($container['cart_items'] as $item) {
                    $totalQuantity += $item['quantity'];
                    $totalPrice += $item['price'] * $item['quantity']; 
                }
                $container['totalQuantity'] = $totalQuantity;
                $container['totalPrice'] = $totalPrice;
            }
            $container['name'] = session()->get('user_id');
            return view($path, $container);
        }
        return view($path);
    }








## ---------------------------------------------------------------------
// REDIRECTING CONTROLLERS
    public function shop()
    {
        return $this->isSessionSetThenRedirect('shop/shop', true);
    }

    public function viewItem($id)
    {
        return $this->isSessionSetThenRedirect('shop/shop#'. $id, true);
    }

    public function cart()
    {
        return $this->isSessionSetThenRedirect('shop/cart', true);
    }

    public function buynow()
    {
        return $this->isSessionSetThenRedirect('shop/buynow', true);
    }

    public function donePurchase()
    {
        return $this->isSessionSetThenRedirect('shop/purchase-success');
    }










## --------------------------------------------------------------------- 
// CART CONTROLLERS
    // add item to cart by id
    public function addToCart($product_id)
    {
        $session = session();
        $user_id = $session->get('user_id');

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
        $price = $this->request->getPost('price');
        
        $defQuantity = 1;

        $ifItemExist = $this->cartItems->checkIfProductIsExisting($cart_id, $product_id);
        
        if ($ifItemExist) {
            if ($quantity > 1) {
                $this->cartItems->updateQuantity($ifItemExist['cart_item_id'], $quantity);
            } else {
                $this->cartItems->updateQuantity($ifItemExist['cart_item_id'], $defQuantity);
            }
        } else {
            if($quantity > 1) {
                $this->cartItems->addProduct($cart_id, $product_id, $quantity);
            }else {
                $this->cartItems->addProduct($cart_id, $product_id, $defQuantity);
            }
        }
        
        return redirect()->to('/cart')->with('successAddToCart', 'Item Added!');
    }




    // remove Item by ID
    public function removeItem($cart_product_id)
    {   
        $this->cartItems->deleteItem($cart_product_id);
        return redirect()->to('/cart');
    }


    // remove all items to from the cart
    public function removeAllItems()
    {
        $session = session();
        $user_id = $session->get('user_id');

        $cart = $this->carts->getUserCartById($user_id);

        if($cart) {
            $this->cartItems->removeAllProduct($cart['cart_id']);
        }
        return redirect()->to('/cart');
    }
}