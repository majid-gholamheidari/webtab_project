@extends('dashboard.layouts.master')

@section('title', 'Users')

@section('head')
    <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users list</h3>
                            <a href="{{ route('dashboard.user.create') }}" class="btn btn-sm btn-outline-success" style="position: absolute; bottom: 6px; right: 8px;">create new</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="users-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>image</th>
                                        <th>name</th>
                                        <th>lastname</th>
                                        <th>gender</th>
                                        <th>info</th>
                                        <th>more</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>image</th>
                                        <th>name</th>
                                        <th>lastname</th>
                                        <th>gender</th>
                                        <th>info</th>
                                        <th>more</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>

    <form action="" id="delete-form" data-action="{{ url('/dashboard/user') }}" method="POST">
        @method('DELETE')
        @csrf
    </form>
@endsection

@section('script')
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        function deleteUser(userId) {
            Swal.fire({
                icon: 'error',
                title: 'Do you want to delete this user?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel',
                denyButtonClass: 'danger',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form')
                        .attr('action', $('#delete-form').data('action') + '/' + userId)
                        .submit()
                }
            })
        }
        $(document).ready(function() {
            $('#users-table').DataTable({
                ajax: {
                    url: "{{ route('api.users.list') }}",
                    type: "POST",
                    data: {
                        _token: "{{ CSRF_TOKEN() }}"
                    }
                },
                order: [],
                serverSide: true,
                columns: [{
                    orderable: true,
                    searchable: true,
                    data: 'image',
                    render: function (data) {
                        return `<img src="{{ asset('public') }}${data}" style="max-height: 45px !important" class="img-circle elevation-2">`;
                    }
                }, {
                    orderable: true,
                    searchable: true,
                    data: 'name',
                }, {
                    orderable: true,
                    searchable: true,
                    data: 'lastname',
                }, {
                    orderable: true,
                    searchable: true,
                    data: 'gender',
                }, {
                    orderable: true,
                    searchable: true,
                    data: null,
                    render: function(row) {
                        let phone =
                            `<span>(+${row.country_code}) ${row.phonenumber}</span><br>`;
                        let email = `<span>${row.email}</span><br>`;
                        return phone + email;
                    }
                }, {
                    orderable: true,
                    searchable: true,
                    data: null,
                    render: function(row) {
                        let dlt_btn = `<button onclick="deleteUser(${row.id})" class="btn btn-danger btn-sm">delete</button>`;
                        let edt_btn =
                            `<a href="{{ url('/dashboard/user/${row.id}/edit') }}" class="btn btn-primary btn-sm ml-2">edit</a>`;
                        return dlt_btn + edt_btn;
                    }
                }],
            });
        });
    </script>
@endsection
