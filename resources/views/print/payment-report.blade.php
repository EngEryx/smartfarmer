<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>SmartFarmer</title>
    {{--<link rel="stylesheet" href="{{asset("pdf/style.css")}}" media="all" />--}}
</head>
<body>
<h3>SmartFarmer : Processed Payments</h3>
<table class="table table-striped table-bordered" border="1" cellspacing="0" cellpadding="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Receipt</th>
        <th>Customer</th>
        <th>Order Info.</th>
        <th>Amount</th>
        <th>Other Details</th>
        <th>Created On</th>
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
                <td>{{$payment->amount}}</td>
                <td>{{$payment->phone}}</td>
                <td>
                    {{ $payment->created_at }}
                </td>
            </tr>
        @endforeach
    </tbody>
    @endif
</table>
</body>
</html>