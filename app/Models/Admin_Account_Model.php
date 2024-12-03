<?php

namespace App\Models;
use CodeIgniter\Model;

class Admin_Account_Model extends Model
{
    
    protected $table = 'admin_accounts';
    protected $primaryKey = 'admin_account_id';

    protected $allowedFields = [
        'profile_pic',
        'username',
        'email',
        'password',
        'remember_token'
    ];
    protected $useTimestamps = true; 


// get all admin accounts
    public function getAll() 
    {
        return $this->findAll();
    }

// get admin account by field/column
    public function getUser($field, $toGet) 
    {
        return $this->where($field, $toGet)->first();
    }


// check if the data is used by another user
    public function checkIfDataIsUsedByAnotherUser($field, $toGet, $condition)
    {
        return $this->where($field, $toGet)->where($field . $condition, $toGet)->countAllResults();
    }
}