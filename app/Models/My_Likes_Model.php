<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Models\Gear_Product_Model as gearProduct;

class My_Likes_Model extends Model
{
    protected $table = "likes";
    protected $primaryKey = "likes_id";

    protected $allowedFields = [ 
        'user_id',
        'product_id'
    ];

    public function getAll() {
        return $this->findAll();
    }
/**
 *         <img class="bookmark" src="<?= base_url('assets/img/icons/bookmark.png') ?>" alt="saved to likes">
 *       <img class="bookmark" src="<?= base_url('assets/img/icons/save-instagram.png') ?>" alt="save to likes">
 */
    public function checkIfAlreadyBookmark($user_id, $product_id) {
        return $this->where('user_id', $user_id)->where('product_id', $product_id)->first();
    }
    
    public function getLike($field, $toGet) {
        return $this->where($field, $toGet)->first();
    }    

    public function getBookmarked($id) {
        return $this->where('user_id', $id)->findAll();
    }

    public function getAllProductBookmarks() {
        $builder = $this->db->table('likes');
        $builder->select('likes.user_id,
                          likes.product_id,
                          products.image_url,
                          products.product_name,
                          products.price');
        $builder->join('products', 'products.product_id = likes.product_id', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getLikes($userId) {
        $builder = $this->db->table('likes');
        $builder->select('likes.user_id, likes.product_id');
        $builder->join('user_accounts', 'user_accounts.user_id = likes.user_id', 'left');
        $builder->join('products', 'products.product_id = likes.product_id', 'left');
        $query = $builder->get();
        $data = $query->getResultArray();
        return $data;
    }

}