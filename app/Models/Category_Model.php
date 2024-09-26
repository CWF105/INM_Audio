<?php

namespace App\Models;
use CodeIgniter\Model;

class Category_Model extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';

    protected $allowedFields = ['category'];
    


// retrieve and return all categories
    public function getAll() 
    {
        return $this->findAll();
    }


// get category by field/column
    public function getCategory($field, $toGet) 
    {
        return $this->where($field, $toGet)->first();
    }

}