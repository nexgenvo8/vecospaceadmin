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
    <title>UserList-SDGvecospace</title>
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

</head>
<?php
$websiteurl = env('WEBSITE_URL');
?>
<style>
    th {
        cursor: pointer;
    }

    th.asc::after {
        content: " ▲";
    }

    th.desc::after {
        content: " ▼";
    }
</style>


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
                            <h1>USER LIST</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ol class="breadcrumb float-sm-right mb-1">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">USER LIST</li>
                            </ol><br>
                            <div>
                                <strong>
                                    Total: {{ $total }}
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
                                    <h3 class="card-title">USER LIST</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form method="GET" action="{{ route('user_subscription_list') }}" class="mb-3"
                                        id="searchForm">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" name="firstName" class="form-control search-field"
                                                    placeholder="First Name" value="{{ request('firstName') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="lastName" class="form-control search-field"
                                                    placeholder="Last Name" value="{{ request('lastName') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="email" class="form-control search-field"
                                                    placeholder="Email" value="{{ request('email') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="userstype" class="form-control search-field">
                                                    <option value="">Select Type</option>
                                                    <option value="1"
                                                        {{ request('userstype') == 1 ? 'selected' : '' }}>Student
                                                    </option>
                                                    <option value="2"
                                                        {{ request('userstype') == 2 ? 'selected' : '' }}>Faculty
                                                    </option>
                                                    <option value="3"
                                                        {{ request('userstype') == 3 ? 'selected' : '' }}>Alumni
                                                    </option>
                                                    <option value="4"
                                                        {{ request('userstype') == 4 ? 'selected' : '' }}>Industry
                                                        Professional</option>
                                                    <option value="5"
                                                        {{ request('userstype') == 5 ? 'selected' : '' }}>Career
                                                        Enhancer / Service Provider</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="row mt-3 d-flex justify-content-center">
                                            <div class="col-md-2 text-center">
                                                <button type="submit" class="btn btn-gradient w-100" id="searchButton"
                                                    disabled>
                                                    🔍 Search
                                                </button>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <a href="{{ route('user_subscription_list') }}"
                                                    class="btn btn-reset w-100">
                                                    🔄 Reset
                                                </a>
                                            </div>
                                        </div>

                                    </form>



                                    <div class="table-responsive"> <!-- Add this wrapper -->
                                        <table id="example" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="white-space: nowrap" onclick="sortTable(0)">S. N.</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(1)">Name</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(2)">Type</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(3)">Course</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(4)">Branch</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(5)">Year Of
                                                        Passing</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(6)">Industry</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(7)">Email ID</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(8)">Mobile</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(9)">Resend Email
                                                    </th>
                                                    <th style="white-space: nowrap" onclick="sortTable(10)">Date</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(11)">Status
                                                    </th>
                                                    <th style="white-space: nowrap" onclick="sortTable(12)">Action
                                                    </th>
                                                    <th style="white-space: nowrap" onclick="sortTable(13)">Open</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $userTypes = [
                                                        1 => 'Student',
                                                        2 => 'Faculty',
                                                        3 => 'Alumni',
                                                        4 => 'Industry Professional',
                                                        5 => 'Career Enhancer / Service Provider',
                                                    ];
                                                @endphp

                                                @foreach ($dataList as $index => $user)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $user['firstName'] }} {{ $user['lastName'] }}</td>

                                                        <td>{{ $userTypes[$user['userstype']] ?? 'Not Yet Selected' }}
                                                        </td>

                                                        <td>{{ $user['coursename'] ?? '-' }}</td>
                                                        <td>{{ $user['departmentname'] ?? '-' }}</td>
                                                        <td>{{ $user['passingyear'] ?? '-' }}</td>
                                                        <td>{{ $user['industryId'] ?? '-' }}</td>
                                                        <td>{{ $user['email'] ?? '-' }}</td>
                                                        <td>{{ $user['mobile'] ?? '-' }}</td>
                                                        <td>
                                                            <form action="{{ route('resend_email') }}" method="POST"
                                                                style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="to"
                                                                    value="{{ $user['email'] }}">
                                                                <input type="hidden" name="userId"
                                                                    value="{{ $user['userId'] }}">

                                                                <button type="submit"
                                                                    class="btn btn-warning btn-sm">Resend</button>
                                                            </form>
                                                        </td>

                                                        <td>{{ $user['regDate'] ?? '-' }}</td>
                                                        <td>
                                                            <!-- Button -->
                                                            <button type="button" class="btn btn-link"
                                                                data-toggle="modal"
                                                                data-target="#statusModal{{ $user['userId'] }}">
                                                                @if ($user['activeYN'] == 'Y')
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-danger">Inactive</span>
                                                                @endif
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="statusModal{{ $user['userId'] }}" tabindex="-1"
                                                                role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Update Status</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p
                                                                                id="statusModalText{{ $user['userId'] }}">
                                                                                Do you want to change status of this
                                                                                user?
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form
                                                                                action="{{ route('user.updatestatus') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="userId"
                                                                                    value="{{ $user['userId'] }}">
                                                                                <input type="hidden" name="activeYN"
                                                                                    value="{{ $user['activeYN'] == 'Y' ? 'N' : 'Y' }}">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Yes</button>
                                                                            </form>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">No</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                onclick="openEditModal({{ json_encode($user) }})">
                                                                Edit
                                                            </button>
                                                        </td>


                                                        <td align="center" valign="top" class="graylist">
                                                            <a href="{{ $websiteurl }}profile/{{ encodeStr($user['userId']) }}/{{ $user['userurl'] }}.html"
                                                                target="_blank" class="btn btn-info btn-sm">
                                                                Open
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>


                                    </div>
                                </div>

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <!-- use 'justify-content-end' for right alignment -->

                                        <!-- Previous Button -->
                                        <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $currentPage > 1 ? request()->url() . '?page=' . ($currentPage - 1) : '#' }}">
                                                Previous
                                            </a>
                                        </li>

                                        <!-- First Page -->
                                        <li class="page-item {{ $currentPage == 1 ? 'active' : '' }}">
                                            <a class="page-link" href="{{ request()->url() }}?page=1">1</a>
                                        </li>

                                        <!-- Ellipsis if current page is far from first page -->
                                        @if ($currentPage > 3)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif

                                        <!-- Pages around current page -->
                                        @for ($page = max(2, $currentPage - 1); $page <= min($lastPage - 1, $currentPage + 1); $page++)
                                            <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ request()->url() }}?page={{ $page }}">{{ $page }}</a>
                                            </li>
                                        @endfor

                                        <!-- Ellipsis if current page is far from last page -->
                                        @if ($currentPage < $lastPage - 2)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif

                                        <!-- Last Page -->
                                        @if ($lastPage > 1)
                                            <li class="page-item {{ $currentPage == $lastPage ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ request()->url() }}?page={{ $lastPage }}">{{ $lastPage }}</a>
                                            </li>
                                        @endif

                                        <!-- Next Button -->
                                        <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $currentPage < $lastPage ? request()->url() . '?page=' . ($currentPage + 1) : '#' }}">
                                                Next
                                            </a>
                                        </li>

                                    </ul>
                                </nav>



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
            <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('user.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="userId" id="modalUserId">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="firstName" id="modalFirstName"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lastName" id="modalLastName"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" id="modalEmail"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" name="mobile" id="modalMobile"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>User Type</label>
                                    <select class="form-control" name="userstype" id="modalUserType" required>
                                        @php
                                            $userTypes = [
                                                1 => 'Student',
                                                2 => 'Faculty',
                                                3 => 'Alumni',
                                                4 => 'Industry Professional',
                                                5 => 'Career Enhancer / Service Provider',
                                            ];
                                        @endphp
                                        @foreach ($userTypes as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Course</label>
                                    <select class="form-control" name="course_name" id="modalCoursename">
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course['Name'] ?? '' }}">
                                                {{ $course['Name'] ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="department_name" id="modalDepartmentname">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept['DepartmentName'] ?? '' }}">
                                                {{ $dept['DepartmentName'] ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Passing Year</label>
                                    <input type="number" class="form-control" name="passingyear"
                                        id="modalPassingyear">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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
    <script>
        function openEditModal(user) {
            $('#modalUserId').val(user.userId);
            $('#modalFirstName').val(user.firstName);
            $('#modalLastName').val(user.lastName);
            $('#modalEmail').val(user.email);
            $('#modalMobile').val(user.mobile);
            $('#modalUserType').val(user.userstype);
            $('#modalCoursename').val(user.coursename); // Ensure this key matches data
            $('#modalDepartmentname').val(user.departmentname); // Ensure key matches data
            $('#modalPassingyear').val(user.passingyear);

            $('#editUserModal').modal('show');
        }
    </script>

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

            // Initialize tooltips (if needed)
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        let sortDirection = {};

        function sortTable(colIndex) {
            const table = document.getElementById("example");
            const tbody = table.tBodies[0];
            const rows = Array.from(tbody.rows);

            const isNumeric = !isNaN(rows[0].cells[colIndex].innerText.trim());

            // Toggle direction
            sortDirection[colIndex] = !sortDirection[colIndex];
            const dir = sortDirection[colIndex] ? 1 : -1;

            rows.sort((a, b) => {
                let x = a.cells[colIndex].innerText.trim();
                let y = b.cells[colIndex].innerText.trim();

                if (isNumeric) {
                    x = parseFloat(x) || 0;
                    y = parseFloat(y) || 0;
                }

                return x > y ? dir : x < y ? -dir : 0;
            });

            // Append sorted rows
            rows.forEach(row => tbody.appendChild(row));

            // Update sorting arrows
            const ths = table.querySelectorAll("th");
            ths.forEach(th => th.classList.remove("asc", "desc"));
            ths[colIndex].classList.add(sortDirection[colIndex] ? "asc" : "desc");
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchButton = document.getElementById("searchButton");
            const fields = document.querySelectorAll(".search-field");

            function toggleSearchButton() {
                let filled = Array.from(fields).some(field => field.value.trim() !== "");
                searchButton.disabled = !filled;
            }

            fields.forEach(field => {
                field.addEventListener("input", toggleSearchButton);
            });

            toggleSearchButton(); // Initial check
        });
    </script>
</body>

</html>
<style>
    /* Attractive gradient button */
    .btn-gradient {
        background: linear-gradient(45deg, #4CAF50, #81C784);
        border: none;
        color: white;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-gradient:hover {
        background: linear-gradient(45deg, #388E3C, #66BB6A);
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    /* Disabled style */
    .btn-gradient:disabled {
        background: #cccccc !important;
        cursor: not-allowed;
        opacity: 0.6;
    }

    /* Reset button style */
    .btn-reset {
        background: #f44336;
        color: white;
        font-weight: bold;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-reset:hover {
        background: #d32f2f;
        transform: translateY(-2px);
    }
</style>
