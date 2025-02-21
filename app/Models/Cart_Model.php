<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Models\Gear_Product_Model as gearProduct;

class Cart_Model extends Model
{
    protected $table = "carts";
    protected $primaryKey = "cart_id";

    protected $allowedFields = [ 'user_id' ];
    protected $useTimeStamps = true;


    public function checkCartIfEmpty($cartId) {
        $query = $this->db->query("SELECT * FROM cart_items WHERE cart_id = $cartId");
        return $query->getResult();
    }
    
    public function getAllItemsById($id) {
        $builder = $this->db->table('carts');
        $builder->select('carts.user_id, 
                          cart_items.product_id, 
                          cart_items.quantity, 
                          COALESCE(products.price, 0) as price'); 
        $builder->join('cart_items', 'cart_items.cart_id = carts.cart_id', 'left');
        $builder->join('products', 'products.product_id = cart_items.product_id', 'left');
        $builder->where('carts.user_id', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }

//gets the cart for user by id
    public function getUserCartById($user_id)
    {
        return $this->where('user_id', $user_id)->first();
    }

// delete cart by id
    public function deleteCartById($user_id) {
        return $this->where('user_id', $user_id)->delete();
    }
    
// check if the user cart is actives
    public function checkIfCartisActive($user_id, $session_id)
    {
        return $this->where($user_id, $session_id)->first();
    }

    
// insert new user cart using cart id
    public function createNewCartForuser($user_id)
    {
        return $this->insert([
            'user_id' => $user_id
        ]);
    }

}