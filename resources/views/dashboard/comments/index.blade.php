@extends('dashboard.layouts.master')

@section('title', 'Comments')

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
                            <h3 class="card-title">Comments list</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="users-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>user</th>
                                        <th>text</th>
                                        <th>status</th>
                                        <th>date</th>
                                        <th>more</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>user</th>
                                        <th>text</th>
                                        <th>status</th>
                                        <th>date</th>
                                        <th>more</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form action="" id="delete-form" data-action="{{ url('/dashboard/comment') }}" method="POST">
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
        function deleteComment(commentId) {
            Swal.fire({
                icon: 'error',
                title: 'Do you want to delete this commnet?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Delete',
                denyButtonText: 'Cancel',
                denyButtonClass: 'danger',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form')
                        .attr('action', $('#delete-form').data('action') + '/' + commentId)
                        .submit()
                }
            })
        }
        $(document).ready(function() {
            $('#users-table').DataTable({
                ajax: {
                    url: "{{ route('api.comments.list') }}",
                    type: "POST",
                    data: {
                        _token: "{{ CSRF_TOKEN() }}"
                    }
                },
                order: [],
                serverSide: true,
                columns: [
                    {
                        orderable: true,
                        searchable: true,
                        data: null,
                        render: function (row) {
                            return `<a href="{{ url('/dashboard/user/${row.user_id}/edit') }}" target="_blank">${row.user}</a>`
                        }
                    }, {
                        orderable: true,
                        searchable: true,
                        data: 'text',
                    }, {
                        orderable: true,
                        searchable: true,
                        data: 'status',
                    }, {
                        orderable: true,
                        searchable: true,
                        data: 'date',
                    }, {
                        orderable: true,
                        searchable: true,
                        data: null,
                        render: function(row) {
                            let dlt_btn = `<button onclick="deleteComment(${row.id})" class="btn btn-danger btn-sm">delete</button>`;
                            let edt_btn =
                                `<a href="{{ url('/dashboard/comment/${row.id}/edit') }}" class="btn btn-primary btn-sm ml-2 mt-2 ">edit</a>`;
                            return dlt_btn + edt_btn;
                        }
                    }
                ],
            });
        });
    </script>
@endsection
