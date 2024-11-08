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