<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>SmartFarmer</title>
    {{--<link rel="stylesheet" href="{{asset("pdf/style.css")}}" media="all" />--}}
</head>
<body>
<h3>SmartFarmer : Customer Feedback</h3>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Type</th>
        <th>Message</th>
        <th>Date Placed</th>
    </tr>
    </thead>
    <tbody>
    @if($feedbacks->count() == 0)
        <tr class="text-center">
            <td colspan="7">No Feedback available</td>
        </tr>
    @else
        @foreach($feedbacks as $feedback)
            <tr>
                <td>{{$feedback->id}}</td>
                <td>{{$feedback->feed_type ==1 ? 'Comment' : 'Suggestion'}}</td>
                <td>
                   {{$feedback->message}}
                </td>
                <td>
                    {{ $feedback->created_at }}
                </td>
            </tr>
        @endforeach

    </tbody>
    {{--<tfoot>--}}
    {{--<tr>--}}
        {{--<td colspan="2"></td>--}}
        {{--<td colspan="3">SUBTOTAL</td>--}}
        {{--<td>KSh. 0</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<td colspan="2"></td>--}}
        {{--<td colspan="3">TAX 0%</td>--}}
        {{--<td>0.00</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<td colspan="2"></td>--}}
        {{--<td colspan="3">GRAND TOTAL</td>--}}
        {{--<td>KSh. 0</td>--}}
    {{--</tr>--}}
    {{--</tfoot>--}}
    @endif
</table>

</body>
</html>