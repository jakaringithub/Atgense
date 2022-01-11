<?php

namespace App\Controllers;

use App\Models\Customers;
use App\Models\Employees;
use App\Models\Orders;
use CodeIgniter\Controller;

class Atgense extends Controller
{
    public function index()
    {
        //select aall
        $customerModel = new Customers();
        $data['customers'] = $customerModel->orderBy('customerNumber', 'DESC')->findAll(5);

        // select employee at office = tokyo
        $employeeModel = new Employees();
        $data['employees'] = $employeeModel->select('*')
        ->join('offices', 'offices.officeCode = employees.officeCode')
        ->where('city','Tokyo')->findAll();

        // select order max quantity 
        $orderModel = new Orders();
        $data['orders'] = $orderModel->select('orders.orderNumber , orderdetails.productCode , products.productName , SUM(quantityOrdered) AS total_quantity')
        ->join('orderdetails', 'orderdetails.orderNumber = orders.orderNumber')
        ->join('products', 'products.productCode = orderdetails.productCode')
        ->groupBy('orderdetails.productCode')
        ->orderBy('total_quantity', 'DESC')
        ->findAll(1);
        return view('Atgense',$data);
    }

    public function store() {
        $customerModel = new Customers();
        
        $data = [
            'customerName'=>'testName',
            'contactLastName'=>'testLastName',
            'contactFirstName'=>'testFirstName',
            'phone'=>'+66 0892194428',
            'addressLine1'=>'test Address',
            'city'=>'bangkok',
            'country'=>'thailand',
        ];
        $customerModel->insert($data);
        // $session = session();
        // $session->setFlashdata('success', 'insert success');


        
        return $this->response->redirect(site_url('/Atgenes'));
    }

    // update 
    public function update($id = null) {
        $customerModel = new Customers();
        $data = [
            'customerName'=>'testUpdateName',
            'contactLastName'=>'testUpdateLastName',
            'contactFirstName'=>'testUpdateFirstName',
        ];
        $customerModel->update($id, $data);
        return $this->response->redirect(site_url('/Atgenes'));
    }


    // delete 
    public function delete($id = null) {
        $customerModel = new Customers();
        $data['user'] = $customerModel->where('customerNumber', $id)->delete($id);
        return $this->response->redirect(site_url('/Atgenes'));
    }

}
