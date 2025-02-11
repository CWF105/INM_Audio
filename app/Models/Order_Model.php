<?php
namespace App\Models;
use CodeIgniter\Model;

class Order_Model extends Model {
    protected $table = "orders";
    protected $primaryKey = "order_id";

    protected $allowedFields = [ 
        'user_id',
        'product_id',
        'order_status',
        'quantity',
        'price',
        'payment_method',
        'delivery_date',
        'date_completed',
        'date_returned',
        'date_cancelled'
    ];
    protected $useTimeStamps = true;

    public function getAll() 
    {
        return $this->findAll();
    }

    public function getCancelledOrdersForUser($userId ) {
        $query = $this->db->query("
            SELECT  p.image_url,
                    p.product_name,
                    p.price,
                    u.firstname,
                    u.lastname,
                    o.order_status,
                    o.user_id,
                    o.order_id,
                    o.quantity,
                    o.price as totalPrice,
                    o.payment_method,
                    o.date_cancelled
            FROM orders o
            LEFT JOIN products p
            ON o.product_id = p.product_id
            LEFT JOIN user_accounts u
            ON o.user_id = u.user_id
            WHERE o.order_status = 'cancelled' AND o.user_id = ?", [$userId]);
        return $query->getResult();
    }


    public function getToShipOrdersForUser($userId ) {
        $query = $this->db->query("
            SELECT  p.image_url,
                    p.product_name,
                    p.price,
                    u.firstname,
                    u.lastname,
                    o.order_status,
                    o.user_id,
                    o.order_id,
                    o.quantity,
                    o.price as totalPrice,
                    o.payment_method,
                    o.date_cancelled
            FROM orders o
            LEFT JOIN products p
            ON o.product_id = p.product_id
            LEFT JOIN user_accounts u
            ON o.user_id = u.user_id
            WHERE o.order_status = 'to ship' AND o.user_id = ?", [$userId]);
        return $query->getResult();
    }

    public function getCompleteOrdersForUser($userId ) {
        $query = $this->db->query("
            SELECT  p.image_url,
                    p.product_name,
                    p.price,
                    u.firstname,
                    u.lastname,
                    o.order_status,
                    o.user_id,
                    o.order_id,
                    o.quantity,
                    o.price as totalPrice,
                    o.payment_method,
                    o.date_cancelled
            FROM orders o
            LEFT JOIN products p
            ON o.product_id = p.product_id
            LEFT JOIN user_accounts u
            ON o.user_id = u.user_id
            WHERE o.order_status = 'complete' AND o.user_id = ?", [$userId]);
        return $query->getResult();
    }

    public function getCancelledOrders() {
        $query = $this->db->query(" 
            SELECT 
                o.order_id,
                p.image_url,
                p.product_name,
                u.firstname,
                u.lastname,
                o.price as totalPrice,
                o.order_status,
                o.payment_method,
                o.quantity,
                o.date_cancelled
            FROM orders o
            LEFT JOIN products p
            ON o.product_id = p.product_id
            LEFT JOIN user_accounts u
            ON o.user_id = u.user_id
            WHERE o.order_status = 'cancelled'");
        return $query->getResult();
    }

    public function getOrders() {
        $query = $this->db->query("
            SELECT
                o.order_id,
                p.image_url,
                p.product_name,
                u.firstname,
                u.lastname,
                p.price,
                o.quantity,
                o.price AS totalPrice,
                o.payment_method,
                o.order_status,
                o.created_at
            FROM orders o
            LEFT JOIN products p
            ON o.product_id = p.product_id
            LEFT JOIN user_accounts u
            ON o.user_id = u.user_id
            WHERE o.order_status = 'to ship'");
        return $query->getResult();
    }

    public function getCompleteOrders() {
        $query = $this->db->query("
            SELECT
                o.order_id,
                p.image_url,
                p.product_name,
                u.firstname,
                u.lastname,
                p.price,
                o.quantity,
                o.price AS totalPrice,
                o.payment_method,
                o.order_status,
                o.created_at,
                o.date_completed
            FROM orders o
            LEFT JOIN products p
            ON o.product_id = p.product_id
            LEFT JOIN user_accounts u
            ON o.user_id = u.user_id
            WHERE o.order_status = 'complete'");
        return $query->getResult();
    }
    public function deleteCancelledOrdersByOrderId($orderId) {
        $query = $this->where('order_Id', $orderId)->delete();
        return $query;
    }

    public function getTotalOrders() {
        $query = $this->db->query("SELECT COUNT(*) as totalOrders FROM orders WHERE order_status != 'complete'");
        return $query->getRow();
    }
    public function getTotalConfirmed() {
        $query = $this->db->query("SELECT COUNT(*) as totalConfirmed FROM orders WHERE order_status = 'to ship'");
        return $query->getRow();
    }
    public function getTotalCancelled() {
        $query = $this->db->query("SELECT total_cancelled as totalCancelled FROM orderDetails ");
        return $query->getRow();
    }
    public function getTotalComplete() {
        $query = $this->db->query("SELECT total_completed as totalComplete FROM orderDetails");
        return $query->getRow();
    }
    public function getTotalRevenue() {
        $query = $this->db->query("SELECT SUM(total_sales) as totalRevenue FROM orderDetails");

        return $query->getRow();
    }


    public function getRecentOrders() {
        $query = $this->db->query("
            SELECT
                u.profile_pic,
                u.firstname,
                u.lastname,
                p.image_url,
                p.product_name,
                p.price as basePrice,
                o.price as totalPrice,
                DATE(o.created_at) as dateOrder,
                o.order_status
            FROM orders o
            LEFT JOIN user_accounts u
            ON o.user_id = u.user_id
            LEFT JOIN products p
            ON o.product_id = p.product_id
            GROUP BY o.created_at DESC
        ");
        return $query->getResult();
    }

    public function getOrderById($id) {
        $query = $this->db->query("SELECT * FROM orders WHERE order_id = {$id}");
        return $query->getRow();
    }
}