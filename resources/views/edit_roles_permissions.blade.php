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
    <title>Role-Permisiions-SGTvecospace</title>
    @include('layout.favicon')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- daterange picker -->
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
                    <div id="flash-message" class="mt-3">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="container-fluid">
                        <div class="card shadow">
                            <div class="mb-3 text-end">
                                <a href="{{ route('permissions_list') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-right"></i> Back To List
                                </a>
                            </div>
                            <h3 class="card-title mb-4">ASSIGN PERMISSIONS</h3>
                            <form action="{{ route('roles_permissions.store') }}" method="POST">
                                @csrf

                                @php
                                    $userPermissions = $userRole['permissions'] ?? [];
                                @endphp

                                <!-- 1. Select Role -->
                                <div class="mb-4 position-relative">
                                    <label for="role-select" class="form-label fw-semibold">1. Select Role</label>
                                    <input type="text" name="role_name" id="role_name" class="form-control"
                                        value="{{ $userRole['role_name'] ?? '' }}" readonly>
                                </div>
                                <input type="hidden" name="user_id" value="{{ $userRole['user_id'] ?? '' }}">

                                <hr class="my-4">

                                <!-- 2. Permissions -->
                                <div>
                                    <label class="form-label fw-semibold">2. Permissions</label>
                                    <div class="row g-3">

                                        <!-- Manage Pages -->

                                        <div class="col-md-4">
                                            <h6><span class="badge-number">1</span> Manage Pages Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_menu_pages" id="perm-user"
                                                    {{ in_array('manage_menu_pages', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-user">Manage Pages</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_faqs_pages" id="perm-userdata"
                                                    {{ in_array('manage_faqs_pages', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-userdata">Manage Faqs
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Users Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">1</span> Users Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="subscription_list" id="perm-user"
                                                    {{ in_array('subscription_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-user">Manage Users</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="import_userdata" id="perm-userdata"
                                                    {{ in_array('import_userdata', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-userdata">Import Users
                                                    Data</label>
                                            </div>
                                        </div>

                                        <!-- Group Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">2</span> Group Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="group_list" id="perm-group"
                                                    {{ in_array('group_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-group">Manage Group</label>
                                            </div>
                                        </div>

                                        <!-- Company Profile Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">3</span> Company Profile Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="company_list" id="perm-company"
                                                    {{ in_array('company_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-company">Manage
                                                    Company</label>
                                            </div>
                                        </div>

                                        <!-- Articles Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">4</span> Articles Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="article_list" id="perm-article"
                                                    {{ in_array('article_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-article">Manage
                                                    Article</label>
                                            </div>
                                        </div>

                                        <!-- Event Calendar Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">5</span> Event Calendar Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="events_list" id="perm-event"
                                                    {{ in_array('events_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-event">Manage Event</label>
                                            </div>
                                        </div>

                                        <!-- Roles Permissions Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">6</span> Roles Permissions Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="roles_permissions_list" id="perm-permission"
                                                    {{ in_array('roles_permissions_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-permission">Roles
                                                    Permissions</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_permissions" id="perm-manage-permission"
                                                    {{ in_array('manage_permissions', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="perm-manage-permission">Permissions List</label>
                                            </div>
                                        </div>

                                        <!-- Project & Internships Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">8</span> Project & Internships Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="project_list" id="perm-project"
                                                    {{ in_array('project_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-project">Manage
                                                    Project</label>
                                            </div>
                                        </div>

                                        <!-- Career Enhancers Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">9</span> Career Enhancers Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="career_enhancers" id="perm-enhancers"
                                                    {{ in_array('career_enhancers', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-enhancers">Manage Career
                                                    Enhancers</label>
                                            </div>
                                        </div>

                                        <!-- Guest Speakers & Trainers Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">10</span> Guest Speakers & Trainers Master
                                            </h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="talent_list" id="perm-talent"
                                                    {{ in_array('talent_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-talent">Manage Guest
                                                    Speakers & Trainers</label>
                                            </div>
                                        </div>

                                        <!-- Jobs Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">11</span> Jobs Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="job_list" id="perm-job"
                                                    {{ in_array('job_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-job">Manage Job</label>
                                            </div>
                                        </div>

                                        <!-- Posts Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">12</span> Posts Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="posts_list" id="perm-posts"
                                                    {{ in_array('posts_list', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-posts">Manage Posts</label>
                                            </div>
                                        </div>

                                        <!-- ContactUs Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">13</span> ContactsUs Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="list_contact_query" id="perm-contactus"
                                                    {{ in_array('list_contact_query', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-contactus">Manage
                                                    ContactUs</label>
                                            </div>
                                        </div>

                                        <!-- Course Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">14</span> Course Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_course" id="perm-course"
                                                    {{ in_array('manage_course', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-course">Manage
                                                    Course</label>
                                            </div>
                                        </div>

                                        <!-- Department Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">15</span> Department Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_department" id="perm-department"
                                                    {{ in_array('manage_department', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-department">Manage
                                                    Department</label>
                                            </div>
                                        </div>

                                        <!-- Notice Board Master -->
                                        <div class="col-md-4">
                                            <h6>16. Notice Board Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_notice" id="perm-notice"
                                                    {{ in_array('manage_notice', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-notice">Manage Notice
                                                    Board</label>
                                            </div>
                                        </div>

                                        <!-- Placement Registration Master -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">17</span> Placement Registration Master</h6>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_jobfair" id="perm-registration"
                                                    {{ in_array('manage_jobfair', $userPermissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perm-registration">Manage
                                                    Placement Registration</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary px-5">Save Permissions</button>
                                </div>
                            </form>
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
