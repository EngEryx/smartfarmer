@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">{{$payment_sum}}<small>KES</small></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-truck"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Products</span>
                            <span class="info-box-number">{{$product_count}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Farmers</span>
                            <span class="info-box-number">{{$farmer_count}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Orders</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Item Sold</th>
                                <th>Sale Status</th>
                                <th>Cost</th>
                                <th>Order Date</th>
                                <th>Created On</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($orders->count() == 0)
                                <tr class="text-center">
                                    <td colspan="7">No Order available</td>
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
                                        <td>KSh.{{$order->total_cost}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->created_at}}</td>
                                        {{--<td>--}}
                                        {{--{{ $order->created_at }}--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                        {{--<a href="#" class="btn btn-xs"> <i class="fa fa-eye"></i> View Order</a>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{route('admin.orders')}}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
    @endsection