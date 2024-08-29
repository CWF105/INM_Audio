<?php

namespace App\Models;
use CodeIgniter\Model;

class category_table_model extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';

    protected $allowedFields = ['category'];
    

    // retrieve all categories
    public function getcategories() 
    {
        return $this->findAll();
    }

    public function getCategory($category)
    {
        return $this->where('category', $category)->first();
    }
}