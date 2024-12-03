<?php
namespace App\Models;
use CodeIgniter\Model;

class Order_Model extends Model {
    protected $table = "orders";
    protected $primaryKey = "order_id";

    protected $allowedFields = [ 
        'user_id',
        'product_id	',
        'order_status',
        'quantity',
        'price',
        'payment_method',
        'delivery_date',
        'date_completed',
        'date_returned',
        'date_cancelled'
    ];
    protected $useTimeStamps = true;
    public function getAll() 
    {
        return $this->findAll();
    }

}