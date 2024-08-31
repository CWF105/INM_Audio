<?php

namespace App\Models;
use CodeIgniter\Model;

class category_table_model extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';

    protected $allowedFields = ['category'];
    

    // retrieve and return all categories
    public function getcategories() 
    {
        return $this->findAll();
    }

    // get category if retrieve category from the database table, match with parameter $category
    public function getCategory($category)
    {
        return $this->where('category', $category)->first();
    }
}