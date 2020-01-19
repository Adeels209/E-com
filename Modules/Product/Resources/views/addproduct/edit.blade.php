@extends('admin::layouts.master')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    label.btn-default{
        background-color: gainsboro!important;
    }
    span.toggle-handle{
        background-color: lightsteelblue!important;
    }
</style>

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Edit Product</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Product</a>
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
                                        <form id="myForm" class="form" action="{{ route('admin.product.update',$product->slug)}}" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Product Info</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="margin-top: 10px;">
                                                            <label for="select">Choose Category</label>
                                                            <select class="form-control category" name="subcategory_id"  id="category">
                                                                <option selected value="{{ $product_subcategory->id }}">{{ $product_subcategory->name }}</option>
                                                                @foreach($categories as $category)
                                                                    <optgroup label="{{$category->name}}">
                                                                        @foreach($category->childCategory as $childcat)
                                                                            <option value="{{ $childcat->id }}">{{ $childcat->name }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="margin-top: 10px;">
                                                            <label for="js-example-basic-multiple">Choose Brand</label>
                                                            <select class="form-control js-example-basic-multiple" name="brand_id"  id="js-example-basic-multiple">
                                                                @foreach($brands as $brand)
                                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="margin-top: 10px;">
                                                            <label for="select">Select Product Colors</label>
                                                            <select class="form-control js-example-basic-multiple" name="color_id[]" multiple="multiple" id="color">
                                                                @foreach($colors as $color)
                                                                    <option value="{{ $color->id }}" @foreach($product->colors as $colorr) @if($color->id == $colorr->id ) selected @endif @endforeach>{{ $color->color }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="margin-top: 10px;">
                                                            <label for="select">Select Product Size</label>
                                                            <select class="form-control js-example-basic-multiple" name="size_id[]" multiple="multiple" id="size">
                                                                @foreach($sizes as $size)
                                                                    <option value="{{ $size->id }}" @foreach($product->sizes as $sizee) @if($size->id == $sizee->id ) selected @endif @endforeach>{{ $size->size }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Product Name *</label>
                                                            <input type="text" id="product_name" class="form-control " placeholder="Product Name" name="product_name" required value="{{ $product->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="description">Product Short Details *</label>
                                                            <input type="text" id="shortdetails" class="form-control " name="shortdescription" required value="{{ $product->short_description }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="detail">Product Long Details *</label>
                                                            <textarea class="summernote-code description" name="longdescription" id="longdescription" required>{{ $product->long_description }}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Status</label>
                                                            <input type="checkbox" data-on="On" data-off="Off" {{ $product->status == 1 ? 'checked' : ''  }} data-toggle="toggle" name="status">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Featured</label>
                                                            <input type="checkbox" data-on="On" data-off="Off" {{ $product->is_featured == 1 ? 'checked' : ''  }}  data-toggle="toggle" name="is_featured">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">New Arrival</label>
                                                            <input type="checkbox" data-on="On" data-off="Off" {{ $product->is_new_arrival == 1 ? 'checked' : ''  }}  data-toggle="toggle" name="is_new_arrival">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Selling Price *</label>
                                                            <input type="text" id="sprice" class="form-control " placeholder="Selling Price" name="sprice" required value="{{ $product->selling_price }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Cost Price *</label>
                                                            <input type="text" id="cprice" class="form-control " placeholder="Cost Price" name="cprice" required value="{{ $product->cost_price }}">
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
            $('#select').select2();
            $('#category').select2();
            $('#color').select2();
            $('#size').select2();
            $('.summernote-code').summernote({
                height: 200,
            });

        });

    </script>
    <script>
        function strip(html) {
            var tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || "";
        }


        function validateForm() {
            var category = $('#category').val().trim();
            var brand = $('#js-example-basic-multiple').val();
            var color = $('#color').val();
            var size = $('#size').val();
            var product = $('#product').val().trim();
            var short = $('#shortdetails').val().trim();
            var cprice = $('#cprice').val().trim();
            var sprice = $('#sprice').val().trim();
            $(".temp-textarea").html($('#longdescription').val());
            var description = $('#longdescription').val();
            console.log('hello');


            if (category.length == 0) {
                swal('Not Saved', 'Category is required', 'error');
                return false
            }
            if (brand.length == 0) {

                swal('Not Saved', 'Brand is Required', 'error');
                return false
            }
            if (color.length == 0) {

                swal('Not Saved', 'Color is Required', 'error');
                return false
            }
            if (size.length == 0) {

                swal('Not Saved', 'Size is Required', 'error');
                return false
            }
            if (product.length == 0) {

                swal('Not Saved', 'Product Name is Required', 'error');
                return false
            }
            if (short.length == 0) {

                swal('Not Saved', 'Short Details field is Required', 'error');
                return false
            }
            if (cprice.length == 0) {

                swal('Not Saved', 'Cost Price is Required', 'error');
                return false
            }
            if (sprice.length == 0) {

                swal('Not Saved', 'Selling Price is Required', 'error');
                return false
            }
            if (strip(description).trim().length == 0) {
                swal('Not Saved', 'Description is Required', 'error');
                return false
            }
            return true;
        }
    </script>
@stop