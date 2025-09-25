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
    <title>Register-SGTvecospace</title>
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
                            <h1>MANAGE JOB FAIR REGISTRATION </h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ol class="breadcrumb float-sm-right mb-1">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">REGISTRATION</li>
                            </ol><br>
                            <div>
                                <strong>
                                    Total: {{ $total ?? 0 }}
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
                                    <h3 class="card-title">REGISTRATION LIST</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    {{-- 🔍 Search Bar (Top) --}}
                                    <form method="GET" action="{{ route('registration_list') }}" id="searchForm"
                                        class="mb-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" name="firstName" class="form-control auto-submit"
                                                    placeholder="First Name" value="{{ request('firstName') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="lastName" class="form-control auto-submit"
                                                    placeholder="Last Name" value="{{ request('lastName') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="registrationNo"
                                                    class="form-control auto-submit" placeholder="RegistrationNo"
                                                    value="{{ request('registrationNo') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <a href="{{ route('registration_list') }}"
                                                    class="btn btn-secondary w-100">Reset</a>
                                            </div>
                                        </div>
                                    </form>


                                    {{-- 🔍 End Search Bar --}}
                                    <div class="table-responsive">
                                        <table id="example" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="white-space: nowrap" onclick="sortTable(0)">S.N.</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(1)">UPC NO.</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(2)">NAME</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(3)">DEPARTMENT
                                                    </th>
                                                    <th style="white-space: nowrap" onclick="sortTable(4)">COURSE</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(5)">SEMESTER</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(6)">PASSING YEAR
                                                    </th>
                                                    <th style="white-space: nowrap" onclick="sortTable(7)">MOBILE</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(8)">GENDER</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(9)">UNIVERSITY ID
                                                    </th>
                                                    <th style="white-space: nowrap" onclick="sortTable(10)">STUDENT ID
                                                    </th>
                                                    <th style="white-space: nowrap" onclick="sortTable(11)">STUDENT ID
                                                        PROOF</th>
                                                    <th style="white-space: nowrap" onclick="sortTable(12)">STUDENT ID
                                                        TYPE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registers as $index => $register)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $register['registrationNo'] ?? 'N/A' }}</td>
                                                        <td>{{ $register['firstName'] . ' ' . $register['lastName'] }}
                                                        </td>
                                                        <td>{{ $register['departmentname'] ?? 'N/A' }}</td>
                                                        <td>{{ $register['coursename'] ?? 'N/A' }}</td>
                                                        <td>{{ $register['semester'] ?? 'N/A' }}</td>
                                                        <td>{{ $register['passingyear'] ?? 'N/A' }}</td>
                                                        <td>{{ $register['mobile'] ?? 'N/A' }}</td>
                                                        <td>{{ $register['gender'] ?? 'N/A' }}</td>
                                                        <td align="center" valign="middle" class="graylist">
                                                            <?php if (!empty($register['universityIdAttchment'])) { ?>
                                                            <a href="<?php echo $websiteurl; ?>uploads/<?php echo $register['universityIdAttchment']; ?>"
                                                                target="BLANK__">View</a>
                                                            <?php } else { ?>
                                                            N/A
                                                            <?php } ?>
                                                        </td>

                                                        <td align="center" valign="middle" class="graylist">
                                                            <?php echo !empty($register['studentId']) ? $register['studentId'] : 'N/A'; ?>
                                                        </td>

                                                        <td align="center" valign="middle" class="graylist">
                                                            <?php if (!empty($register['studentphotoId'])) { ?>
                                                            <a href="<?php echo $websiteurl; ?>uploads/<?php echo $register['studentphotoId']; ?>"
                                                                target="BLANK__">View</a>
                                                            <?php } else { ?>
                                                            N/A
                                                            <?php } ?>
                                                        </td>

                                                        <td>
                                                            @if (isset($register['photoIdType']))
                                                                @if ($register['photoIdType'] == 1)
                                                                    Aadhar Card
                                                                @elseif($register['photoIdType'] == 2)
                                                                    PAN Card
                                                                @else
                                                                    Other
                                                                @endif
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-end">

                                            <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $currentPage > 1 ? request()->url() . '?page=' . ($currentPage - 1) : '#' }}">
                                                    Previous
                                                </a>
                                            </li>

                                            <li class="page-item {{ $currentPage == 1 ? 'active' : '' }}">
                                                <a class="page-link" href="{{ request()->url() }}?page=1">1</a>
                                            </li>

                                            @if ($currentPage > 3)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif

                                            @for ($page = max(2, $currentPage - 1); $page <= min($lastPage - 1, $currentPage + 1); $page++)
                                                <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ request()->url() }}?page={{ $page }}">{{ $page }}</a>
                                                </li>
                                            @endfor

                                            @if ($currentPage < $lastPage - 2)
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                            @endif

                                            @if ($lastPage > 1)
                                                <li class="page-item {{ $currentPage == $lastPage ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ request()->url() }}?page={{ $lastPage }}">{{ $lastPage }}</a>
                                                </li>
                                            @endif

                                            <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $currentPage < $lastPage ? request()->url() . '?page=' . ($currentPage + 1) : '#' }}">
                                                    Next
                                                </a>
                                            </li>

                                        </ul>
                                    </nav>

                                </div>

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
    <script>
        document.querySelectorAll('.auto-submit').forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(this.delay);
                this.delay = setTimeout(() => {
                    document.getElementById('searchForm').submit();
                }, 800); // ⏳ 0.6 sec delay (to avoid too many reloads)
            });
        });
    </script>
    <script>
        let sortDirection = {};

        function sortTable(n) {
            const table = document.getElementById("example");
            const rows = Array.from(table.rows).slice(1); // skip header
            const isNumeric = !isNaN(rows[0].cells[n].innerText.trim());

            // toggle direction
            sortDirection[n] = !sortDirection[n];
            const dir = sortDirection[n] ? 1 : -1;

            rows.sort((a, b) => {
                let x = a.cells[n].innerText.trim();
                let y = b.cells[n].innerText.trim();

                if (isNumeric) {
                    x = parseFloat(x) || 0;
                    y = parseFloat(y) || 0;
                }

                return x > y ? dir : x < y ? -dir : 0;
            });

            // reset table
            rows.forEach(row => table.tBodies[0].appendChild(row));

            // update arrow indicator
            const ths = table.querySelectorAll("th");
            ths.forEach(th => th.classList.remove("asc", "desc"));
            ths[n].classList.add(sortDirection[n] ? "asc" : "desc");
        }
    </script>
</body>

</html>
