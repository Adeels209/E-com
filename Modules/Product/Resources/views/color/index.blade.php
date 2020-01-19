@extends('admin::layouts.master')

@section('content')
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <script>
                swal("AH OH!", "{{ $error }}", "error");
            </script>
        @endforeach
    @endif

    @if(Session::has('color_created'))
        <script>
            swal("Great!", "{{session('color_created')}}", "success");
        </script>
    @endif

    @if(Session::has('color_updated'))
        <script>
            swal("Great!", "{{session('color_updated')}}", "success");
        </script>
    @endif



    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">View Color</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Color</a>
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
                                    <h4 class="card-title">All Colors| <button onclick="window.location.href=('{{route("admin.colors.create")}}')" class="btn btn-outline-info">Add New</button></h4>

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
                                                <th>Color Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($colors as $color)
                                                <tr class="del" data-id="{{ $color->id }}">
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td class="text-center">{{$color->color}}</td>
                                                    <td>
                                                        <span style="display:block; text-align: center; ">
                                                            <a href="{{ route('admin.colors.edit', $color->id) }}"><button type="button" style="margin-top:10px;" class="btn btn-float btn-float-md btn-outline-info"><i class="la la-edit"></i></button></a>
                                                            <button type="button" style="margin-top:10px;" onclick="delFunction({{$color->id}})" class="btn btn-float btn-float-md btn-outline-danger"><i class="la la-trash"></i></button>
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
                text: "You will not be able to recover this Color!",
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
                            url: "{{ route('admin.colors.delete') }}",
                            type: 'post',
                            data: {
                                id: id,
                                _token:CSRF_TOKEN,
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data);
                                if (data.status == 200) {
                                    swal(" Color has been deleted!", {
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