@extends('admin::layouts.master')
@section('content')
    <link href="{{URL::to('assets/css/focus/focuspoint.css')}}">
    
    
    
    <style>
        .focuspoint {
            position: relative; /*Any position but static should work*/
            overflow: hidden;
        }
        .focuspoint img {
            /*display:none!important;*/
            position: absolute;
            left: 0;
            top: 0;
            margin: 0;
            display: block;
            /* fill and maintain aspect ratio */
            width: auto; height: auto;
            min-width: 100%; min-height: 100%;
            max-height: none; max-width: none;
        }
        .slidecontainer {
            width: 100%;
        }
        
        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 25px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }
        
        .slider:hover {
            opacity: 1;
        }
        
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            background: #4CAF50;
            cursor: pointer;
        }
        
        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            background: #4CAF50;
            cursor: pointer;
        }
    </style>
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
              
              
            </div>
            <div class="content-body">
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form id="myForm" class="form"
                                              action="{{ route('admin.slider.store', $sliders[0]->id) }}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden" name="id" value="">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Home Sliders</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="title">Title *</label>
                                                            <input type="text" id="title" class="form-control" placeholder="Title"

                                                                           value="{{ $sliders[0]->title }}"

                                                                   name="title" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tagline">Subtitle *</label>
                                                            <input type="text" id="tagline" class="form-control"

                                                                           value="{{ $sliders[0]->subtitle }}"
                                                                   placeholder="Tagline" name="subtitle" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="image">Image *</label>
                                                            <input type="file" class="dropify" data-height="300"  name="image" data-default-file="{{ URL::to($sliders[0]->image) }}"/>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-actions">

                                                    <button type="submit" class="btn btn-block btn-primary">
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
            
           
            
            <!-- Edit Modal -->
           
        </div>
    </div>

    
    
    <script>
		function cancelFunction() {
			document.getElementById("myForm").reset();
		}
		
		function editFunction(id,title,tagline) {
			console.log(id,name);
			$("#id_edit").val(id);
			$("#title_edit").val(title);
			$("#tagline_edit").val(tagline);
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
					window.location.replace(url+"/admin/webconfig/homeSliders/delete/"+id);
					swal("Home Slider has been deleted!", {
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
@endsection
