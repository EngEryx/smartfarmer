@extends('admin.layouts.app')

@section('page-header')
    <h1>
        Products Management
        <small>Manage Products</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Product</h3>
                    <div class="box-tools">
                        <a href="{{route('admin.products')}}" class="btn btn-success btn-xs"><i class="fa fa-list"></i> All Products </a>
                    </div>
                </div>
                <div class="box-body">
                    <form method="post" action="{{route('admin.products.save')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="" value="{{old('name')}}" required>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{$errors->has('category_type') ? ' has-error' : ''}}">
                                        <label for="name">Category Type</label>
                                        <select name="category_type" class="form-control" required>
                                            <option selected disabled>-- Select Category Type --</option>
                                            <option value="1">Agro-Chemical</option>
                                            <option value="2">Seeds</option>
                                        </select>
                                        @if ($errors->has('category_type'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('category_type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{$errors->has('cost') ? ' has-error' : ''}}">
                                        <label for="name">Cost</label>
                                        <input type="number" min="0" name="cost" class="form-control" placeholder="" value="{{old('cost')}}" required>
                                        @if ($errors->has('cost'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('cost') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{$errors->has('img_url') ? ' has-error' : ''}}">
                                        <label for="name">Image</label>
                                        <input type="file" name="img_url" required />
                                        @if ($errors->has('img_url'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('img_url') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{$errors->has('item_description') ? ' has-error' : ''}}">
                                        <label for="short_desc">Item Description</label>
                                        <input type="text" class="form-control" name="item_description" value="{{old('item_description')}}" required />
                                        @if ($errors->has('item_description'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('item_description') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{$errors->has('full_description') ? ' has-error' : ''}}">
                                        <label for="short_desc">Full Description</label>
                                        <textarea type="text" class="form-control" name="full_description" required>{{old('full_description')}}</textarea>
                                        @if ($errors->has('full_description'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('full_description') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"> Save Product</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection