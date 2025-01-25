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


    public function getProducts() {
        $query = $this->db->query("
            SELECT 
                p.product_id,
                p.image_url,
                p.product_name,
                c.comment_text,
                c.rating,
                u.username,
                u.firstname,
                u.lastname
            FROM 
                products p
            LEFT JOIN 
                comments c ON p.product_id = c.product_id
            LEFT JOIN 
                user_accounts u ON c.user_id = u.user_id
            ORDER BY 
                p.product_name;
        ");
        return $query->getResult();
    }

    public function getReviewByUserAndProduct($userId, $productId) {
        return $this->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first(); 
    }

    public function getCommentsByProductId($productId){
        return $this->select('comments.comment_text, comments.rating, comments.created_at, user_accounts.firstname, user_accounts.lastname')
                    ->join('user_accounts', 'comments.user_id = user_accounts.user_id')
                    ->where('comments.product_id', $productId)
                    ->findAll();
    }

    public function updateComment($userId, $productId, $data) {
        return $this->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->set($data)
                    ->update();
    }
    
    public function deleteReview($userId, $productId) {
        return $this->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->delete();
    }
}
