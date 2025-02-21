<?php

namespace App\Controllers;

class ShopController extends BaseController
{
## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- SESSION ----- ##
    private function checkUserSession($path, $data = null) {
        if($this->isAdmin()) {
            return redirect()->to('/admin/dashboard');
        }
        if($this->isSessionExpired()) {
            $this->deleteCookiesAndSession("user");
            return redirect()->to('/')->with('sessionTimeout', 'Session Timeout, login again');
        }
        if($data != null) {
            return view($path, $data);
        }
        return view($path);
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- ROUTES ----- ##
    // redirect to shop
    public function shop($gears = null, $message = null){
        $this->load->requireMethod('gears');
        $this->load->requireMethod('likes');
        $user_id = $this->load->session->get('user_id');

        $container = [
            'errorMessage' => $message,
            'gears' => $gears ? $gears : $this->load->gears->getGearLeftJoinCategory(),
            'isBookmark' => $this->load->likes->getBookmarked($user_id)
        ];
        return $this->checkUserSession('shop/shop', $container);
    }



  
    // redirect to viewItem
    public function viewItem($id){
        $this->load->requireMethod('gears');
        $container = [
            'gears' => $this->load->gears->getGearLeftJoinCategory()
        ];
        return $this->checkUserSession('shop/shop#'. $id, $container);
    }

    // redirect to cart
    public function cart(){ 
        if(!$this->isUser()) {
            return redirect()->to('/');
        }       
        $this->load->requireMethod('carts');
        $this->load->requireMethod('cartItems');
        $user_id = $this->load->session->get('user_id');
        $cart = $this->load->carts->getUserCartById($user_id);
        $container = [];
        $container['cart_items'] = $this->load->cartItems->get_cart_items($cart['cart_id']);
        $totalQuantity = 0;
        $totalPrice = 0;
        foreach($container['cart_items'] as $item) {
            $totalQuantity += $item['quantity'];
            $totalPrice += $item['price'] * $item['quantity'];
        }
        $container['totalQuantity'] = $totalQuantity;
        $container['totalPrice'] = $totalPrice;
        
        return $this->checkUserSession('shop/cart2', $container);
    }

    // redirect to buynow
    public function buynow($id = null){
        if(!$this->isUser()) {
            return redirect()->to('/');
        }        
        $this->load->requireMethod('carts');
        $this->load->requireMethod('cartItems');
        $this->load->requireMethod('userAccount');

        $userIsLoggedIn = $this->load->session->get('user_id');
        if(!$userIsLoggedIn) {
            return redirect()->to('/login');
        }
        
        $user_id = $this->load->session->get('user_id');
        $items = $this->load->cartItems->getCartItems($user_id);
        $user = $this->load->userAccount->getUser('user_id', $user_id);
        if($user['address'] != null && $user['city_municipality'] != null && $user['country'] != null) {
            $location = $user['address'] . ", " . $user['city_municipality'] . ", " .  $user['country'];
        }
        else {
            $location = "<span>No location is set</span>";
        }
        return $this->checkUserSession('shop/buynow', ['cartItems' => $items,  'loc' => $location]);
    }

    // redirect to donePurchase
    public function donePurchase(){   
        return $this->checkUserSession('shop/purchase-success');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- search gear ----- $$
    public function searchGears() {
        $this->load->requireMethod('gears');
        $query = $this->request->getGet('search');
        $gears = $this->load->gears->searchGears($query);
        if($gears) {
            return $this->shop($gears);
        }
        return $this->shop($gears, '*"'. $query . '" not found!');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- CART CONTROLLERS ----- ##
    // add item to cart by id
    public function addToCart($product_id){
        $this->load->requireMethod('carts');
        $this->load->requireMethod('cartItems');
        $this->load->requireMethod('gears');
        $gearQuantity = $this->load->gears->getGear('product_id', $product_id);
        $user_id = $this->load->session->get('user_id');
        if(!$user_id) {
            return redirect()->to('/login');
        }

        $cart = $this->load->carts->checkIfCartisActive('user_id', $user_id);
        if(!$cart) {
            $cart_id = $this->load->carts->createNewCartForuser($user_id);
        }else {
            $cart_id = $cart['cart_id'];
        }

        $quantity = $this->request->getPost('quantity');
        if($quantity > $gearQuantity['stock_quantity']) {
            return redirect()->back()->with("lowstock", "low stock");
        }
        $defQuantity = 1;
        $ifItemExist = $this->load->cartItems->checkIfProductIsExisting($cart_id, $product_id); 
        if ($ifItemExist) {
            if ($quantity > 1) {
                $this->load->cartItems->updateQuantity($ifItemExist['cart_item_id'], $quantity, $ifItemExist['quantity']);
            } 
            else {
                $this->load->cartItems->updateQuantity($ifItemExist['cart_item_id'], $defQuantity, $ifItemExist['quantity']);
            }
        } 
        else {
            if($quantity > 1) {
                $this->load->cartItems->addProduct($cart_id, $product_id, $quantity);
            }
            else {
                $this->load->cartItems->addProduct($cart_id, $product_id, $defQuantity);
            }
        } 
        return redirect()->to('/shop')->with('successAddToCart', 'Item Added!');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // remove Item by ID
    public function removeItem($cart_product_id){   
        $this->load->requireMethod('cartItems');
        $this->load->cartItems->deleteItem($cart_product_id);
        return redirect()->to('/cart');
    }

    public function removeSelectedItem() {
        $this->load->requireMethod('carts');
        $this->load->requireMethod('cartItems');
        $json = $this->request->getJSON();
        $user_id = $this->load->session->get('user_id');
        $cart = $this->load->carts->getUserCartById($user_id);
        if (!empty($json->selected_items)) {
            foreach ($json->selected_items as $cart_item_id) {
                $this->load->cartItems->deleteCartItem($cart, $cart_item_id);
            }
            return $this->response->setJSON(['success' => true]);
        }
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    // remove all items to from the cart
    public function removeAllItems(){
        $this->load->requireMethod('carts');
        $this->load->requireMethod('cartItems');

        $user_id = $this->load->session->get('user_id');
        $cart = $this->load->carts->getUserCartById($user_id);
        if($cart) {
            $this->load->cartItems->removeAllProduct($cart['cart_id']);
        }
        return redirect()->to('/cart');
    }


## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- PLACING ORDER / CHECKOUT ORDER ----- ##
    public function placeOrder() {
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('gears');
        $this->load->requireMethod('carts');
        $this->load->requireMethod('cartItems');
        $this->load->requireMethod('emailVerify');
        $this->load->requireMethod('placed');

        $payment_method = $this->request->getPost('paymentMethod');
        $userId = $this->load->session->get('user_id');
        $email = $this->load->session->get('email');
        $userEmail = $this->load->userAccount->getUser('email', $email);
        $cartItems = $this->load->carts->getAllItemsById($userId);
        if( $userEmail['address'] && 
            $userEmail['city_municipality']  && 
            $userEmail['country']  &&  
            $userEmail['zipcode']) {

            if($payment_method) {
                
                if($payment_method == "gcash") {
                    $this->load->session->setFlashdata('error','*GCash payment is not currently available');
                    return redirect()->to('/buy#payment');
                }
                if($payment_method == "paypal") {
                    $this->load->session->setFlashdata('error','*GCash payment is not currently available');
                    return redirect()->to('/buy#payment');
                }

                foreach($cartItems as $items) {
                    $gear = $this->load->gears->getGear('product_id', $items['product_id']);
                    $totalQuantityPerItem = $gear['price'] * $items['quantity'];
                    $this->load->placed->save( [
                        'user_id' => $userId,
                        'product_id' => $items['product_id'],
                        'quantity' => $items['quantity'],
                        'total_price' => $totalQuantityPerItem,
                        'payment_method' => $payment_method
                    ]);
                }
                $cartId = $this->load->carts->getUserCartById($this->load->session->get('user_id'));
                $this->load->carts->db->query("DELETE FROM cart_items WHERE cart_id = " . $cartId['cart_id']);

                return  $this->load->emailVerify->sendNotifOrderPlaced($userEmail['email']);
            }
            else {
                $this->load->session->setFlashdata('error', '*Select payment method to place order');
                return redirect()->to('/buy#payment');
            }
        }
        else {
            $this->load->session->setFlashdata('error', '*please set your address in your profile setting');
            return redirect()->to('/buy#payment');
        }
    }


    ## ADD TO LIKES
    public function addToLikes($id) {
        $this->load->requireMethod('userAccount');
        $this->load->requireMethod('likes');
        
        if($this->load->session->has('isLoggedIn') && $this->load->session->has('user_id')) {
            $user_id = $this->load->session->get('user_id');
            $isSave = $this->load->likes->checkIfAlreadyBookmark($user_id, $id);
            if($isSave) {
                $this->load->likes->where('user_id', $user_id)->where('product_id', $id)->delete();
                return redirect()->to('/shop');
            }
            else {
                $data = [
                    'user_id' => $user_id,
                    'product_id' => $id
                ];
                $this->load->likes->save($data);
                return redirect()->to('/shop');
            }  
        }
        return redirect()->to('/login')->with('noAccount', '**Login to bookmark an item**');
    }
}
