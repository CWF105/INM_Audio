<?php
namespace App\Models;
use CodeIgniter\Model;

class Order_Model extends Model {
    protected $table = "orders";
    protected $primaryKey = "order_id";

    protected $allowedFields = [ 
        'user_id',
        'total_amount',
        'order_status',
        'payment_method'
    ];

    protected $useTimeStamps = true;
}
