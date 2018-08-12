@extends('layouts.app')

@section('content')
    <section class="home-slider"></section>
    <section class="py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="card-img-top" src="{{$product->img_url}}" alt="Picture">
                            {{--{!! $product->checkout_url !!}--}}
                            <div class="text-center">
                                {!! $product->checkout_url !!}
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="service-desc">{{$product->name}}<span> {{$product->price_text}}</span></h4>
                                </div>
                                <div class="card-body">
                                    <h4>Item information</h4>
                                    <hr>
                                    {{$product->item_description}}
                                    <h4>Product Use Description</h4>
                                    <hr>
                                    {{$product->full_description}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection