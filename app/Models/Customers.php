<?php
namespace App\Models;

use CodeIgniter\Model;

class Customers extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'customerNumber';

    protected $allowedFields = [
        'customerNumber', 
        'customerName',
        'contactLastName',
        'contactFirstName',
        'phone',
        'addressLine1',
        'addressLine2',
        'city',
        'state',
        'postalCode',
        'country',
        'salesRepEmployeeNumber',
        'creditLimit',
    ];




}
