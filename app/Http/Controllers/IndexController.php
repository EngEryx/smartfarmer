<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view("index")->with('products',Product::all());
    }

    public function chemicals()
    {
        return view('chemicals')->with('products',Product::where(['category_type'=>1])->get());
    }

    public function fertilisers()
    {
        return view('fertilisers')->with('products',Product::where(['category_type'=>2])->get());
    }

    public function machinery()
    {
        return view('machinery')->with('products',Product::where(['category_type'=>3])->get());
    }

    public function feedback(Request $request)
    {
        $this->validate($request,[
            'feed_type' => 'required',
            'message' => 'required',
        ]);

        $data = $request->only('feed_type','message');
        $data['status'] = 1;
        $feedback = Feedback::create($data);
        session()->flash('status',"Thank you! We've received your feedback.");
        return redirect()->route('landing');
    }
}
