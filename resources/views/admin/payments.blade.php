@extends('admin.layouts.app')

@section('page-header')
    <h1>
        M-PESA Payments
        <small>All Sales Payments</small>
    </h1>
    @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">All Received Payments</h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Receipt</th>
                            <th>Customer</th>
                            <th>Order Info.</th>
                            {{--<th>Payment Status</th>--}}
                            <th>Amount</th>
                            <th>Other Details</th>
                            <th>Created On</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($payments->count() == 0)
                            <tr class="text-center">
                                <td colspan="10">No Payments available</td>
                            </tr>
                        @else
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{$payment->receipt_no}}</td>
                                    <td>{{$payment->customer_name}}</td>
                                    <td>{{$payment->booking_name}}</td>
                                    {{--<td>{{$payment->status_text}}</td>--}}
                                    <td>{{$payment->amount}}</td>
                                    <td>{{$payment->phone}}</td>
                                    <td>
                                        {{ $payment->created_at }}
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-xs"> <i class="fa fa-eye"></i> View Payment</a>
                                    </td>
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