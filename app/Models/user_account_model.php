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
        'remember_token'
    ];
    protected $useTimeStamps = true;


// -------------------------------------------------------------------
// get all list of users
    public function getAll() 
    {
        return $this->findAll();
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

}