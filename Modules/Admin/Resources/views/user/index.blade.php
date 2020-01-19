@extends('admin::layouts.master')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><!-- Revenue, Hit Rate & Deals -->
                <div class="row">
                    <section id="decimal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <h4 class="card-title" style="padding-top: 3px; font-size: 30px;">Roles</h4>
                                            <div class="col-md-6">
                                                <button id="view" class="btn btn-primary">Create Role</button>
                                            </div>
                                        </div>

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
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <p class="card-text">A dot (.) is used to mark the decimal place in Javascript, however, many parts of the world use a comma (,) and other characters such as the Unicode decimal separator (⎖) or a dash (-) are often used to show the decimal place in a displayed number.</p>
                                            <table class="table table-striped table-bordered comma-decimal-place">
                                                <thead>
                                                <tr>
                                                    <th>Admin Type</th>
                                                    <th>Admin Email</th>
                                                    <th>Created At</th>
                                                    <th>Edit/Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($admins))
                                                    @foreach($admins as $admin)
                                                        <tr class="del" data-id="{{ $admin->id }}">
                                                            <td>{{ $admin->name }}</td>
                                                            <td>{{ $admin->email }}</td>
                                                            <td>{{ $admin->created_at->diffForHumans() }}</td>
                                                            <td style="text-align: center"><a class="message-modal-anchor edit " href="{{ route('admin.user.edit', $admin->id) }}"><button class="btn btn btn-outline-primary" id="edit"><i class="ft-edit-2"></i></button></a>
                                                                <button style="margin-left: 20px;" onclick="delFunction('{{$admin->id}}')" type="submit" class="btn btn-outline-danger"><i class="ft-delete"></i></button></td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Admin Type</th>
                                                    <th>Admin Email</th>
                                                    <th>Created At</th>
                                                    <th>Edit/Delete</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
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
                            url: "{{ route('user.delete') }}",
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