<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'quiantity',
        'price',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function total(){
        return $this->quantity * $this->price;
    }
}
