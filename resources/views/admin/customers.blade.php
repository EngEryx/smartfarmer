@extends('admin.layouts.app')

@section('page-header')
    <h1>
        Farmers
        <smalL>All Customers</smalL>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="box-title">All Farmers</div>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Date Registered</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($customers->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">No customer available</td>
                            </tr>
                        @else
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->phone}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>
                                        {{ $customer->created_at }}
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