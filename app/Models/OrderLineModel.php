<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderLineModel extends OrderModel
{
    //attributes
    protected $table = 'orders';
    protected $db;
    protected $allowedFields = ['order_id', 'customer_id', 'order_date', 'paid', 'order_status'];


    //constructor
    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function create_orderline($orderid, $product){
        $date = $this->get_order($orderid)[0]->order_date;

        $sql = "INSERT INTO order_line (product_name, order_id, order_date) VALUES ('".$product."', '".$orderid."', '".$date."')";
        $this->db->query($sql);
    }

    public function list_products(){
        $sql = "SELECT * FROM product";
        $query = $this->db->query($sql);
        $products = $query->getResult();
        return $products;
    }

}