<?php

namespace App\Controllers;
use App\Models\CustomerModel;

class Customer extends BaseController
{
    private $customerModel;
    private $customerFields;
    
    public function __construct(){
        $this->customerModel = new CustomerModel();
        $this->customerFields = $this->customerModel->get_columnNames();
    }

    public function view($seg1 = false){
        $data['pageTitle'] = "View Customers";
        $customers = $this->customerModel->get_customer($seg1);
        $data['customers'] = $customers;

        echo view('templates/header.php', $data);
        echo view('customer/view.php', $data);
        echo view('templates/footer.php');
    }

    public function create(){
        $data['pageTitle'] = "Create Customer";
        $data['formFields'] = $this->customerFields;

        echo view('templates/header.php', $data);

        if($this->request->getMethod() === 'post' && $this->validate([
            'first_name' => 'required|min_length[3]|max_length[30]',
            'last_name' => 'required|min_length[3]|max_length[30]',
            'email' => 'required|min_length[3]|max_length[50]',
            'phone' => 'required|min_length[7]|max_length[11]',
            //'shipment_address' => 'required'
        ])){
            $this->customerModel->save(
                [
                    'first_name' => $this->request->getPost('first_name'),
                    'last_name' => $this->request->getPost('last_name'),
                    'email' => $this->request->getPost('email'),
                    'phone' => $this->request->getPost('phone'),
                    'dob' => $this->request->getPost('dob'),
                    //'shipment_address' => $this->request->getPost('shipment_address')
                ]
            );

            $email = $this->request->getPost('email');
            $id = $this->customerModel->get_custid($email);

            $data['message'] = $this->request->getPost('first_name') . ' was created successfully. ID: ' . $id;
            $data['callback_link'] = '/customer/create';
            $data['next_link'] = '/address/create/' . $id;
            echo view('templates/success_message.php', $data);
            
        }
        else{
            echo view('customer/create.php');
        }
        
        echo view('templates/footer.php');
    }

} 