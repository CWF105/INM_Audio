<?php

namespace App\Models;

use CodeIgniter\Model;

class user_account_model extends Model
{
    protected $table = 'user_accounts';
    protected $primaryKey = 'user_id';
    protected $allowed_fields = [
        'username', 
        'email',
        'password'
    ];
    protected $useTimeStamps = true;
}