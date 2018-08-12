@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{auth()->user()->name}}</h4>
                            <p class="card-text">Email: {{auth()->user()->email}}</p>
                            <p class="card-text">Phone: {{auth()->user()->phone}}</p>
                            <a href="{{url('/')}}" class="btn btn-primary"><i class="fa fa-home"></i> Home</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    {{--<ul class="list-group">--}}
                        {{--<li class="list-group-item">--}}
                            {{--Access Menu--}}
                        {{--</li>--}}
                        {{--<li class="list-group-item">--}}
                            {{--<a href="#"><i class="glyphicon glyphicon-arrow-right"></i> 1. Booking & Purchases</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-group-item">--}}
                            {{--<a href="#"><i class="glyphicon glyphicon-arrow-right"></i> 2. Payments</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-group-item">--}}
                        {{--<a href="#"></a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Ordered</th>
                                <th>Order Status</th>
                                <th>Cost</th>
                                <th>Scheduled</th>
                                <th>Created On</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($bookings->count() == 0)
                                <tr class="text-center">
                                    <td colspan="7">No Orders available</td>
                                </tr>
                            @else
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->salonitem_name}}</td>
                                        <td>{!! $booking->status_text !!}</td>
                                        <td>{!! $booking->price_text !!}</td>
                                        <td>
                                            {{ $booking->created_at }}
                                        </td>
                                        <td>
                                            <a href="{{$booking->view_url}}" class="btn btn-xs"> <i class="fa fa-eye"></i> View Order</a>
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
</div>
@endsection
