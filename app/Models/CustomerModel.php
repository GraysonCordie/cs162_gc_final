<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    //attributes
    protected $table = 'customer';
    protected $db;
    protected $allowedFields = ['first_name', 'last_name', 'email', 'phone', 'dob', /*'shipment_address'*/];


    //constructor
    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function insert_customer($customer = array()){

    }

    public function delete_customer($id = false){

    }

    public function update_customer($customer = array()){

    }

    public function get_customer($id = false){
        if(!$id){
            $sql = "SELECT * FROM " . $this->table;
            $query = $this->db->query($sql);
            return $query->getResult();
        }
        else{
            $sql = "SELECT * FROM " . $this->table . " WHERE customer_id='".$id."'";
            $query = $this->db->query($sql);
            return $query->getResult();
        }
    }

    public function get_custid($email = false){
        if(!$email){
            //do nothing?
        }
        else{
            $sql = "SELECT * FROM " . $this->table . " WHERE email='".$email."'";
            $query = $this->db->query($sql);
            $cust = $query->getResult();
            $id = $cust[0]->customer_id;
            return $id;
        }
    }

    public function get_columnNames(){
        return $this->db->getFieldNames($this->table);
    }
}