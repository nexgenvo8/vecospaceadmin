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
    <title>Permissions-List-SDGvecospace</title>
    @include('layout.favicon')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- daterange picker -->
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/dropzone/min/dropzone.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/css/adminlte.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<style>

</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layout.header')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- Main content -->

            </head>
            <!-- Flash Messages -->

            <body>
                <section class="content">
                    <div class="container-fluid">
                        <div class="card shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="card-title d-flex align-items-center"
                                    style="color: #0d6efd; font-weight: 600;">
                                    <i class="bi bi-shield-lock-fill me-2"></i>ROLES & PERMISSIONS LIST
                                </h3>
                                <a href="{{ route('roles_permissions_list') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-lg me-1"></i>Add New
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle table-bordered">
                                    <thead class="table-primary">
                                        <tr>
                                            <th style="width:5%">S.N</th>
                                            <th style="width:20%">ROLE NAME</th>
                                            <th>PERMISSIONS</th>
                                            <th style="width:10%">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($permissions as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><strong>{{ ucfirst($item['role_name']) }}</strong></td>
                                                <td>
                                                    @foreach ($item['permissions'] as $perm)
                                                        <span
                                                            class="badge bg-success text-light rounded-pill mb-1 me-1">
                                                            {{ str_replace('_', ' ', ucfirst($perm)) }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('view_edit_permissions', ['user_id' => $item['user_id']]) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </a>




                                                </td>


                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No roles found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </section>



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
    <!-- Select2 -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script
        src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}">
    </script>
    <!-- InputMask -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script
        src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}">
    </script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script
        src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}">
    </script>
    <!-- BS-Stepper -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/js/demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .badge-number {
            display: inline-block;
            width: 23px;
            height: 23px;
            line-height: 23px;
            text-align: center;
            border-radius: 50%;
            background-color: #0d6efd;
            /* Bootstrap primary color */
            color: #fff;
            font-weight: bold;
            margin-right: 0.5rem;
        }

        /* Card-like effect for each Master group */
        .col-md-4 {
            background-color: #ffffff;
            border: 1px solid #e3e3e3;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            /* spacing between rows */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        /* Hover effect */
        .col-md-4:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Group title */
        .col-md-4 h6 {
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        /* Checkbox spacing */
        .form-check {
            margin-bottom: 0.5rem;
        }

        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 40px;
            padding: 20px;
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .form-check-label {
            font-weight: 600;
        }

        #flash-message {
            max-width: 100%;
            /* ensures it doesn't overflow parent card */
        }

        #flash-message .alert {
            width: 100%;
            /* same width as card/form */
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    <style>
        /* Add shadow and scale effect on focus */
        #role-select:focus {
            border-color: #0d6efd;
            /* Bootstrap primary color */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: scale(1.02);
        }

        /* Give some margin when dropdown is open (works in most browsers) */
        select:focus {
            margin-bottom: 100px;
            /* Adjust this value for more space */
        }

        /* Optional: make options font bigger and stylish */
        #role-select option {
            padding: 8px 12px;
            font-size: 0.95rem;
        }

        #flash-message .alert {
            width: 100%;
            /* same width as the card/form */
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    </style>
    <script>
        const roleSelect = document.getElementById('role-select');
        const roleNameHidden = document.getElementById('role-name-hidden');

        // Set role_name whenever a role is selected
        roleSelect.addEventListener('change', function() {
            const selectedOption = roleSelect.options[roleSelect.selectedIndex];
            roleNameHidden.value = selectedOption.dataset.roleName || '';
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flash = document.getElementById('flash-message');
            if (flash) {
                setTimeout(() => {
                    // Bootstrap 5 fade out
                    const alerts = flash.querySelectorAll('.alert');
                    alerts.forEach(alert => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close(); // auto close
                    });
                }, 5000); // 5 seconds
            }
        });
    </script>



</body>

</html>
