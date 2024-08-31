<?php

namespace App\Models;

use CodeIgniter\Model;

class admin_account_model extends Model
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

    // get username if retrieve data from the database table, match with parameter $username
    public function getUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    // get email if retrieve data from the database table, match with parameter $email
    public function getEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}