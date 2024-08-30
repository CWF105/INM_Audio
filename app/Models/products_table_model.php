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


    public function checkProductExistent($gear)
    {
        return $this->where('product_name', $gear)->first();
    }

    public function getProductsAlongWIthCategory()
    {
       $sql = "SELECT * FROM products as prod JOIN category as cat ON cat.category_id = prod.category_id";
       $query = $this->db->query($sql);
       return $query->getResultArray();
    }
}