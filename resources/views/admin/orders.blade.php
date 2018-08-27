@extends('admin.layouts.app')

@section('page-header')
    <h1>
        Farmers Sales
        <small>All Sales</small>
    </h1>
    @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">All Product Sales</h3>
                    <div class="box-tools pull-right">
                        <a href="{{route('admin.print-orders')}}" class="btn btn-success btn-xs"><i class="fa fa-print"></i> Print Report</a>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Item Sold</th>
                            <th>Sale Status</th>
                            <th>Cost</th>
                            <th>Order Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($orders->count() == 0)
                            <tr class="text-center">
                                <td colspan="7">No Orders available</td>
                            </tr>
                        @else
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->customer_name}}</td>
                                    <td>
                                        <ul>
                                            @foreach($order->items as $cart_item)
                                                <li>
                                                    {{$cart_item['item']['name'] .' - '.($cart_item['item']['cost'].' x '.(int)$cart_item['quantity'])}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{!! $order->status_text !!}</td>
                                    <td>{{$order->total_cost}}</td>
                                    <td>
                                        {{ $order->created_at }}
                                    </td>
                                    {{--<td>--}}
                                    {{--<a href="#" class="btn btn-xs"> <i class="fa fa-eye"></i> View Order</a>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection