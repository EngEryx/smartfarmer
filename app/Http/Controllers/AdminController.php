<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $farmer_count = User::where(['user_type'=>1])->whereDate('created_at','>=',Carbon::today())->count();
        $order_count = Order::whereDate('created_at','>=',Carbon::today())->count();
        $product_count = Product::whereDate('created_at','>=',Carbon::today())->count();
        $payment_sum = Payment::whereDate('created_at','>=',Carbon::today())->sum('amount');
        $orders = Order::whereDate('created_at','>=',Carbon::today())->get();
        return view('admin.dashboard', compact('farmer_count','orders','order_count','payment_sum','product_count'));
    }

    public function customers()
    {
        $users = User::where(['user_type' => 1])->get();
        return view('admin.customers')
            ->with('customers', $users);
    }

    public function products()
    {
        $salonitems = Product::all();
        return view('admin.products')
            ->with('products',$salonitems);
    }

    public function saveProduct(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:products|max:191',
            'item_description' => 'required|max:191',
            'full_description' => 'required',
            'cost' => 'required|numeric',
            'category_type' => 'required',
            'img_url' => 'required|file|image',
        ]);
        $file_name = time().'.'.$request->file('img_url')->getClientOriginalExtension();
        $request->file('img_url')->move(public_path('uploads'),$file_name);
        $url = url('/uploads').'/'.$file_name;
        $data = $request->except('img_url');
        $data['img_url'] = $url;
        $product = Product::create($data);
        if(!$product){
            return redirect()->back();
        }
        return redirect()->route('admin.products')->with('status','Successfully Saved!');
    }

    public function payments()
    {
        return view('admin.payments')
            ->with('payments',Payment::all());
    }

    public function orders()
    {
        $orders = Order::all();
        return view('admin.orders')->with('orders',$orders);
    }
}
