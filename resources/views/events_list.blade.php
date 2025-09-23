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
    <title>Events-SGTvecospace</title>
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
                            <h1>MANAGE EVENT</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">Event</li>
                            </ol><br>
                            <div>
                                <strong>
                                    Total: {{ !empty($eventlist) ? count($eventlist) : 0 }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">EVENT LIST</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="white-space: nowrap">S.N.</th>
                                                <th style="white-space: nowrap">EVENT NAME</th>
                                                <th style="white-space: nowrap">USER NAME</th>
                                                <th style="white-space: nowrap">EMAIL ID</th>
                                                <th style="white-space: nowrap">DATE</th>
                                                <th style="white-space: nowrap">STATUS</th>
                                                <th style="white-space: nowrap">OPEN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($eventlist) && count($eventlist) > 0)
                                                @foreach ($eventlist as $index => $event)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $event['eventName'] ?? 'N/A' }}</td>
                                                        <td>{{ $event['Organiser']['UserName'] ?? 'N/A' }}</td>
                                                        <td>{{ $event['Organiser']['email'] ?? 'N/A' }}</td>
                                                        <td>{{ !empty($event['eventDate']) ? \Carbon\Carbon::parse($event['eventDate'])->format('d-m-Y') : 'N/A' }}
                                                        </td>
                                                        <td>
                                                            <!-- Status Button (Trigger Modal) -->
                                                            <button type="button"
                                                                class="btn btn-link p-0 m-0 align-baseline"
                                                                data-toggle="modal"
                                                                data-target="#eventStatusModal{{ $event['id'] }}">
                                                                @if ($event['eventStatus'] == 1)
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-danger">Inactive</span>
                                                                @endif
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="eventStatusModal{{ $event['id'] }}" tabindex="-1"
                                                                role="dialog"
                                                                aria-labelledby="eventStatusModalLabel{{ $event['id'] }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="eventStatusModalLabel{{ $event['id'] }}">
                                                                                Confirm Status Change
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            @if ($event['eventStatus'] == 1)
                                                                                <p>Are you sure you want to
                                                                                    <b>Deactivate</b> this event?
                                                                                </p>
                                                                            @else
                                                                                <p>Are you sure you want to
                                                                                    <b>Activate</b> this event?
                                                                                </p>
                                                                            @endif
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <!-- ❌ No Button -->
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">No</button>

                                                                            <!-- ✅ Yes Button (Submit Form) -->
                                                                            <form action="{{ route('event.update') }}"
                                                                                method="POST" style="display:inline;">
                                                                                @csrf
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $event['id'] }}">
                                                                                <input type="hidden" name="eventStatus"
                                                                                    value="{{ $event['eventStatus'] == 0 ? 1 : 0 }}">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Yes</button>
                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        @php
                                                            $postTitle = substr(
                                                                preg_replace(
                                                                    '/[^A-Za-z0-9\-]/',
                                                                    '-',
                                                                    str_replace(
                                                                        ' ',
                                                                        '-',
                                                                        strip_tags(
                                                                            trim(strtolower($event['eventName'] ?? '')),
                                                                        ),
                                                                    ),
                                                                ),
                                                                0,
                                                                100,
                                                            );
                                                        @endphp

                                                        <td align="center" valign="top" class="graylist">
                                                            <a href="{{ $websiteurl }}events/{{ encodeStr($event['id']) }}/{{ $postTitle }}.html"
                                                                target="_blank" class="btn btn-sm btn-primary">
                                                                Open
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center text-danger"> 🚫 No Events
                                                        Found</td>
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
