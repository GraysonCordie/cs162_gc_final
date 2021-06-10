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

    public function insert_address($address = array()){

    }

    public function delete_address($id = false){

    }

    public function update_address($address = array()){

    }

    public function get_address($id = false){
        if(!$id){
            //if $id is false get all employees
            $sql = "SELECT * FROM " . $this->table;
            $query = $this->db->query($sql);
            return $query->getResult();
        }
        else{
            //otherwise get employee by id
            $sql = "SELECT * FROM " . $this->table . " WHERE address_id='".$id."'";
            $query = $this->db->query($sql);
            //SELECT * FROM employee WHERE id='1'
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
        //information we know
        /*
        -names of the columns
        -number of columns
        -we know how to write SQL select

        */
        //information we don't know
        /*
        -get the names of all table columns
        */
        return $this->db->getFieldNames($this->table);
    }
}