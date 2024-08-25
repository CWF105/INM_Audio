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
        'password'
    ];
    
    protected $useTimestamps = true; 

    // validate - check if username or email is already in used
    public function checkUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function checkEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}