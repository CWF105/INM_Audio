<?php

namespace App\Models;
use CodeIgniter\Model;

class User_Account_Model extends Model
{
    protected $table = 'user_accounts';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'profile_pic',
        'firstname',
        'lastname',
        'email',
        'phone_number',
        'country',
        'city_municipality',
        'zipcode',
        'address',
        'username',
        'password',
        'activation',
        'remember_token'
    ];
    protected $useTimeStamps = true;


// -------------------------------------------------------------------
// get all list of users
    public function getAll() 
    {
        return $this->findAll();
    }

// get user by id 
    public function getUserById($id){
        return $this->where('user_id', $id)->first();
    }

// get a user by field name
    public function getUser($field, $toGet) 
    {
        return $this->where($field, $toGet)->first();
    }

// check if the data is already in used by another user or not
    public function checkIfDataIsUsedByAnotherUser($field, $toGet, $condition)
    {
        return $this->where($field, $toGet)->where($field . $condition, $toGet)->countAllResults();
    }


    public function searchUsers($val) {
       $query = $this->like('user_id', $val)
                    ->orLike('firstname', $val)
                    ->orLike('lastname', $val)
                    ->orLike('email', $val)
                    ->orLike('phone_number', $val)
                    ->orLike('country', $val)
                    ->orLike('city_municipality', $val)
                    ->orLike('zipcode', $val)
                    ->orLike('address', $val)
                    ->orLike('username', $val)
                    ->orLike('created_at', $val)
                    ->findAll();
        return $query;
    }


    public function getUserOrders($id) {
        $query = $this->db->query("
            SELECT
                o.order_id,
                o.order_status,
                p.product_name,
                o.quantity,
                o.price,
                o.payment_method,
                DATE(o.created_at) as created_at
            FROM orders o
            LEFT JOIN products p
            ON o.product_id = p.product_id
            WHERE user_id = '$id'
        ");
        return $query->getResult();
    }
}