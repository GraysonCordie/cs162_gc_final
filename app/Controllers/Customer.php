<?php

namespace App\Controllers;
use App\Models\CustomerModel;

class Customer extends BaseController
{
    private $customerModel;
    private $customerFields;
    //$data['customerFields'] = $customerFields; <- used for passing into a view
    
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
            
            //echo ($this->request->getPost('firstName') . ' was created successfully.');
        }
        else{
            echo view('customer/create.php');
        }
        
        echo view('templates/footer.php');
    }

    /* public function update($seg1 = false){
        $data['pageTitle'] = "Update Employee";
        $data['formFields'] = $this->customerFields;

        echo view('templates/header.php', $data);

        if(!$seg1) {
            //reject navigation to this page if an employee isn't selected
            $data['message'] = "An employee must be selected.";
            $data['callback_link'] = "/employee";
            echo view('templates/error_message.php', $data);
        }
        else{
            //if employee was selected, get it from db and send to update view
            if($this->request->getMethod() === 'post' && $this->validate([
                'firstName' => 'required|min_length[3]|max_length[30]',
                'lastName' => 'required|min_length[3]|max_length[30]',
                'departmentName' => 'required'
            ])){
                $this->customerModel->save(
                    [
                        'id' => $this->request->getPost('id'),
                        'firstName' => $this->request->getPost('firstName'),
                        'lastName' => $this->request->getPost('lastName'),
                        'dob' => $this->request->getPost('dob'),
                        'departmentName' => $this->request->getPost('departmentName')
                    ]
                );
                echo ("Employee was saved!");
            } else {
                $data['employee'] = $this->customerModel->get_employee($seg1);
                echo view('employee/update.php', $data);
            }
        }

        echo view('templates/footer.php');
    }

    public function delete($seg1 = false, $seg2 = false){
        $data['pageTitle'] = "Delete Employee";

        echo view('templates/header.php', $data);
        if(!$seg1){
            $data['message'] = "Please select a valid employee.";
            $data['callback_link'] = "/employee";
            echo view('templates/error_message.php', $data);
        }
        else{
            $employee = $this->customerModel->get_employee($seg1);
            if($seg2 == 1){
                $data['callback_link'] = "/employee";
                if($this->customerModel->delete($seg1)){
                    $data['message'] = "The employee was successfully deleted.";
                    echo view('templates/success_message.php', $data);
                }
                else{
                    $data['message'] = "The employee could not be deleted.";
                    echo view('templates/error_message.php', $data);
                }
            }
            else{
                $data['confirm'] = "Do you want to delete " . $employee[0]->firstName;
                $data['confirm_link'] = "/employee/delete/". $seg1 ."/1";
                echo view('employee/delete.php', $data);
            }
            
        }
        echo view('templates/footer.php');
    } */
} 