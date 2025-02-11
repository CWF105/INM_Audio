<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Models\Gear_Product_Model as gearProduct;

class OrderDetailsModel extends Model
{
    protected $table = "orderDetails";
    protected $primaryKey = "order_details_id";
    protected $allowedFields = [ 
        'total_sales',
        'total_sold',
        'total_cancelled',
        'total_completed'
    ];
    protected $useTimeStamps = true;


    public function updateOrderDetails($toUpdate, $num, $op) {
        $query = $this->db->query('SELECT COUNT(*) as count FROM orderDetails');
        $hasRow = $query->getRow();
        
        if($hasRow->count == 0) {
            $this->db->query("INSERT INTO orderDetails (total_sales, total_sold, total_cancelled, total_completed) VALUES (0, 0, 0, 0)");
        }   

        $gets = $this->db->query("SELECT * FROM orderDetails WHERE order_details_id = order_details_id");
        $get = $gets->getRow();

        switch($toUpdate) {
            case "total_sales":
                $this->db->query("UPDATE orderDetails SET total_sales = total_sales {$op} {$num} WHERE order_details_id = {$get->order_details_id}");
                break;
            case "total_sold":
                $this->db->query("UPDATE orderDetails SET total_sold = total_sold {$op} {$num}  WHERE order_details_id = {$get->order_details_id}");
                break;
            case "total_completed":
                $this->db->query("UPDATE orderDetails SET total_completed = total_completed {$op} {$num}  WHERE order_details_id = {$get->order_details_id}");
                break;
            case "total_cancelled":
                $this->db->query("UPDATE orderDetails SET total_cancelled = total_cancelled {$op} {$num}  WHERE order_details_id = {$get->order_details_id}");
                break;
        }
    }
}