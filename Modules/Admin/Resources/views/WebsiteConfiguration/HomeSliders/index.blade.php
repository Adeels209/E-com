@extends('admin.layouts.layout')
@section('content')
    
   

    <link rel="stylesheet" href="{{URL::to('app-assets/css/gallary.css')}}">
    <link rel="stylesheet" href="{{URL::to('app-assets/css/pretify.css')}}">
 
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Add Home Sliders</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Home Sliders</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Add</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <div class="content-header-right col-md-6 col-12">
                    <div class="dropdown float-md-right">
                        <a id="dynamic" class="btn btn-primary" href="javascript:void(0)" style="margin-bottom: 40px;">Preview Slider Images</a>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Home Sliders| <button onclick="window.location.href='{{route("webconfig.home.sliders.create")}}'" class="btn btn-float btn-float-md btn-outline-info"> Add New</button> </h4>

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
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Subtitle</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($homeSliders as $homeSlider)
                                                <tr>
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td class="text-center"><img style="border-radius: 5px; height: 80px; max-width: 100px;" src="{{URL::to($homeSlider->image)}}"> </td>
                                                    <td class="text-center">{{$homeSlider->title}}</td>
                                                    <td class="text-center">{{$homeSlider->tagline}}</td>
                                                    <td>
                                                        <span style="display:block; text-align: center;">
                                                            <button type="button" style="margin-top:10px;" onclick="window.location.href='{{route("webconfig.home.sliders.edit",$homeSlider->id)}}'"
                                                                    class="btn btn-float btn-float-md btn-outline-info">
                                                                <i class="la la-edit"></i>
                                                            </button>
                                                            <button type="button" style="margin-top:10px;" onclick="deleteFunction(
                                                                    '{{$homeSlider->id}}')"
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
          
        </div>
    </div>
  


    <script>
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
                    window.location.replace(url+"/admin/webconfig/homeSliders/delete/"+id);
                    swal("Home Slider has been deleted!", {
                        icon: "success",
                    });mousePositions
                } else {
                    swal("Cancelled", "It's safe.", "error");
                }
            });
        }

    </script>
@endsection

@foreach($homeSliders as $slider)


            <div style="display:none;" class="dynamicHtml{{$slider->id}}">
                <div class='custom-html'>
                    <h4>{{$slider->title}}.</h4>
                    <p>{{$slider->tagline}} </p>
                </div>
            </div>
    @endforeach

@section('extra_js')

    <script src="" type="text/javascript"></script>
    
    <script src="{{URL::to('app-assets/js/lightgallary.js')}}"></script>
    <script src="{{URL::to('app-assets/js/prettify.js')}}"></script>

  

    <script type="text/javascript">
	    $(document).ready(function() {
		    $('#dynamic').click(function(e){
			    $(this).lightGallery({
				    dynamic:true,
				    html:true,
				    mobileSrc:true,
				    dynamicEl:[
				    	@foreach($homeSliders as $slider)
					    {"src":"{{URL::to($slider->image)}}","thumb":"{{URL::to($slider->image)}}","sub-html":".dynamicHtml{{$slider->id}}", "mobileSrc":"{{URL::to($slider->image)}}"},
					    @endforeach
				    ]
			    });
		    })
	    });
    </script>
    <script>
        $(document).ready(function(){
            $(".dropify").dropify();
        });
    </script>

   
@endsection
