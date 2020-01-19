@extends('admin::layouts.master')
@section('content')
    <link rel="stylesheet" href="{{URL::to('app-assets/css/pages/dropify/css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('app-assets/css/pages/mdi/materialdesignicons.css')}}">

    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form id="myForm" class="form" action="{{ route('admin.testimonial.update') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Testimonials</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" value="{{$testimonial[0]->id}}"/>
                                                            <label for="title">Title *</label>
                                                            <input type="text" id="title" class="form-control" value="{{$testimonial[0]->title}}" name="title" required>
                                                        </div>
                                                        <label for="image">Image *</label>
                                                        <input type="file" class="dropify" data-height="300" name="bg_image" data-default-file="{{URL::to($testimonial[0]->image)}}"/>
                                                        <input type="hidden" name="test_id" value="{{ $testimonial[0]->id }}">
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

@endsection

@section('extra-script')
    <script src="{{URL::to('app-assets/css/pages/dropify/js/dropify.min.js')}}"></script>
    <script src="{{URL::to('app-assets/css/pages/dropify/dropify.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(".dropify").dropify();
        });
    </script>
@endsection