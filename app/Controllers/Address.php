<?php

namespace App\Controllers;
use App\Models\AddressModel;

class Address extends BaseController
{
    private $addressModel;
    private $addressFields;
    //$data['customerFields'] = $customerFields; <- used for passing into a view
    
    public function __construct(){
        $this->addressModel = new AddressModel();
        $this->addressFields = $this->addressModel->get_columnNames();
    }

    public function view($seg1 = false){
        $data['pageTitle'] = "View Customers";
        $customers = $this->addressModel->get_customer($seg1);
        $data['customers'] = $customers;

        echo view('templates/header.php', $data);
        echo view('customer/view.php', $data);
        echo view('templates/footer.php');
    }

    public function create($seg1 = false){
        $data['pageTitle'] = "Create address";
        $data['formFields'] = $this->addressFields;
        $data['custid'] = $seg1;

        echo view('templates/header.php', $data);

        if($this->request->getMethod() === 'post' && $this->validate([
            'line1' => 'required|min_length[3]|max_length[50]',
            'line2' => 'required|min_length[3]|max_length[50]',
            'city' => 'required|min_length[3]|max_length[50]',
            'state' => 'required|max_length[2]',
            'zip' => 'required|min_length[5]|max_length[5]'
        ])){
            $line1 = $this->request->getPost('line1');
            $line2 = $this->request->getPost('line2');
            $zip = $this->request->getPost('zip');


            $this->addressModel->save(
                [
                    'line1' => $line1,
                    'line2' => $line2,
                    'city' => $this->request->getPost('city'),
                    'state' => $this->request->getPost('state'),
                    'zip' => $zip,
                ]
            );

            $id = $this->addressModel->get_addressid($line1, $line2, $zip);

            $this->addressModel->connect_address($seg1, $id);

            $data['message'] = 'Address was created successfully. ID: ' . $id;
            $data['callback_link'] = '/address/create';
            $data['next_link'] = '/order/create/' . $seg1;
            echo view('templates/success_message.php', $data);
            
            //echo ($this->request->getPost('firstName') . ' was created successfully.');
        }
        else{
            echo view('address/create.php', $data);
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
                $this->addressModel->save(
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
                $data['employee'] = $this->addressModel->get_employee($seg1);
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
            $employee = $this->addressModel->get_employee($seg1);
            if($seg2 == 1){
                $data['callback_link'] = "/employee";
                if($this->addressModel->delete($seg1)){
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
