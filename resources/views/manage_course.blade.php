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
    <title>Course-SGTvecospace</title>
    @include('layout.favicon')
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
                            <h1>MANAGE COURSE</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ol class="breadcrumb float-sm-right mb-1">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">COURSE</li>
                            </ol><br>
                            <div>
                                <strong>
                                    Total: {{ !empty($courses) ? count($courses) : 0 }}
                                </strong>
                            </div>
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
                                    <h3 class="card-title">COURSE LIST</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- ✅ Bootstrap 4 & jQuery -->

                                <div class="card-body">
                                    <!-- ✅ Add New Button -->
                                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">
                                        + Add New
                                    </button>

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="white-space: nowrap">S.N.</th>
                                                <th style="white-space: nowrap">NAME</th>
                                                <th style="white-space: nowrap">DEPARTMENT</th>
                                                <th style="white-space: nowrap">STATUS</th>
                                                <th style="white-space: nowrap">DATE ADDED</th>
                                                <th style="white-space: nowrap">LAST MODIFIED</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $index => $course)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <!-- ✅ Click NAME to Edit -->
                                                    <td>
                                                        <a href="javascript:void(0)" class="editBtn"
                                                            data-id="{{ $course['Id'] }}"
                                                            data-dep_id="{{ $course['department_id'] }}"
                                                            data-course="{{ $course['Name'] }}"
                                                            data-code="{{ $course['courseCode'] ?? '' }}"
                                                            data-status="{{ $course['status'] }}">
                                                            {{ $course['Name'] }}
                                                        </a>

                                                    </td>

                                                    <td>{{ $course['Department'] }}</td>
                                                    <td>
                                                        {{ isset($course['status']) ? ($course['status'] == 1 ? 'Active' : 'Inactive') : 'Active' }}
                                                    </td>

                                                    <td>{{ \Carbon\Carbon::parse($course['dateAdded'])->format('Y-m-d') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($course['modifyDate'])->format('Y-m-d') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <!-- Add Modal -->
                                <div class="modal fade" id="addModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Add New Course</h5>
                                                <button type="button" class="close text-white"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <form id="addForm" method="POST" action="{{ route('course.store') }}">
                                                @csrf
                                                <div class="modal-body">

                                                    <!-- Department Dropdown -->
                                                    <div class="form-group">
                                                        <label>Department Name</label>
                                                        <select name="dep_id" class="form-control" required>
                                                            <option value="">-- Select Department --</option>
                                                            @foreach ($departmentdata as $dept)
                                                                <option value="{{ $dept['Id'] }}">
                                                                    {{ $dept['DepartmentName'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Course Name -->
                                                    <div class="form-group">
                                                        <label>Course Name</label>
                                                        <input type="text" name="course_name" class="form-control"
                                                            required>
                                                    </div>

                                                    <!-- Course Code -->
                                                    <div class="form-group">
                                                        <label>Course Code</label>
                                                        <input type="text" name="course_code" class="form-control"
                                                            required>
                                                    </div>

                                                    <!-- Status Dropdown -->
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status" class="form-control" required>
                                                            <option value="">-- Select Status --</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Edit Course</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form id="editForm" method="POST"
                                                action="{{ route('course.update') }}">
                                                @csrf
                                                <input type="hidden" name="id" id="edit_id">

                                                <div class="modal-body">
                                                    <!-- Department Dropdown -->
                                                    <div class="form-group">
                                                        <label>Department Name</label>
                                                        <select name="dep_id" id="edit_department"
                                                            class="form-control" required>
                                                            <option value="">-- Select Department --</option>
                                                            @foreach ($departmentdata as $dept)
                                                                <option value="{{ $dept['Id'] }}">
                                                                    {{ $dept['DepartmentName'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Course Name -->
                                                    <div class="form-group">
                                                        <label>Course Name</label>
                                                        <input type="text" name="course_name" id="edit_course"
                                                            class="form-control" required>
                                                    </div>

                                                    <!-- Course Code -->
                                                    <div class="form-group">
                                                        <label>Course Code</label>
                                                        <input type="text" name="course_code" id="edit_code"
                                                            class="form-control" required>
                                                    </div>

                                                    <!-- Status Dropdown -->
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status" id="edit_status" class="form-control"
                                                            required>
                                                            <option value="">-- Select Status --</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).on("click", ".editBtn", function() {
                                        $("#edit_id").val($(this).data("id"));
                                        $("#edit_course").val($(this).data("course"));
                                        $("#edit_code").val($(this).data("code"));
                                        $("#edit_status").val($(this).data("status")); // 1 or 0
                                        $("#edit_department").val($(this).data("dep_id")); // department ID
                                        $("#editModal").modal("show");
                                    });
                                </script>
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
