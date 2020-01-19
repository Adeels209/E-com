@extends('admin::layouts.master')

@section('extra_css')
    <link rel="stylesheet" href="{{ URL::to('admin_ui/css/lightgallery.css') }}">
    <link rel="stylesheet" href="{{ URL::to('admin_ui/css/light/lightgallery.min.css') }}">
@stop

<style>

    .lightgallery:hover .close {
        opacity: 1;
    }
</style>

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Product Panorama Images</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Images</a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Product Panorama Images</h4>

                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <form class="dropzone dropzone-area" id="dpz-multiple-files" action="{{ route('product.image.store') }}" method="POST" >
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa fa-image"></i> Product Panorama Image</h4>
                            <p class="card-text">
                            </p>
                            <div id="lightdiv">
                                <div id="lightgallery" class=" lightGallery" style="position: relative;">
                                    @foreach($product->panoramaImages as $image)
                                        <a data-id="{{$image->id}}" href="{{URL::to($image->image)}}" class="image-tile  specific-image">
                                            <span onclick="delFunction({{$image->id}},event)" data-id="{{$image->id}}" style="position: absolute; margin-top: 30px; margin-right: -36px !important; padding-left: 47px;  " id="close" class="close abc">&times;</span>
                                            <img style="margin-left: 40px!important; margin-top: 30px; margin-right: 70px!important; object-fit: contain; object-position: center"  width="400" height="200" src="{{URL::to($image->image)}}" alt="image">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra_scripts')
    <script src="{{URL::to('admin_ui/js/dropzone.js')}}"></script>
    <script src="{{URL::to('admin_ui/js/dropzone.min.js')}}"></script>
    <script src="{{ URL::to('admin_ui/js/lightgallery-all.min.js') }}"></script>
    <script>Dropzone.autoDiscover = false;</script>
    <script>Dropzone.autoProcessQueue = false;</script>
    <script>

        var CSRF_TOKEN =$('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $("form#dpz-multiple-files").dropzone({
                url: '{{route('product.image.panorama')}}',
                method:"post",
                addRemoveLinks:true,
                maxFiles: 100,
                maxFilesize:12,
                parallelUploads: 4,
                paramName:'file[]',
                headers:{
                    'X-CSRF-TOKEN':CSRF_TOKEN
                },
                init: function() {
                    this.on("success", function(file, response) {
                        if(response.status == -200){
                            swal("OHHHHH","You cannot have more then 4 images for a product","error")
                        }
                        var base_url = window.location.origin;
                        console.log(base_url);
                        console.log(response.product_Image.small_image);
                        var image='<a href="'+base_url+'/'+response.product_Image.image+'" class="image-tile  specific-image" data-id="'+response.product_Image.id+'"> <span onclick="delFunction('+response.product_Image.id+', event)" data-id="'+response.product_Image.id+'" style="position: absolute; margin-top: 39px; margin-right: -36px !important; padding-left: 47px; object-fit:contain; object-position: center  " id="close" class="close abc" >&times;</span> <img style="margin-left: 40px!important; margin-top: 30px; margin-right: 70px!important; object-fit:contain; object-position: center  "  width="400" height="200"  src="'+base_url+'/'+response.product_Image.image+'" alt="image"> </a>';
                        $("#lightgallery").append(image);
                        var lightgallery = $("#lightgallery");
                        $("#lightgallery").remove();
                        $("#lightdiv").append(lightgallery);
                        $("#lightgallery").lightGallery();
                    });


                }
            });            // $('#formsubmit').click(function () {

            //     myDropzone.processQueue();

            // })

        });

        $(document).ready(function(){
            $("#lightgallery").lightGallery();
        });
    </script>
    <script>
        function delFunction(id,e){
            e.preventDefault();
            e.stopPropagation();
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Image!",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancel!",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: false,
                    },
                    confirm: {
                        text: "Yes, delete it!",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: false
                    }
                }
            })
                .then(isConfirm => {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('admin.image.panorama.delete') }}",
                            type: 'post',
                            data: {
                                id: id,
                                _token:CSRF_TOKEN,
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data);

                                if (data.status == 200) {
                                    swal(" Image has been Deleted!", {
                                        icon: "success",
                                    });
                                    $(".specific-image[data-id="+id+"]").remove();
                                }
                                if (data.status == -1) {
                                    swal("Cancelled", "It's safe.", "error");
                                }
                            },
                        });
                    } else {
                        swal("Cancelled", "It's safe.", "error");
                    }
                });
        }
    </script>
@stop