@extends('admin::layouts.master')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Add Stock</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Stock</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Add</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form id="myForm" class="form" action="{{ route('admin.stock.update', $stock->id)}}" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Stock Info</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Quantity*</label>
                                                            <input type="number" id="name" class="form-control cat_name" placeholder="Quantity" name="quantity" required value="{{ $stock->quantity }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="select">Select Product </label>
                                                            <select class="form-control js-example-basic-multiple" name="product_id" multiple="multiple" id="color">
                                                                    <option selected value="{{ $stock->product->id }}">{{ $stock->product->name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="app-content content" style="display: none;">
                                                    <div class="content-wrapper">
                                                        <div class="content-body">
                                                            <section id="summernote-edit-save">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="card">
                                                                            <div class="card-content collapse show">
                                                                                <div class="card-body">
                                                                                    <div class="form-group">
                                                                                        <button id="edit" class="btn btn-primary" type="button" style="display: none;" ><i class="la la-pencil" ></i> Edit</button>
                                                                                        <button id="save" class="btn btn-success" type="button"><i class="la la-save"></i> Save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="cancelFunction()">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop

@section('extra_scripts')
    <script src="{{URL::to('app-assets/css/pages/dropify/js/dropify.min.js')}}"></script>
    <script src="{{URL::to('app-assets/css/pages/dropify/dropify.js')}}"></script>


    <script>
        $(document).ready(function(){
            $(".dropify").dropify();
            $('.js-example-basic-multiple').select2();
        });

    </script>
@stop