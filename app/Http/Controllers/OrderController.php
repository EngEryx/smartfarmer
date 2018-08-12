<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function book(Product $product)
    {
        return view('product-info',compact('product'));
    }

    public function bookconfirm(Product $product)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'status' => 0
        ]);
        if(!$order){
            return redirect()->back()->withStatus('Sorry!Could not complete request at the moment.');
        }
        return redirect()->route('frontend.order.view-pay', $order);
    }

    public function viewBooking(Order $order)
    {

        return view('order-view-pay', compact('order'));
    }
}
