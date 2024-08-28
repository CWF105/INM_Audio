<?php

namespace App\Models;

use CodeIgniter\Model;

class user_account_model extends Model
{
    protected $table = 'user_accounts';
    protected $primaryKey = 'user_id';

    protected $allowedFields = [
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


    public function checkUsername($username) {
        return $this->where('username', $username)->first();
    }

    public function checkEmail($email) {
        return $this->where('email', $email)->first();
    }
}