@extends('admin::layouts.master')

@section('content')
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <script>
                swal("AH OH!", "{{ $error }}", "error");
            </script>
        @endforeach
    @endif

    @if(Session::has('product_discount'))
        <script>
            swal("Great!", "{{session('product_discount')}}", "success");
        </script>
    @endif

    @if(Session::has('product_discount'))
        <script>
            swal("Great!", "{{session('product_discount')}}", "success");
        </script>
    @endif


    @if(Session::has('discount_exists'))
        <script>
            swal("OH!", "{{session('discount_exists')}}", "warning");
        </script>
    @endif



    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">View Product's Discount</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Product's Discounts</a>
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
                                    <h4 class="card-title">All Product's Discount|</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <form method="post" action="{{route('admin.product.discount.store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control" name="discount_id" style="margin-left: 18px!important;">
                                                @foreach($discounts as $discount)
                                                <option value="{{ $discount->id }}">{{ $discount->discount_name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" class="btn btn-outline-primary">
                                        </div>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                <tr style="text-align: center">
                                                    <th>Select All</th>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Discount</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($products))
                                                @foreach($products as $product)
                                                    <tr class="del" @if(isset($product->discount->id))data-id="{{ $product->discount->id }}"@endif>
                                                        <td class="text-center"><input type="checkbox" name="product_id[]" value="{{$product->id}}" class="">
                                                        </td>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $product->name }}</td>
                                                        @if(isset($product->discount->discount->discount))
                                                        <td class="text-center">{{ $product->discount->discount->discount }}</td>
                                                        @else
                                                        <td class="text-center">None</td>
                                                        @endif
                                                        @if(isset($product->discount->id))
                                                        <td class="text-center"><button type="button" style="margin-top:10px;" onclick="delFunction({{$product->discount->id}})" class="btn btn-float btn-float-md btn-outline-danger"><i class="la la-trash"></i></button>
                                                        </td>
                                                            @else
                                                            <td class="text-center">None</td>
                                                            @endif
                                                    </tr>
                                                @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop

@section('extra_scripts')
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
                text: "You will not be able to recover this Discount on this product!",
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
                            url: "{{ route('admin.discount.remove') }}",
                            type: 'post',
                            data: {
                                id: id,
                                _token:CSRF_TOKEN,
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data);
                                if (data.status == 200) {
                                    swal(" Discount has been removed!", {
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