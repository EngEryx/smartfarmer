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

    public function AddToCart(Product $product, Request $request)
    {
        $cart_name = 'customer_cart'.auth()->user()->id;
        if(session()->exists($cart_name)){
            $cart_items = session()->get($cart_name);
            $exists = false;
            foreach ($cart_items as $k => $cart_item){
                if($cart_item['id']==$product->id){
                    $cart_item['quantity'] = ((int)$cart_item['quantity'] + (int)$request->quantity);
                    $exists = true;
                    array_forget($cart_items,$k);
                    array_push($cart_items, $cart_item);
                }
            }
            if(!$exists){
                array_push($cart_items,[
                    'id' => $product->id,
                    'type' => $product->item_type,
                    'item' => $product,
                    'quantity' => $request->quantity
                ]);
            }
//            session()->forget($cart_name);
            session()->put($cart_name, $cart_items);
//            return response()->json($cart_items);
        }else{
            $cart_items = [];
            array_push($cart_items,[
                'id' => $product->id,
                'type' => $product->item_type,
                'item' => $product,
                'quantity' => $request->quantity
            ]);
            session()->put($cart_name, $cart_items);
        }
        session()->flash('status',"Item added to cart");
//        return response()->json($cart_items);

        return redirect()->route('frontend.order.view-cart');
    }

    public function ViewCart()
    {
        return view('view-cart');
    }

    public function CheckoutCart()
    {
        $cart_items = session()->get('customer_cart'.auth()->user()->id);
        if($cart_items == null)
            return redirect()->back();

        $tcost = 0; $qty=0;

        foreach ($cart_items as $k => $cart_item){
            $qty += $cart_item['quantity'];
            $tcost += (int)$cart_item['quantity'] * (int) $cart_item['item']->cost;
        }

        $data = [
            'user_id' => auth()->user()->id,
            'items' => $cart_items,
            'quantity' => $qty,
            'total_cost' => $tcost,
            'amount' => $tcost,
            'status' => 0
        ];

        $order = Order::create($data);

        session()->flash("Your order has been processed.");

        session()->forget('customer_cart'.auth()->user()->id);

        return view('order-view-pay', compact('order'));
    }
}
