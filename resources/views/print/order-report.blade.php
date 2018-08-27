<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>SmartFarmer</title>
    {{--<link rel="stylesheet" href="{{asset("pdf/style.css")}}" media="all" />--}}
</head>
<body>
<h3>SmartFarmer Orders Report</h3>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Items Ordered</th>
        <th>Order Status</th>
        <th>Cost</th>
        <th>Date Placed</th>
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

</body>
</html>