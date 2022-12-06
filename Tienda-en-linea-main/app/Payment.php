<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'sale_id',
        'payment_date',
        'quantity',

    ];

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
   
}
