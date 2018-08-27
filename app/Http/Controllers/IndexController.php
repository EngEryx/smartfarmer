<?php

namespace App\Http\Controllers;

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
}
