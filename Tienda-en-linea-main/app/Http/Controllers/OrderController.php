<?php

namespace App\Http\Controllers;
use App\Order;
use App\Resolvers\PaymentPlatformResolver;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth');
    
    }
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }
    public function show(Order $order)
    {
        $user=$order->user;
        $details=$order->order_details;
        return view('admin.order.show', compact('order','user','details'));
    }

    public function orders_update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update([
            'shopping_status'=>$request->value
        ]);
       
        return $request->value;
    }
}
