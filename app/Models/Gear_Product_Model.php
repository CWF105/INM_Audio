<?php

namespace App\Models;
use CodeIgniter\Model;

class Gear_Product_Model extends Model
{

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $allowedFields = [
        'category_id',
        'description',
        'product_name',
        'price',
        'stock_quantity',
        'image_url' 
    ];  
    protected $useTimestamps = true; 



    public function getAll() 
    {
        return $this->findAll();
    }

    public function getGear($field, $toGet) 
    {
        return $this->where($field, $toGet)->first();
    }

    public function getGearLeftJoinCategory()
    {    
       $sql = "SELECT * FROM products AS prod 
               LEFT JOIN category AS cat 
               ON cat.category_id = prod.category_id";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}