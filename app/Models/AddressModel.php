<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    //attributes
    protected $table = 'address';
    protected $db;
    protected $allowedFields = ['line1', 'line2', 'city', 'state', 'zip'];


    //constructor
    public function __construct(){
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function get_address($id = false){
        if(!$id){
            $sql = "SELECT * FROM " . $this->table;
            $query = $this->db->query($sql);
            return $query->getResult();
        }
        else{
            $sql = "SELECT * FROM " . $this->table . " WHERE address_id='".$id."'";
            $query = $this->db->query($sql);
            return $query->getResult();
        }
    }

    public function get_addressid($line1, $line2, $zip){
        if(!$line1){
            //do nothing?
        }
        else{
            $sql = "SELECT * FROM " . $this->table . " WHERE line1='".$line1."' AND line2='".$line2."' AND zip='".$zip."'" ;
            $query = $this->db->query($sql);
            $address = $query->getResult();
            $id = $address[0]->address_id;
            return $id;
        }
    }

    public function connect_address($custId, $addressId){
        $sql = "UPDATE customer SET shipment_address='$addressId' WHERE customer_id='$custId'";
        $this->db->query($sql);
    }

    public function get_columnNames(){
        return $this->db->getFieldNames($this->table);
    }
}