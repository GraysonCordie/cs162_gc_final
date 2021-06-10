<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
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

    /* public function get_orderdate($orderid){
        $sql = "SELECT order_date FROM " . $this->table . 
    } */

    public function get_order($id = false){
        if(!$id){
            $sql = "SELECT * FROM " . $this->table;
            $query = $this->db->query($sql);
            return $query->getResult();
        }
        else{
            $sql = "SELECT * FROM " . $this->table . " WHERE order_id='".$id."'";
            $query = $this->db->query($sql);
            return $query->getResult();
        }
    }

    public function get_orderid($custid, $date){

            $sql = "SELECT * FROM " . $this->table . " WHERE customer_id='".$custid."' AND order_date='".$date."'";
            $query = $this->db->query($sql);
            $order = $query->getResult();
            $id = $order[0]->order_id;
            return $id;
    }

    public function set_order($orderid, $date){
        $sql = "INSERT INTO " . $this->table . " (customer_id, order_date, order_status) VALUES ('".$orderid."', '".$date."', 'New')";
        $this->db->query($sql);
    } //Used as alternative to save()

    public function get_columnNames(){
        return $this->db->getFieldNames($this->table);
    }
}