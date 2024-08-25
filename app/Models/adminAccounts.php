<?php
namespace App\Models;

use CodeIgniter\Model;

class adminAccounts extends Model 
{
    protected $table = 'admin_accounts';
    protected $primarykey = 'admin_account_id';

    protected $fields = [
        'username',
        'email',
        'password'
    ];

    protected $allowedFields = [
        'username',
        'email',
        'password'
    ];
}