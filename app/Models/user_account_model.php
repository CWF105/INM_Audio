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

    public function getAll() 
    {
        return $this->findAll();
    }


    public function getUser($field, $toGet) 
    {
        return $this->where($field, $toGet)->first();
    }

    
    public function checkIfDataIsUsedByAnotherUser($field, $toGet, $condition)
    {
        return $this->where($field, $toGet)->where($field . $condition, $toGet)->countAllResults();
    }

}