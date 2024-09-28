<?php
namespace App\Models;
use CodeIgniter\Model;

class Order_Items_Model extends Model {
    protected $table = "order_items";
    protected $primaryKey = "order_item_id";

    protected $allowedFields = [ 
        'order_id',
        'product_id	',
        'quantity',
        'price'
    ];

    protected $useTimeStamps = true;
}