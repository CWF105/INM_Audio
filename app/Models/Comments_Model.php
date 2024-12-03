<?php

namespace App\Models;
use CodeIgniter\Model;

class Comments_Model extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'comment_id';

    protected $allowedFields = [
        'product_id',
        'user_id',
        'comment_text',
        'rating',
        'created_at'
    ];
    protected $useTimestamps = true; 
    
    public function getAll() 
    {
        return $this->findAll();
    }
}
