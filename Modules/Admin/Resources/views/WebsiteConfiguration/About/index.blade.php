@extends('admin.layouts.layout')
@section('content')
    <link rel="stylesheet" href="{{URL::to('app-assets/css/pages/dropify/css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('app-assets/css/pages/mdi/materialdesignicons.css')}}">

    <style>
        .note-editable{
            height: 175px !important;
        }
    </style>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">About</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">About</a>
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
                                        <form id="myForm" class="form" action="{{route('webconfig.about.update')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> About</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="id" value="{{$about[0]->id}}"/>
                                                        <label for="summernote_content">Content *</label>
                                                        <textarea class="summernote-code" name="summernote_content">{!! $about[0]->summernote_content !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 20px">
                                                    <div class="col-md-12">
                                                        <label for="header_imgage">Header Image *</label>
                                                        <input type="file" class="dropify" data-height="300" name="header_imgage" data-default-file="{{URL::to($about[0]->header_imgage)}}"/>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 20px">
                                                    <div class="col-md-12">
                                                        <label for="bg_image">Background Image *</label>
                                                        <input type="file" class="dropify" data-height="300" name="bg_image" data-default-file="{{URL::to($about[0]->bg_image)}}"/>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 20px">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="meta_tags_keywords">Meta Tags Keywords *</label>
                                                            <input type="text" id="meta_tags_keywords" class="form-control" placeholder="Meta Tags Keywords" name="meta_tags_keywords" value="{{$about[0]->meta_tags_keywords}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Update
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

    <script>
        function cancelFunction() {
            document.getElementById("myForm").reset();
        }

    </script>

@endsection

@section('extra-script')
    <script src="{{URL::to('app-assets/css/pages/dropify/js/dropify.min.js')}}"></script>
    <script src="{{URL::to('app-assets/css/pages/dropify/dropify.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(".dropify").dropify();
        });
    </script>

    {{--<script src="{{URL::to('app-assets/vendors/js/editors/summernote/summernote.js')}}" type="text/javascript"></script>--}}
    {{--<script src="{{URL::to('app-assets/js/scripts/editors/editor-summernote.js')}}" type="text/javascript"></script>--}}

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <script>
	    $(document).ready(function() {
		    $('.summernote-code').summernote({
			
			    toolbar: [
				    // [groupName, [list of button]]
				    ['style', ['bold', 'italic', 'underline', 'clear']],
				    ['font', ['strikethrough', 'superscript', 'subscript']],
				    ['fontsize', ['fontsize']],
				    ['color', ['color']],
				    ['para', ['ul', 'ol', 'paragraph']],
				    ['height', ['height']],
				    ['Insert', ['picture']],
				    ['Font Style',['fontname']]
			    ],
			    fontName: ['Roboto Light', 'Roboto Regular', 'Roboto Bold', 'Thai Sans Neue Light', 'Thai Sans Neue Regular', 'Thai Sans Neue Bold'],
			    // fontNamesIgnoreCheck: ['Roboto Light', 'Roboto Regular', 'Roboto Bold', 'Thai Sans Neue Light', 'Thai Sans Neue Regular', 'Thai Sans Neue Bold'],
			    fontNamesIgnoreCheck: ['Merriweather']
			
		    });
	    });
    </script>

@endsection