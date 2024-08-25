<?php

namespace App\Models;

use CodeIgniter\Model;

class user_account_model extends Model
{
    protected $table = 'user_accounts';
    protected $primaryKey = 'user_id';
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
    protected $useTimeStamps = true;
}