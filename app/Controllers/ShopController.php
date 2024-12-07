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
        return view($path, $data);
    }

## ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
## ----- ROUTES ----- ##
    // redirect to shop
    public function shop($gears = null, $message = null){
        $this->load->requireMethod('gears');
        $container = [
            'errorMessage' => $message,
            'gears' => $gears ? $gears : $this->load->gears->getGearLeftJoinCategory()
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
        if($cart) {
            $container['cart_items'] = $this->load->cartItems->get_cart_items($cart['cart_id']);
            $totalQuantity = 0;
            $totalPrice = 0;
            foreach($container['cart_items'] as $item) {
                $totalQuantity += $item['quantity'];
                $totalPrice += $item['price'] * $item['quantity'];
            }
            $container['totalQuantity'] = $totalQuantity;
            $container['totalPrice'] = $totalPrice;
        }
        return $this->checkUserSession('shop/cart', $container);
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
        $this->load->requireMethod('carts');
        $this->load->requireMethod('cartItems');
        $this->load->requireMethod('orders');
        $this->load->requireMethod('orderItems');
        $this->load->requireMethod('emailVerify');
        $this->load->requireMethod('transactions');

        $payment_method = $this->request->getPost('paymentMethod');
        $userId = $this->load->session->get('user_id');
        $email = $this->load->session->get('email');
        $userEmail = $this->load->userAccount->getUser('email', $email);
        $cartItem = $this->load->cartItems->getCartItems($userId);
        if($userEmail['address'] && $userEmail['city_municipality']  && $userEmail['country']  &&  $userEmail['zipcode']) {
            if($payment_method) {
                if($payment_method == "cod") {
                    $totalAmount = 0;
                    foreach ($cartItem as $item) {
                        $totalAmount += $item['price'] * $item['quantity'];
                    }
                    $orderData = [
                        'user_id' => $userId,
                        'total_amount' => $totalAmount,
                        'order_status' => 'Pending',
                        'payment_method' => $payment_method
                    ];
                    $this->load->orders->insert($orderData);
                    $orderId = $this->load->orders->insertID();
                    foreach ($cartItem as $item) {
                        $this->load->orders->db->table('order_items')->insert([
                            'order_id' => $orderId,
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price']
                        ]);
                        $this->load->carts->db->table('cart_items')
                        ->where('cart_id', $item['cart_id'])
                        ->delete();
                }
                    // $this->load->transactions->save([
                    //     'user_id' => $userId,
                    //     'ammount' => $totalAmount,
                    //     'payment_method' => "COD",
                    //     'status' => 'Pending'
                    // ]);    
                    return $this->load->emailVerify->sendNotifOrderPlaced($userEmail['email']);
                }
                else if($payment_method == "gcash") {
                    //TODO this is temporary
                    //! $this->transaction->save([
                    //!     'user_id' => $userId,
                    //!     'description' => '',
                    //!     'ammount' => $totalAmount,
                    //!     'payment_method' => "GCash",
                    //!     'status' => 'Pending'
                    //! ]);
                    $this->load->session->setFlashdata('error','*GCash payment is not currently available');
                    return redirect()->to('/buy#payment');
                }
                else if($payment_method == "paypal") {
                    // TODO this is temporary
                    //! $this->transaction->save([
                    //!     'user_id' => $userId,
                    //!     'description' => '',
                    //!     'ammount' => $totalAmount,
                    //!     'payment_method' => "Paypal",
                    //!     'status' => 'Pending'
                    //! ]);
                    $this->load->session->setFlashdata('error','*Paypal payment is not currently available');
                    return redirect()->to('/buy#payment');
                }
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
}
