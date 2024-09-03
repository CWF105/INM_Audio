<?php

namespace App\Models;
use CodeIgniter\Model;

class Admin_Account_Model extends Model
{
    
    protected $table = 'admin_accounts';
    protected $primaryKey = 'admin_account_id';

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'remember_token'
    ];
    protected $useTimestamps = true; 


    public function getAll() 
    {
        return $this->findAll();
    }

    public function getUser($field, $toGet) 
    {
        return $this->where($field, $toGet)->first();
    }
}