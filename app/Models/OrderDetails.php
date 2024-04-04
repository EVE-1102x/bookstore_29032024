<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'orderDetails';

    protected $fillable = [
        'OrderID',
        'BookID',
        'soldOut',
        'subTotal'
    ];
}
