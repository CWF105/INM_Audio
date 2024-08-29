<?php 

namespace App\Models;
use CodeIgniter\Model;

class products_table_model extends Model 
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $allowedFields = [
        'category_id',
        'product_name',
        'description',
        'price',
        'stock_quality',
        'image_url' 
    ];
    
    protected $useTimestamps = true; 

    // check and retrieve grears if the table is not empty
    // public function checkIfEmpty($gear, $category)
    // {
    //     if($gear != null) {

    //     }
    //     else if($category != null) {

    //     }
    //     return null;
    // }

    // public function checkEmail($email)
    // {
    //     return $this->where('email', $email)->first();
    // }
}