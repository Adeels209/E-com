@extends('admin::layouts.master')

@section('content')
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <script>
                swal("AH OH!", "{{ $error }}", "error");
            </script>
        @endforeach
    @endif

    @if(Session::has('category_created'))
        <script>
            swal("Great!", "{{session('category_created')}}", "success");
        </script>
    @endif

    @if(Session::has('category_updated'))
        <script>
            swal("Great!", "{{session('category_updated')}}", "success");
        </script>
    @endif
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">View Orders</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Orders</a>
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
                                    <h4 class="card-title">All Orders|</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <form method="post" action="{{route('admin.order.store')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control" name="select" style="margin-left: 18px!important;">
                                                <option value="ACCEPTED">ACCEPT</option>
                                                <option value="REJECTED">REJECT</option>
                                                <option value="ONDELIVERY">In Delivery Process</option>
                                                <option value="DELIVERED">Delivered</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="submit" class="btn btn-outline-primary">
                                        </div>
                                    </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <table class="table table-striped table-bordered zero-configuration table-responsive">
                                            <thead>
                                            <tr style="text-align: center">
                                                <th>Select</th>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Order Number</th>
                                                <th>Address</th>
                                                <th>Apartment Address</th>
                                                <th>City</th>
                                                <th>Phone Number</th>
                                                <th>User Note</th>
                                                <th>Order Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $order)
                                                    <tr class="del" data-id="{{ $order->id }}">
                                                        <td class="text-center"><input type="checkbox" name="order_id_checked[]" value="{{$order->id}}" class="">
                                                        </td>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $order->fname }}</td>
                                                        <td class="text-center">{{ $order->lname }}</td>
                                                        <td class="text-center">{{ $order->order_no }}</td>
                                                        <td class="text-center">{{ $order->address }}</td>
                                                        <td class="text-center">{{ $order->address_apartment }}</td>
                                                        <td class="text-center">{{ $order->city }}</td>
                                                        <td class="text-center">{{ $order->phonenumber }}</td>
                                                        <td class="text-center">{{ $order->user_note }}</td>
                                                        <td class="text-center">{{ $order->status }}</td>
                                                    </tr>
                                                @endforeach
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
                text: "You will not be able to recover this Category!",
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
                            url: "{{ route('admin.sub-category.delete') }}",
                            type: 'post',
                            data: {
                                id: id,
                                _token:CSRF_TOKEN,
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data);
                                if (data.status == 200) {
                                    swal(" Category has been deleted!", {
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