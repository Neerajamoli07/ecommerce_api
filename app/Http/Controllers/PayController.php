<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{

    /**
     * Show the home page to the user.*
     * @return Response
     */
    public function pay($order_id)
    {
        return view('frontend.pay',['order_id' => $order_id]);
    }

    public function meTranPay(){
        dd("hello");
        return view('frontend.meTranPay');
    }

}