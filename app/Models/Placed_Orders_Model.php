<?php
namespace App\Models;
use CodeIgniter\Model;

class Placed_Orders_Model extends Model {
    protected $table = "placedOrders";
    protected $primaryKey = "placed_order_id";

    protected $allowedFields = [ 
        'user_id',
        'product_id	',
        'quantity',
        'total_price'
    ];
    protected $useTimeStamps = true;
    public function getAll() 
    {
        return $this->findAll();
    }

}