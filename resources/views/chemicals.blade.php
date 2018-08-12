@extends('layouts.app')

@section('content')
    <section class="py-2">
        <div class="container">
            <div class="row ">
                    @if($products->count() == 0)
                        <h2 class="col-md-12 text-center">We've not added our products yet,check back soon.</h2>
                    @else
                    <div class="col-md-12 card-columns">
                        @foreach($products as $product)
                            <div class="card product-item">
                                <img class="card-img-top" src="{{$product->img_url}}" alt="Product">
                                <div class="card-body purchase-info">
                                    <h4>{{$product->name}}</h4>
                                    <p class="service-desc">{{$product->short_description}} <span> {{$product->price_text}}</span></p>
                                    {!! $product->purchase_url !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
            </div>
        </div>
    </section>
    @endsection