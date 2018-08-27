@extends('admin.layouts.app')

@section('page-header')
    <h1>
        Farming
        <smalL>Farming Products</smalL>
    </h1>
    @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Farming Products</h3>
                    <div class="box-tools">
                        <a href="{{route('admin.products.add')}}" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Product</a>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Category </th>
                            <th>Short Description</th>
                            <th>Cost</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($products->count() == 0)
                            <tr class="text-center">
                                <td colspan="7">No Products available</td>
                            </tr>
                        @else
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->item_type_text}}</td>
                                    <td>{{$product->short_description}}</td>
                                    <td>{{$product->price_text}}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>
                                        {!! $product->action_buttons !!}
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

@section('javascripts')
    <script>
        function deleteProduct(id,url){
            console.log(id);
            swal({
                title: "Are you sure?",
                text: "The record will be deleted permanently.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.post(url)
                            .then(res => {
                                swal("Poof! The record has been deleted!", {
                                    icon: "success",
                                });
                                setTimeout(function(){
                                    window.location.reload();
                                }, 2000);
                            })
                            .catch(err => {
                                console.log(err);
                                swal("The record could not be deleted. Try again.");
                            });
                    } else {
                        swal("Your record is safe!");
                    }
                });
        }
    </script>
@endsection