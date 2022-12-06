<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = [
        'shopping_status',
        'payment_status',
        'user_id',
        'order_date',
        'subtotal',
        'tax',
    ];

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function subtotal(){
        $total=0;
        foreach ($this->order_details as $key => $order_detail){
            $total += $order_detail->total();
        }
        return $total;
    }

    public function total_tax(){
        return $this->subtotal() * $this->tax;
    }

    public function total(){
        return $this->subtotal() + $this->total_tax();
    }

    public static function my_store(){
        $shopping_cart = ShoppingCart::get_the_session_shopping_cart();

       $order = self::create([
            'shopping_status'=>'PENDING',
            'payment_status'=>'PAID',
            'user_id'=> auth()->user()->id,
            'order_date'=> Carbon::now(),
            'subtotal'=> $shopping_cart->total_price(),
            'tax'=>0.18,
        ]);
//POSIBLE CORRECION
        foreach ($shopping_cart->shopping_cart_details as $key => $abc) {

            $results[] = array ("quantity"=>$shopping_cart->shopping_cart_details[$key]
            ->quantity,"price"=>$abc->product->sell_price,
            "product_id"=>$shopping_cart->shopping_cart_details[$key]->product_id); 
                
            
             
             //("quantity"=>$shopping_cart->$shopping_cart_details[$key]->quantity,
            //"price"=>$abc->product->sell_price, solo price
            //"product_id"=>$shopping_cart->shopping_cart_details[$key]->product_id);
        }
        $order->order_details()->createMany($results);
    }

    public function shopping_status(){
        switch ($this->shopping_status){
            case 'PENDING':
                return 'PENDIENTE';
            case 'APPROVED':
                return 'APROBADO';
            case 'CANCELED':
                return 'CANCELADO';
            case 'DELIVERED':
                return 'ENTREGADO';
            default:

            break;
        }
    }


}
