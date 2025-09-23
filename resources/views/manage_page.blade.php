@if (session()->has('admin'))
    <script>
        setTimeout(function() {
            window.location.href = "{{ route('loginform') }}";
        }, 30 * 60 * 1000); // 5 minutes
    </script>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website-Pages-SDGvecospace</title>
    @include('layout.favicon')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/css/adminlte.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layout.header')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>MANAGE PAGES</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">PAGES</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        MANAGE WEBSITE PAGES</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- Top Add Page Button -->
                                    <button class="btn btn-success mb-3" data-toggle="modal"
                                        data-target="#addPageModal">
                                        Add New Menu Page
                                    </button>

                                    <!-- Add Page Modal -->
                                    <div class="modal fade" id="addPageModal" tabindex="-1" role="dialog"
                                        aria-labelledby="addPageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form method="POST" action="{{ route('pages.create') }}">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add New Page</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label>Title</label>
                                                                    <input type="text" class="form-control"
                                                                        name="title" required>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" name="txtDescription" rows="2"></textarea>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Meta Title</label>
                                                                    <input type="text" class="form-control"
                                                                        name="meta_title">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Meta Description</label>
                                                                    <textarea class="form-control" name="meta_description" rows="2"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label>Meta Keyword</label>
                                                                    <input type="text" class="form-control"
                                                                        name="meta_keyword">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Status</label>
                                                                    <select class="form-control" name="status">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Inactive</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Backpage</label>
                                                                    <input type="text" class="form-control"
                                                                        name="backpage">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Type</label>
                                                                    <input type="text" class="form-control"
                                                                        name="type" value="menu" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Add Page</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <!-- Table -->
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S.N.
                                                </th>
                                                <th>Page Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pagedata as $index => $page)
                                                <tr id="row-{{ $page['id'] }}">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $page['title'] }}</td>
                                                    <td>
                                                        <!-- Status Button (Trigger Modal) -->
                                                        <button type="button"
                                                            class="btn btn-link p-0 m-0 align-baseline"
                                                            data-toggle="modal"
                                                            data-target="#statusModal{{ $page['id'] }}">
                                                            @if ($page['status'] == 1)
                                                                <span class="badge badge-success">Active</span>
                                                            @else
                                                                <span class="badge badge-danger">Inactive</span>
                                                            @endif
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="statusModal{{ $page['id'] }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="statusModalLabel{{ $page['id'] }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="statusModalLabel{{ $page['id'] }}">
                                                                            Confirm Status Change
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        @if ($page['status'] == 1)
                                                                            <p>Are you sure you want to
                                                                                <b>Deactivate</b> this page?
                                                                            </p>
                                                                        @else
                                                                            <p>Are you sure you want to <b>Activate</b>
                                                                                this page?</p>
                                                                        @endif
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <!-- No Button -->
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">No</button>

                                                                        <!-- Yes Button (Submit Form) -->
                                                                        <form
                                                                            action="{{ route('pagesstatus.update') }}"
                                                                            method="POST" style="display:inline;">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $page['id'] }}">
                                                                            <input type="hidden" name="status"
                                                                                value="{{ $page['status'] == 0 ? 1 : 0 }}">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Yes</button>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-link p-0" type="button"
                                                                id="actionMenu{{ $page['id'] }}"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                &#x22EE; <!-- Vertical ellipsis (three dots) -->
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="actionMenu{{ $page['id'] }}">
                                                                <a class="dropdown-item edit-btn"
                                                                    href="javascript:void(0);"
                                                                    data-id="{{ $page['id'] }}"
                                                                    data-title="{{ $page['title'] }}"
                                                                    data-description="{{ $page['description'] }}"
                                                                    data-meta_title="{{ $page['meta_title'] }}"
                                                                    data-meta_description="{{ $page['meta_description'] }}"
                                                                    data-meta_keyword="{{ $page['meta_keyword'] }}"
                                                                    data-status="{{ $page['status'] }}"
                                                                    data-backpage="{{ $page['url_rewriting'] }}"
                                                                    data-type="{{ $page['type'] }}">
                                                                    Edit
                                                                </a>
                                                                <a class="dropdown-item delete-btn"
                                                                    href="javascript:void(0);"
                                                                    data-id="{{ $page['id'] }}">
                                                                    Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editPageModal" tabindex="-1" role="dialog"
                                        aria-labelledby="editPageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form id="editPageForm" method="POST"
                                                action="{{ route('pages.update') }}">
                                                @csrf
                                                <input type="hidden" name="id" id="editPageId">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Menu Page</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label>Title</label>
                                                                    <input type="text" class="form-control"
                                                                        name="title" id="editTitle" required>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" name="txtDescription" id="editDescription" rows="2"></textarea>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Meta Title</label>
                                                                    <input type="text" class="form-control"
                                                                        name="meta_title" id="editMetaTitle">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Meta Description</label>
                                                                    <textarea class="form-control" name="meta_description" id="editMetaDescription" rows="2"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="form-group col-md-3">
                                                                    <label>Meta Keyword</label>
                                                                    <input type="text" class="form-control"
                                                                        name="meta_keyword" id="editMetaKeyword">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Status</label>
                                                                    <select class="form-control" name="status"
                                                                        id="editStatus">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Inactive</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Backpage</label>
                                                                    <input type="text" class="form-control"
                                                                        name="backpage" id="editBackpage">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label>Type</label>
                                                                    <input type="text" class="form-control"
                                                                        name="type" id="editType" value="menu"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Save
                                                            Changes</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('layout.footer')
    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function() {
                const id = $(this).data('id');

                if (confirm('Are you sure you want to delete this page?')) {
                    $.ajax({
                        url: '{{ route('pages.delete') }}', // route to delete action
                        type: 'POST', // use POST if your route expects POST
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            alert(response.message || 'Page deleted successfully.');
                            $('#row-' + id).fadeOut(500, function() {
                                $(this).remove();
                            });
                        },
                        error: function(xhr) {
                            alert(xhr.responseJSON?.message || 'Failed to delete the page.');
                        }
                    });
                }
            });
        });
    </script>

    </script>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- jQuery -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables & Plugins -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script
        src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-buttons/js/buttons.html5.min.js') }}">
    </script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-buttons/js/buttons.print.min.js') }}">
    </script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/datatables-buttons/js/buttons.colVis.min.js') }}">
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/js/demo.js') }}"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                const id = $(this).data('id');
                const title = $(this).data('title');
                const description = $(this).data('description');
                const meta_title = $(this).data('meta_title');
                const meta_description = $(this).data('meta_description');
                const meta_keyword = $(this).data('meta_keyword');
                const status = $(this).data('status');
                const backpage = $(this).data('backpage');
                const type = $(this).data('type');

                $('#editPageId').val(id);
                $('#editTitle').val(title);
                $('#editDescription').val(description);
                $('#editMetaTitle').val(meta_title);
                $('#editMetaDescription').val(meta_description);
                $('#editMetaKeyword').val(meta_keyword);
                $('#editStatus').val(status);
                $('#editBackpage').val(backpage);
                $('#editType').val(type);

                $('#editPageModal').modal('show');
            });


        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>
