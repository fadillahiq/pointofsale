<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'code', 'cashier_name', 'total', 'pay', 'change'
    ];

    public function productOrder()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
