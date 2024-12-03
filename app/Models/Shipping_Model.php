<?php
namespace App\Models;
use CodeIgniter\Model;

class Shipping_Model extends Model {
    protected $table = "shippings";
    protected $primaryKey = "shipping_id";

    protected $allowedFields = [ 
        'order_id',
        'address	',
        'city',
        'state',
        'price',
        'postal_code',
        'country'
    ];
    protected $useTimeStamps = true;
    public function getAll() 
    {
        return $this->findAll();
    }

}