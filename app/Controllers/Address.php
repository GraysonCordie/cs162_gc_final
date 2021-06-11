<?php

namespace App\Controllers;
use App\Models\AddressModel;

class Address extends BaseController
{
    private $addressModel;
    private $addressFields;
    
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
            
        }
        else{
            echo view('address/create.php', $data);
        }
        
        echo view('templates/footer.php');
    }

}
