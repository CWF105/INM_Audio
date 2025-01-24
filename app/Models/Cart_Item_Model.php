<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Models\Gear_Product_Model as gearProduct;

class Cart_Item_Model extends Model
{
    protected $table = "cart_items";
    protected $primaryKey = "cart_item_id";

    protected $allowedFields = [ 
        'cart_id',
        'product_id',
        'quantity'
    ];

    protected $useTimeStamps = true;


// Method to get cart items for a specific user
    public function getCartItems($userId)
    {
        return $this->db->table('cart_items')
            ->select('cart_items.*, products.product_name, products.price, products.image_url')
            ->join('carts', 'carts.cart_id = cart_items.cart_id')
            ->join('products', 'products.product_id = cart_items.product_id')
            ->where('carts.user_id', $userId)
            ->get()
            ->getResultArray();
    }


// return all cart items for user
    public function get_cart_items($cart)
    {
        return $this->select('cart_items.*, products.product_name, products.price, products.image_url') // Explicitly select the columns you need
            ->where('cart_items.cart_id', $cart)
            ->join('products', 'products.product_id = cart_items.product_id')->findAll();
    }



// check if product is existing by produdct id in cart
    public function checkIfProductIsExisting($cart_id, $product_id)
    {
        return $this->where('cart_id', $cart_id)->where('product_id', $product_id)->first();
    }

//get cart item by id
    public function getCartItemsById($id) {
        return $this->find($id)->first();
    }

// get product by field
    public function getProductField($field, $fieldToGet) {
        return $this->where($field, $fieldToGet)->first();
    }
//add new product
    public function addProduct($cart_id, $product_id, $quantity)
    {
        return $this->insert([
            'cart_id' => $cart_id,
            'product_id' => $product_id,
            'quantity' => $quantity
        ]);
    }



// remove product by id
    public function deleteItem($item_id)
    {
        return $this->delete($item_id);
    }



// remove product - all
    public function removeAllProduct($item_id)
    {
        return $this->where('cart_id', $item_id)->delete();
    }


//updates quantity 
    public function updateQuantity($cart_item_id, $quantity, $currentQuantity)
    {
        return $this->update($cart_item_id, ['quantity' => $currentQuantity + $quantity]);
    }

// updates quantity for existing product

}