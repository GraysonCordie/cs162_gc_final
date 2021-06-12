<?php

namespace App\Controllers;
use App\Models\OrderModel;

class Order extends BaseController
{
    private $orderModel;
    private $orderFields;
    
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
            $data['next_link'] = '/orderline/create/' . $id;
            echo view('templates/success_message.php', $data);

        }
        else{
            echo view('order/create.php', $data);

        }
        
        echo view('templates/footer.php');
    }

    public function updateStatus($seg1 = false){
        $data['pageTitle'] = 'Update Order Status';
        $order = $this->orderModel->get_order($seg1);
        $data['order'] = $order;
        $data['statuses'] = $this->orderModel->get_status();

        echo view('templates/header.php', $data);

        if($this->request->getMethod() === 'post' && $this->validate([
            'order_status' => 'required'
        ])){
            $newStatus = $this->request->getPost('order_status');

            $this->orderModel->update_status($seg1, $newStatus);

            $data['message'] = "Order status has been updated to ". $newStatus;
            $data['callback_link'] = '/order/updateStatus/'. $seg1;
            $data['next_link'] = '/order/view';
            echo view('templates/success_message.php', $data);

        }
        else{
            echo view('order/update_status.php', $data);
            echo view('order/list_status', $data);
        }

        echo view('templates/footer.php');
    }

} 