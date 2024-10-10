<?php

namespace App\Models;
use CodeIgniter\Model;

class Transaction_Model extends Model
{ 
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';

    protected $allowedFields = [
        'user_id',
        'ammount',
        'payment_method',
        'status'
    ];
    protected $useTimeStamps = true;

    public function getAll() 
    {
        return $this->findAll();
    }

    public function getTransaction($transaction)
    {
        return $this->where('transactions_id', $transaction)->findAll();
    }
}