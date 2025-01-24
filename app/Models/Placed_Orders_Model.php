<?php
namespace App\Models;
use CodeIgniter\Model;

class Placed_Orders_Model extends Model {
    protected $table = "placedOrders";
    protected $primaryKey = "placed_order_id";

    protected $allowedFields = [ 
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'payment_method'
    ];
    protected $useTimeStamps = true;
    public function getAll() 
    {
        return $this->findAll();
    }

    public function getAllOrdersById($id) {
        $query = $this->db->query("
            SELECT p.product_name,
                   p.product_id,
                   p.image_url,
                   p.price,
                   po.quantity,
                   po.total_price,
                   po.payment_method
            FROM placedOrders po
            LEFT JOIN products p
            ON po.product_id = p.product_id
            WHERE po.user_id = ?", [$id]);
        return $query->getResult();
    }

    public function getAllOrders() {
        $query = $this->db->query("
            SELECT  po.placed_order_id,
                    p.product_name,
                    p.image_url,
                    p.price,
                    u.firstname,
                    u.lastname,
                    po.quantity,
                    po.total_price,
                    po.payment_method,
                    po.date_placed
            FROM placedorders po
            LEFT JOIN products p
            ON po.product_id = p.product_id
            LEFT JOIN user_accounts u
            ON po.user_id = u.user_id
            ");
        return $query->getResult();
    }


    public function getOrderItemById($product_id = null) {
        $query = "";
        if($product_id != null) {
            $query = $this->db->query("SELECT * FROM placedOrders WHERE product_id = '$product_id'");
        }
        else {
            $query = $this->db->query("SELECT * FROM placedOrders");
        }
        return $query->getRow();
    }


    public function getOrderItemByPlaceOrderId($placedOrderId) {
        $query = $this->db->query("SELECT * FROM placedorders WHERE placed_order_id = '$placedOrderId'");
        return $query->getRow();
    }


    public function deleteItemByProductId($product_id) {
        $query = $this->where('product_id', $product_id)->delete();
        return $query;
    }


    public function deleteItemByPlacedOrderId($placedOrderId) {
        $query = $this->where('placed_order_id', $placedOrderId)->delete();
        return $query;
    }   

    public function getTotalPlaced() {
        $query = $this->db->query("SELECT COUNT(*) as totalPlacedOrders FROM placedorders");
        return $query->getRow();
    }
}