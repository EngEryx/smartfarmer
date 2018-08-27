@extends('layouts.app')

@section('content')
    <section class="home-slider"></section>
    <section class="py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="service-desc">{{$product->name}}</h4>
                            <br>
                            <br>
                            <img class="card-img-top" src="{{$product->img_url}}" alt="Picture">
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    {{--<a href="{{route('landing')}}" class="btn btn-success pull-left"><i class="fa fa-shopping-cart"></i>Continue Shopping</a>--}}
                                     Quantity:
                                </div>
                                <div class="col-md-9">
                                    <form action="{{route('frontend.order.add-to-cart',$product)}}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <input type="number" name="quantity" min="1" value="1" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <button type="submit"  class="btn btn-success ml-1">Add to Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                {{--<div class="card-header">--}}
                                {{--</div>--}}
                                <div class="card-body">
                                    <h4 style="color: #000;font-weight: bold;">Price</h4>
                                    <hr>
                                    <h2 style="color: #000;font-weight: bold;">{{$product->price_text}}</h2>
                                    <br>
                                    <h4 style="color: #000;font-weight: bold;">Item information</h4>
                                    <hr>
                                    {{$product->item_description}}
                                    <br>
                                    <br>
                                    <br>
                                    <h4 style="color: #000;font-weight: bold;">Product Use Description</h4>
                                    <hr>
                                    {{$product->full_description}}
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection