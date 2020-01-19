@extends('admin::layouts.master')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{URL::to('app-assets/vendors/css/extensions/raty/jquery.raty.css')}}">

    {{--<style>--}}
        {{--.note-editable{--}}
            {{--height: 175px !important;--}}
        {{--}--}}
    {{--</style>--}}

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Add Testimonial Reviews</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Testimonial Reviews</a>
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
                                        <form id="myForm" class="form" action="{{route('admin.reviews.store')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Testimonial Reviews</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Name *</label>
                                                            <input type="text" id="name" class="form-control" placeholder="Name" name="name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-bottom: 20px;">
                                                    <div class="col-md-12">
                                                        <label for="image">Image *</label>
                                                        <input type="file" class="dropify" data-height="300" name="image" data-default-file=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="review_text">Review Text *</label>
                                                        <textarea class="form-control" name="review_text" rows="10" required></textarea>
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

            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Testimonial Reviews</h4>

                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr style="text-align: center">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Designation</th>
                                                {{--<th>Review Text</th>--}}
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($testimonialreviews as $testimonialreview)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td class="text-center">{{$testimonialreview->name}}</td>
                                                    <td class="text-center">{{$testimonialreview->review}}</td>

                                                    {{--<td class="text-center">{!!$testimonialreview->review_text!!}</td>--}}
                                                    <td>
                                                        <span style="display:block; text-align: center;">
                                                            <button type="button" style="margin-top:10px;" onclick="editFunction(
                                                                    '{{$testimonialreview->id}}','{{$testimonialreview->name}}','{{$testimonialreview->review}}','{{$testimonialreview->image}}',
                                                            )"
                                                                    class="btn btn-float btn-float-md btn-outline-info">
                                                                <i class="la la-edit"></i>
                                                            </button>
                                                            <button type="button" style="margin-top:10px;" onclick="deleteFunction(
                                                                    '{{$testimonialreview->id}}')"
                                                                    class="btn btn-float btn-float-md btn-outline-danger">
                                                                <i class="la la-trash"></i>
                                                            </button>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Update Testimonial Reviews</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <form id="myForm" class="form" action="{{route('admin.testimonialreviews.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input style="display: none" type="text" id="id_edit" class="form-control" name="id_edit">
                                                <label for="name_edit">Name *</label>
                                                <input type="text" id="name_edit" class="form-control" name="name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="designation_edit">Review *</label>
                                                <textarea style="height: 182px;" id="designation_edit" class="form-control" name="review_edit" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning mr-1" onclick="modalHideFunction()">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Upload
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cancelFunction() {
            document.getElementById("myForm").reset();
        }

        function editFunction(id,name,designation,rating,file) {
            $("#id_edit").val(id);
            $("#name_edit").val(name);
            $("#designation_edit").val(designation);
            $('#myModal').modal('show');
        }

        function modalHideFunction() {
            $('#myModal').modal('hide');
        }

        function deleteFunction(id) {
            swal({
                title: "Are you Sure",
                text: "You want to delete?",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "No, cancel please!",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: false,
                    },
                    confirm: {
                        text: "Yes!!!",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: false
                    }
                }
            }).then(isConfirm => {
                if (isConfirm) {
                    var url = window.location.origin;
                    window.location.replace(url+"/admin/webconfig/testimonialsReviews/delete/"+id);
                    swal("Testimonial Reviews has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Cancelled", "It's safe.", "error");
                }
            });
        }

    </script>

@endsection

@section('extra-script')
    <script src="{{URL::to('app-assets/vendors/js/extensions/jquery.raty.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('app-assets/js/scripts/extensions/rating.js')}}" type="text/javascript"></script>

    <script src="{{URL::to('app-assets/css/pages/dropify/js/dropify.min.js')}}"></script>
    <script src="{{URL::to('app-assets/css/pages/dropify/dropify.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(".dropify").dropify();
        });
    </script>
@endsection