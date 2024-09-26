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


    ## show only
    public function getAllPaginated($perPage) {
        return $this->orderBy('product_id', 'DESC')->paginate($perPage, 'gears');
    }


    public function getAll() 
    {
        return $this->findAll();
    }

    public function getPerCategory($categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
    }

    public function getGear($field, $toGet) 
    {
        return $this->where($field, $toGet)->first();
    }


    public function removeGear($field = null, $toRemove)
    {
        if(empty($field)) {
            return $this->delete($toRemove);
        }
        return $this->delete($field, $toRemove);
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