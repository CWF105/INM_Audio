<?php

namespace App\Models;
use CodeIgniter\model;

class userAccounts extends model 
{
    protected $table = 'user_accounts'; 
    protected $primaryKey = 'user_accounts_id'; 

    protected $allowedFields = [
        'firstname',
        'lastname',
        'email',
        'phone_num',
        'password'
    ];
}