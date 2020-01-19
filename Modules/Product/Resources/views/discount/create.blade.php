@extends('admin::layouts.master')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Add Discount</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Discount</a>
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
                                        <form id="myForm" class="form" action="{{ route('admin.discount.store')}}" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Discount Info</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">Discount Name *</label>
                                                            <input type="text" id="discount_name" class="form-control cat_name" placeholder="Discount Name" name="discount_name" >
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
                                                            <label for="name">Start Date*</label>
                                                            <input type="date" id="startdate" class="form-control cat_name" placeholder="Start Date" name="start_date" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="name">End Date*</label>
                                                            <input type="date" id="enddate" class="form-control cat_name" placeholder="Start Date" name="end_date" >
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
            var discount_name = $('#discount_name').val().trim();
            var discount = $('#discount').val();
            var sdate = $('#startdate').val();
            var edate = $('#enddate').val();
            console.log('hello');


            if (discount_name.length == 0) {
                swal('Not Saved', 'Discount Name is required', 'error');
                return false
            }
            if (discount.length == 0) {

                swal('Not Saved', 'discount is Required', 'error');
                return false
            }
            if (sdate.length == 0) {

                swal('Not Saved', 'Start Date is Required', 'error');
                return false
            }
            if (edate.length == 0) {

                swal('Not Saved', 'End Date is Required', 'error');
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