<?php
namespace App\Models;

use CodeIgniter\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'orderNumber';
}
