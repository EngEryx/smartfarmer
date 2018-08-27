@extends('admin.layouts.app')

@section('page-header')
    <h1>
        Customers
        <small>Feedback from customers.</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">What our customers say?</h3>
                    <div class="box-tools">
                        <a href="{{route('admin.print-feedback')}}" class="btn btn-success btn-xs"><i class="fa fa-print"></i> Download Report</a>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Level</th>
                            <th>Message</th>
                            <th>Date Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($feedbacks->count() == 0)
                            <tr class="text-center">
                                <td colspan="10">No Feedback available</td>
                            </tr>
                        @else
                            @foreach($feedbacks as $feedback)
                                <tr>
                                    <td>{{$feedback->id}}</td>
                                    <td>{{$feedback->feed_type ==1 ? 'Comment' : 'Suggestion'}}</td>
                                    <td>{{$feedback->message}}</td>
                                    <td>{{$feedback->created_at}}</td>
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