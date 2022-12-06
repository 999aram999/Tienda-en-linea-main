<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id',
        'user_id',
        'sale_date',
        'total',
        'saldo',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function client(){
        return $this->belongsTo(User::class);
    }
    public function saleDetails(){
        return $this->hasMany(saleDetails::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
