@extends('admin::layouts.master')

@section('content')
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <script>
                swal("AH OH!", "{{ $error }}", "error");
            </script>
        @endforeach
    @endif

    @if(Session::has('product_created'))
        <script>
            swal("Great!", "{{session('product_created')}}", "success");
        </script>
    @endif

    @if(Session::has('product_updated'))
        <script>
            swal("Great!", "{{session('product_updated')}}", "success");
        </script>
    @endif



    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">View Products</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Product</a>
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
                                    <h4 class="card-title">All Products| <button onclick="window.location.href=('{{route("admin.product.create")}}')" class="btn btn-outline-info">Add New</button></h4>

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
                                                <th>Product Name</th>
                                                <th>Category</th>
                                                <th>Cost Price</th>
                                                <th>Selling Price</th>
                                                <th>Media</th>
                                                <th>Panorama Images</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr class="del" data-id="{{ $product->id }}">
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td class="text-center">{{$product->name}}</td>
                                                    @if($product->category)
                                                    <td class="text-center">
                                                        {{ $product->category->name }}
                                                    </td>
                                                        @else
                                                        <td class="text-center">
                                                            none
                                                        </td>
                                                    @endif

                                                    <td class="text-center">{{$product->cost_price}}</td>
                                                    <td class="text-center">{{$product->selling_price}}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('product.image', $product->slug) }}"><button class="btn btn-primary">Product Images</button></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('product.image.panorama.view', $product->slug) }}"><button class="btn btn-primary">Product Panorama Images</button></a>
                                                    </td>
                                                    <td>
                                                        <span style="display:block; text-align: center; ">
                                                            <a href="{{ route('admin.product.edit', $product->slug) }}"><button type="button" style="margin-top:10px;" class="btn btn-float btn-float-md btn-outline-info"><i class="la la-edit"></i></button></a>
                                                            <button type="button" style="margin-top:10px;" onclick="delFunction({{$product->id}})" class="btn btn-float btn-float-md btn-outline-danger"><i class="la la-trash"></i></button>
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
        $(document).ready(function() {
            $('#view').click(function () {
                $('#role-modal').modal();
            });
        });

        function delFunction(id){
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Product!",
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
                            url: "{{ route('admin.product.delete') }}",
                            type: 'post',
                            data: {
                                id: id,
                                _token:CSRF_TOKEN,
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data);
                                if (data.status == 200) {
                                    swal(" Product has been deleted!", {
                                        icon: "success",
                                    });
                                    $(".del[data-id="+id+"]").remove();
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