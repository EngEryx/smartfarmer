@extends('layouts.app')

@section('content')
    <section class="home-slider"></section>
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="py-3">
                        <h3>Your Cart</h3>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Cost</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $total = 0 @endphp
                            @php $cart_items = session()->get('customer_cart'.auth()->user()->id) ?: [] @endphp
                            @foreach($cart_items as $cart_item)
                                <tr>
                                    <td>{{$cart_item['item']->name}}</td>
                                    <td>{{$cart_item['quantity']}}</td>
                                    <td>KSh. {{($cart_item['item']->cost.' x '.(int)$cart_item['quantity'])}}</td>
                                    @php $total +=($cart_item['item']->cost *(int)$cart_item['quantity']) @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td >Total: {{$total}} KShs.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-3 ">
                                            <a href="{{route('landing')}}" class="btn btn-success pull-left"><i class="fa fa-shopping-cart"></i>Continue Shopping</a>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                        @if(session()->exists('customer_cart'.auth()->user()->id))
                                            <div class="col-md-3 ">
                                                <a href="{{route('frontend.order.checkout-cart')}}" class="btn btn-success pull-left"><i class="fa fa-shopping-cart"></i>Checkout Cart</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection