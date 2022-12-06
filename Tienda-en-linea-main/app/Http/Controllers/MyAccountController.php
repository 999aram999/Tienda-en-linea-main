<?php

namespace App\Http\Controllers;

use App\PaymentPlatform;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('client_auth');
    }
    public function my_account() {
        
        return view('web.my_account');
        //return redirect()->route('login');
    }

    public function checkout () {
        $paymentPlatforms = PaymentPlatform::all();

        return view('web.checkout', compact('paymentPlatforms'));
        //return redirect()->route('login');
    }

    public function orders(){

        $orders = auth()->user()->orders;
        return view('web.orders', compact('orders'));
    }

    public function account_info(){
        $user = auth()->user();
        return view('web.account_info', compact('user'));
    }

    public function address_edit(){
        $profile = auth()->user()->profile;
        $user = auth()->user();
        return view('web.address_edit', compact('profile','user'));
    }

    public function change_password(){
        
        $user = auth()->user();
        return view('web.change_password', compact('user'));
    }
}
