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
    <title>ContactUs-SDGvecospace</title>
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
                            <h1>MANAGE CONTACT US</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ol class="breadcrumb float-sm-right mb-1">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">CONTACT US</li>
                            </ol><br>
                            <div>
                                <strong>
                                    Total: {{ !empty($contacts) ? count($contacts) : 0 }}
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
                                    <h3 class="card-title">CONTACT US LIST</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>S.N.</th>
                                                <th>NAME</th>
                                                <th>EMAIL ID</th>
                                                <th>QUERY</th>
                                                <th>DATE</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($contacts))
                                                @foreach ($contacts as $index => $contact)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $contact['contactName'] ?? 'N/A' }}</td>
                                                        <td>{{ $contact['email'] ?? 'N/A' }}</td>
                                                        <td>{{ $contact['message'] ?? 'N/A' }}</td>
                                                        <td>
                                                            @if (!empty($contact['dateAdded']))
                                                                {{ \Carbon\Carbon::createFromTimestamp($contact['dateAdded'])->format('Y-m-d') }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <!-- Status Button (Trigger Modal) -->
                                                            <button type="button"
                                                                class="btn btn-link p-0 m-0 align-baseline"
                                                                data-toggle="modal"
                                                                data-target="#statusModal{{ $contact['id'] }}">
                                                                @if ($contact['status'] == 0)
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-danger">Inactive</span>
                                                                @endif
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="statusModal{{ $contact['id'] }}" tabindex="-1"
                                                                role="dialog"
                                                                aria-labelledby="statusModalLabel{{ $contact['id'] }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="statusModalLabel{{ $contact['id'] }}">
                                                                                Confirm Status Change
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            @if ($contact['status'] == 0)
                                                                                <p>Are you sure you want to
                                                                                    <b>Deactivate</b> this ContactUs?
                                                                                </p>
                                                                            @else
                                                                                <p>Are you sure you want to
                                                                                    <b>Activate</b> this ContactUs?
                                                                                </p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <!-- ❌ No Button -->
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">No</button>

                                                                            <!-- ✅ Yes Button (Submit Form) -->
                                                                            <form
                                                                                action="{{ route('contact.update') }}"
                                                                                method="POST" style="display:inline;">
                                                                                @csrf
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $contact['id'] }}">
                                                                                <!-- Flip status correctly -->
                                                                                <input type="hidden" name="status"
                                                                                    value="{{ $contact['status'] == 0 ? 1 : 0 }}">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Yes</button>
                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center text-danger">
                                                        🚫 No Contact Found
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

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
