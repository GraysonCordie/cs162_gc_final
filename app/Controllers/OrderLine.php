<?php

namespace App\Controllers;
use App\Models\OrderLineModel;

class OrderLine extends BaseController
{
    private $orderLineModel;
    private $orderLineFields;
    
    public function __construct(){
        $this->orderLineModel = new OrderLineModel();
       //$this->orderLineFields = $this->orderLineModel->get_columnNames();
    }

    /* public function view($seg1 = false){
        $data['pageTitle'] = "View orders";
        $orders = $this->orderModel->get_order($seg1);
        $data['orders'] = $orders;

        echo view('templates/header.php', $data);
        echo view('order/view.php', $data);
        echo view('templates/footer.php');
    } */

    public function create($seg1 = false){
        $data['pageTitle'] = "Add Item";
        $data['orderid'] = $seg1;
    
        echo view('templates/header.php', $data);
    
        if($this->request->getMethod() === 'post' && $this->validate([
            'product_name' => 'required',
            'order_id' => 'required'
        ])){

            $orderid = $this->request->getPost('order_id');
            $product = $this->request->getPost('product_name');

            $this->orderLineModel->create_orderline($orderid, $product);
    
            $data['message'] = $product . ' was added successfully.';
            $data['callback_link'] = '/orderline/create';
            $data['next_link'] = '/orderline/create/' . $seg1;
            echo view('templates/success_message.php', $data);

        }
        else{
            echo view('order_line/create.php', $data);

        }
        
        echo view('templates/footer.php');
    }

} 