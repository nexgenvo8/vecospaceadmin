<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JMIVecospace | DataTables</title>

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
                            <h1>MANAGE ARTICLE</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">ARTICLE</li>
                            </ol><br>
                            <div>
                                <strong>
                                    Total: {{ !empty($articles) ? count($articles) : 0 }}
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
                                    <h3 class="card-title">ARTICLE LIST</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="white-space: nowrap">S.N.</th>
                                                <th style="white-space: nowrap">ARTICLE TITLE</th>
                                                <th style="white-space: nowrap">USER NAME</th>
                                                <th style="white-space: nowrap">EMAIL ID</th>
                                                <th style="white-space: nowrap">DATE</th>
                                                <th style="white-space: nowrap">STATUS</th>
                                                <th style="white-space: nowrap">OPEN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($articlelist) && count($articlelist) > 0)
                                                @foreach ($articlelist as $index => $article)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $article['PostTitle'] ?? '' }}</td>
                                                        <td>{{ $article['UserDetail']['UserName'] ?? '' }}</td>
                                                        <td>{{ $article['UserDetail']['Email'] ?? '' }}</td>
                                                        <td>
                                                            {{ isset($article['dateAdded']) ? date('m/d/Y H:i:s', $article['dateAdded']) : 'N/A' }}
                                                        </td>
                                                        <td>
                                                            <!-- Status Button (Trigger Modal) -->
                                                            <button type="button"
                                                                class="btn btn-link p-0 m-0 align-baseline"
                                                                data-toggle="modal"
                                                                data-target="#statusModalGroup{{ $article['id'] }}">
                                                                @if ($article['status'] == 0)
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-danger">Inactive</span>
                                                                @endif
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="statusModalGroup{{ $article['id'] }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="statusModalGroupLabel{{ $article['id'] }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered"
                                                                    role="document">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="statusModalGroupLabel{{ $article['id'] }}">
                                                                                Confirm Status Change
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            @if ($article['status'] == 1)
                                                                                <p>Are you sure you want to
                                                                                    <b>Activate</b> this Article?
                                                                                </p>
                                                                            @else
                                                                                <p>Are you sure you want to
                                                                                    <b>Deactivate</b> this Article?
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
                                                                                action="{{ route('article.update') }}"
                                                                                method="POST" style="display:inline;">
                                                                                @csrf
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $article['id'] }}">
                                                                                <input type="hidden" name="status"
                                                                                    value="{{ $article['status'] == 0 ? 1 : 0 }}">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Yes</button>
                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        {{-- @php

                                                            $slug = Str::slug($article['PostTitle']);
                                                            $encodedId = encodeStr($article['id']);
                                                        @endphp --}}

                                                        <td>
                                                            {{-- <a href="{{ url('articles-and-trivia/' . $encodedId . '/' . $slug . '.html') }}"
                                                                class="btn btn-primary btn-sm" target="_blank">
                                                                Open
                                                            </a> --}}
                                                            <a href="https://jmi.vecospace.com/"
                                                                class="btn btn-primary btn-sm" target="_blank">
                                                                Open
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center text-danger">🚫 No article
                                                        Found</td>
                                                </tr>
                                            @endif
                                        </tbody>

                                        {{-- <tfoot>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>ARTICLE TITLE</th>
                                                <th> USER NAME</th>
                                                <th>EMAIL ID</th>
                                                <th>DATE</th>
                                                <th>STATUS</th>
                                                <th>OPEN</th>
                                            </tr>
                                        </tfoot> --}}
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
