<?php

namespace App\Controllers;
use App\Models\OrderModel;

class Order extends BaseController
{
    private $orderModel;
    private $orderFields;
    //$data['orderFields'] = $orderFields; <- used for passing into a view
    
    public function __construct(){
        $this->orderModel = new OrderModel();
        $this->orderFields = $this->orderModel->get_columnNames();
    }

    public function view($seg1 = false){
        $data['pageTitle'] = "View orders";
        $orders = $this->orderModel->get_order($seg1);
        $data['orders'] = $orders;

        echo view('templates/header.php', $data);
        echo view('order/view.php', $data);
        echo view('templates/footer.php');
    }

    public function create($seg1 = false){
        $data['pageTitle'] = "Create Order";
        $data['formFields'] = $this->orderFields;
        $data['custid'] = $seg1;
    
        echo view('templates/header.php', $data);
    
        if($this->request->getMethod() === 'post' && $this->validate([
            'customer_id' => 'required'
        ])){
            $custid = $this->request->getPost('customer_id');
            $date = date("Y-m-d");

            $this->orderModel->set_order($custid, $date);

           /*  $this->orderModel->save(
                [
                    'customer-id' => $custid,
                    'order_date' => $date,
                    'order_status' => 'New'
                ]
            ); */
            //Not working for some reason ^

            $id = $this->orderModel->get_orderid($custid, $date);
    
            $data['message'] = 'Order was created successfully. ID: ' . $id;
            $data['callback_link'] = '/order/create';
            $data['next_link'] = '/order_line/create/' . $id;
            echo view('templates/success_message.php', $data);

        }
        else{
            echo view('order/create.php', $data);

        }
        
        echo view('templates/footer.php');
    }

} 