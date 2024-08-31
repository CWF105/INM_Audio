<?php 

namespace App\Models;
use CodeIgniter\Model;

class products_table_model extends Model 
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


    // get gear, if match by $gear parameter
    public function getGear($gear)
    {
        return $this->where('product_name', $gear)->first();
    }

    // get all gears in the database table and return as an array
    public function getGears()
    {
        return $this->findAll();
    }

    // get all gear with category by using left joins
    public function getGearAlongWIthCategory()
    {    
       $sql = "SELECT * FROM products AS prod 
               LEFT JOIN category AS cat 
               ON cat.category_id = prod.category_id";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}