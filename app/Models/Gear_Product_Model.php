<?php

namespace App\Models;
use CodeIgniter\Model;

class Gear_Product_Model extends Model
{

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $allowedFields = [
        'category_id',
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'image_url' 
    ];  
    protected $useTimestamps = true; 

    public function searchGears($query) {
        return $this->select('products.*, category.category AS category')
                    ->join('category', 'products.category_id = category.category_id')
                    ->groupStart()
                        ->like('products.product_name', $query)
                        ->orWhere('products.price', $query)
                        ->orWhere('products.stock_quantity', $query)
                        ->orLike('category.category', $query)
                        ->orWhere('products.product_id', $query)
                    ->groupEnd()
                    ->findAll();
    }

    ## show only
    public function getAllPaginated($perPage) {
        return $this->orderBy('product_id', 'DESC')->paginate($perPage, 'gears');
    }
    public function countAllGears()
    {
        return $this->db->table('gears')->countAll();
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