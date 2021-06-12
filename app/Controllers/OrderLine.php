<?php

namespace App\Controllers;
use App\Models\OrderLineModel;

class OrderLine extends BaseController
{
    private $orderLineModel;
    
    public function __construct(){
        $this->orderLineModel = new OrderLineModel();
    }

    public function create($seg1 = false){
        $data['pageTitle'] = "Add Item";
        $data['orderid'] = $seg1;
        $data['products'] = $this->orderLineModel->list_products();
    
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
            $data['next_link'] = '/orderline/create/' . $orderid;
            echo view('templates/success_message.php', $data);

        }
        else{
            echo view('order_line/create.php', $data);
            echo view('product/view', $data);

        }
        
        echo view('templates/footer.php');
    }

} 