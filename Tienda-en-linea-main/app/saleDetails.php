<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class saleDetails extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'discount',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
