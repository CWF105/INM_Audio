<?php

namespace App\Models;

use CodeIgniter\Model;

class admin_account_model extends Model
{
    protected $table = 'admin_accounts';
    protected $primaryKey = 'admin_account_id';
    protected $allowed_fields = [
        'firstname',
        'lastname',
        'email',
        'phone_number',
        'country',
        'city_municipality',
        'zipcode',
        'address',
        'username',
        'password'
    ];
    protected $useTimestamps = true; 
}