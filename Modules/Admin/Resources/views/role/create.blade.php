@extends('admin::layouts.master')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><!-- Revenue, Hit Rate & Deals -->

                <section id="striped-row-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="striped-row-layout-basic">Role</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">

                                        <div class="card-text">
                                        </div>

                                        <form action="{{ route('role.store') }}" method="POST" class="form form-horizontal striped-rows form-bordered">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i>Add Role</h4>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="projectinput1">First Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="projectinput1" class="form-control" placeholder="First Name" name="name">
                                                    </div>
                                                </div>
                                                <div class="form-group row last">
                                                    <label class="col-md-3 label-control">Select Permission</label>
                                                    <div class="col-md-9">
                                                        <div class="input-group">
                                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                                                @foreach($permissions as $permission)
                                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                                                        <label class="" for="yes">{{ $permission->name }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1">
                                                        <i class="ft-x"></i> Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> Save
                                                    </button>
                                                </div>
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
@stop

@section('extra_scripts')
    <script>

        function delFunction(id){
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Content!",
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
                            url: "{{ route('role.delete') }}",
                            type: 'post',
                            data: {
                                id: id,
                                _token:CSRF_TOKEN,
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data);
                                if (data.status == 200) {
                                    swal(" Content has been deleted!", {
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

        function openModal(myObj) {
            var name = $(myObj).data("name");
            var guard = $(myObj).data("guard");
            var id = $(myObj).data("id");

            $("#role_id").val(id);
            $("#name-edit").val(name);
            $("#guard-edit").val(guard);
            $("#role-edit").modal("show");
        }
        $(document).ready(function () {
            $('.table').DataTable();
        });

    </script>
@stop