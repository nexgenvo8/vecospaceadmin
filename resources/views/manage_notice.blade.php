<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JMIVecospace | DataTables</title>

    <!-- Google Font: Source Sans Pro -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                            <h1>NOTICE LIST</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">Notice</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">

                                    <!-- ✅ Add New Button -->
                                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">
                                        + Add New
                                    </button>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>TITLE</th>
                                                <th>DATE ADDED</th>
                                                <th>LAST MODIFIED</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($notices as $index => $notice)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="editBtn titleClick"
                                                            data-id="{{ $notice['id'] }}"
                                                            data-title="{{ $notice['title'] }}"
                                                            data-details="{{ $notice['details'] }}"
                                                            data-date="{{ $notice['addeddate'] }}"
                                                            data-modified="{{ $notice['modifydate'] }}"
                                                            data-status="{{ $notice['status'] }}">
                                                            {{ $notice['title'] }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $notice['addeddate'] }}</td>
                                                    <td>{{ $notice['modifydate'] }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No records found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <!-- ✅ Add Modal -->
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Add Notice</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('noticeboard.store') }}">
                                            @csrf
                                            <div class="modal-body">

                                                <!-- Title -->
                                                <div class="form-group">
                                                    <label for="addTitle">Title</label>
                                                    <input type="text" name="title" class="form-control"
                                                        id="addTitle" placeholder="Enter title" required>
                                                </div>

                                                <!-- Details -->
                                                <div class="form-group">
                                                    <label for="addDetails">Details</label>
                                                    <textarea name="details" class="form-control" id="addDetails" rows="3" required></textarea>
                                                </div>

                                                <!-- Added Date -->
                                                <div class="form-group">
                                                    <label for="addDate">Date Added</label>
                                                    <input type="date" name="addeddate" class="form-control"
                                                        id="addDate" required>
                                                </div>

                                                <!-- Modify Date -->
                                                <div class="form-group">
                                                    <label for="modifyDate">Last Modified</label>
                                                    <input type="date" name="modifydate" class="form-control"
                                                        id="modifyDate" required>
                                                </div>

                                                <!-- Status -->
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-control" required>
                                                        <option value="active" selected>Active</option>
                                                        <option value="inactive">Inactive</option>
                                                        <option value="draft">Draft</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Notice</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!-- ✅ Edit Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Edit Title</h5>
                                            <button type="button" class="close text-dark" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('noticeboard.update') }}">
                                            @csrf
                                            <input type="hidden" name="id" id="editId">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="editTitle">Title</label>
                                                    <input type="text" name="title" class="form-control"
                                                        id="editTitle" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editdetails">Details</label>
                                                    <textarea name="details" class="form-control" id="editdetails" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editDate">Date Added</label>
                                                    <input type="date" name="addeddate" class="form-control"
                                                        id="editDate">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editLastModified">Last Modified</label>
                                                    <input type="date" class="form-control" id="editLastModified"
                                                        disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editStatus">Status</label>
                                                    <select name="status" id="editStatus" class="form-control">
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Notice</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- ✅ Script -->
                            <script>
                                $(document).on("click", ".titleClick", function() {
                                    $("#editId").val($(this).data("id"));
                                    $("#editTitle").val($(this).data("title"));
                                    $("#editdetails").val($(this).data("details"));
                                    $("#editDate").val($(this).data("added"));
                                    $("#editLastModified").val($(this).data("modified"));
                                    $("#editStatus").val($(this).data("status"));

                                    $("#editModal").modal("show");
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </section>


            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layout.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

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

    <!-- Page specific script -->
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
