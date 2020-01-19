@extends('admin::layouts.master')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Add Coupon</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Coupon</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Add</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <script>
                        swal('OHH','{{ $error }}','error')
                    </script>
                    @endforeach()
                @endif
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form id="myForm" class="form" action="{{ route('admin.coupon.store')}}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Discount Info</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Coupon Name *</label>
                                                            <input type="text" id="coupon_name" class="form-control cat_name" placeholder="Coupon Name" name="coupon_name" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Coupon Number *</label>
                                                            <input type="text" id="coupon_number" class="form-control cat_name" placeholder="Coupon Number" name="coupon_no" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Discount*</label>
                                                            <input type="text" id="discount" class="form-control cat_name" placeholder="Discount " name="discount" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="bg_image">Image *</label>
                                                            <input type="file" class="dropify" id="file"  data-height="200" name="image"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <textarea name="" id="" class="t_area" style="display: none" cols="30" rows="10"></textarea>

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

    <script>
        function strip(html) {
            var tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || "";
        }


        function validateForm() {
            var discount_name = $('#coupon_name').val().trim();
            var discount = $('#coupon_number').val();
            var sdate = $('#discount').val();
            console.log('hello');


            if (discount_name.length == 0) {
                swal('Not Saved', 'Coupon Name is required', 'error');
                return false
            }
            if (discount.length == 0) {

                swal('Not Saved', 'Coupon Number is Required', 'error');
                return false
            }
            if (sdate.length == 0) {

                swal('Not Saved', 'Discount  is Required', 'error');
                return false
            }
            if ($("#file")[0].files.length == 0) {
                swal('Not Saved', 'Image is Required', 'error');
                return false;
            }

            var file_size = $('#file')[0].files[0].size;

            if (file_size > 2097152) {
                swal('Image size not greater then  2mb', 'Error!');
                return false;
            }
            return true;
        }
    </script>
@stop