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
    <title>Role-Permissions-JMIvecospace</title>
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
                            <h3 class="card-title mb-4">Assign Permissions</h3>

                            <form action="{{ route('roles_permissions.store') }}" method="POST">
                                @csrf

                                <!-- 1. Select Role -->
                                <div class="mb-4 position-relative">
                                    <label for="role-select" class="form-label fw-semibold">1. Select Role</label>
                                    <select class="form-select shadow-sm border-primary" id="role-select" name="user_id"
                                        required style="transition: all 0.3s; cursor: pointer;">
                                        <option value="">-- Select a Role --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role['user_id'] }}"
                                                data-role-name="{{ $role['role_name'] }}">
                                                {{ $role['role_name'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <!-- Hidden input for role_name -->
                                    <input type="hidden" name="role_name" id="role-name-hidden">
                                </div>


                                <hr class="my-4">

                                <!-- 3. Permissions -->
                                <div>
                                    <label class="form-label fw-semibold">2. Permissions</label>
                                    <div class="row g-3">

                                        <!-- Example Group: User Management -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">1</span> Manage Pages Master</h6>


                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_menu_pages" id="perm-user">
                                                <label class="form-check-label" for="perm-create">Manage Pages</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_faqs_pages" id="perm-userdata">
                                                <label class="form-check-label" for="perm-edit">Manage Faqs</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">1</span> Users Master</h6>


                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="subscription_list" id="perm-user">
                                                <label class="form-check-label" for="perm-create">Manage Users</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="import_userdata" id="perm-userdata">
                                                <label class="form-check-label" for="perm-edit">Import Users
                                                    Data</label>
                                            </div>
                                        </div>

                                        <!-- Example Group: Group Management -->
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">2</span>Group Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="group_list" id="perm-group">
                                                <label class="form-check-label" for="perm-group">Manage Group</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">3</span>Company Profile Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="company_list" id="perm-company">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Company</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">4</span>Articles Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="article_list" id="perm-article">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Article</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">5</span>Event calender Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="events_list" id="perm-event">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Event</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">6</span>Roles Permissions Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="roles_permissions_list" id="perm-permission">
                                                <label class="form-check-label" for="perm-group">Roles
                                                    Permissions</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_permissions" id="perm-permission">
                                                <label class="form-check-label" for="perm-group">
                                                    Permissions List</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="edit_roles_permissions" id="perm-permission">
                                                <label class="form-check-label" for="perm-group">
                                                    Edit Permissions</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">8</span>Project & Internships Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="project_list" id="perm-project">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Project</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">9</span>Career Enhancers Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="career_enhancers" id="perm-enhancers">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Career Enhancers</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <h6><span class="badge-number">10</span>Guest Speakers & Trainers Master
                                            </h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="talent_list" id="perm-talent">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Guest Speakers & Trainers</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <h6><span class="badge-number">11</span>Jobs Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="job_list" id="perm-job">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Job</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">12</span>Posts Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="posts_list" id="perm-job">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Posts</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">13</span>ContactsUs Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="list_contact_query" id="perm-contactus">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    ContactUs</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">14</span>Course Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_course" id="perm-course">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Course</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">15</span>Department Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_department" id="perm-department">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Department</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6>16. Notice Board Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_notice" id="perm-contactus">
                                                <label class="form-check-label" for="perm-group">Manage
                                                    Notice Board</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6><span class="badge-number">17</span>Placement Registration Master</h6>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="manage_jobfair" id="perm-registration">
                                                <label class="form-check-label" for="perm-group">Manage
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





                {{-- <script>
                    $(document).ready(function() {
                        function fetchRoles() {
                            $.ajax({
                                url: "/api/roles", // Your API endpoint to get roles
                                method: 'GET',
                                success: function(response) {
                                    let select = $('#role-select');
                                    select.empty();
                                    select.append('<option value="">-- Select a Role --</option>');
                                    response.roles.forEach(role => {
                                        select.append(`<option value="${role.id}">${role.name}</option>`);
                                    });
                                }
                            });
                        }

                        function fetchPermissions() {
                            $.ajax({
                                url: "/api/permissions", // Your API to get grouped permissions
                                method: 'GET',
                                success: function(response) {
                                    let container = $('#permissions-container');
                                    container.empty();

                                    for (let group in response.permissions) {
                                        if (response.permissions.hasOwnProperty(group)) {
                                            let card = `
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5>${group}</h5>
                                </div>
                                <div class="card-body">
                                    ${response.permissions[group].map(perm => `
                                                                                                                                                                                                                                                                                <div class="form-check">
                                                                                                                                                                                                                                                                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="${perm.id}" id="perm-${perm.id}">
                                                                                                                                                                                                                                                                                    <label class="form-check-label" for="perm-${perm.id}">${perm.name}</label>
                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                            `).join('')}
                                </div>
                            </div>
                        `;
                                            container.append(card);
                                        }
                                    }
                                }
                            });
                        }

                        $('#role-select').on('change', function() {
                            const roleId = $(this).val();

                            if (roleId) {
                                $.ajax({
                                    url: `/api/roles/${roleId}/permissions`, // Get existing role permissions
                                    method: 'GET',
                                    success: function(response) {
                                        $('#permissions-container input[type="checkbox"]').prop('checked',
                                            false);
                                        response.permissions.forEach(perm => {
                                            $(`#perm-${perm.id}`).prop('checked', true);
                                        });
                                    }
                                });
                            } else {
                                $('#permissions-container input[type="checkbox"]').prop('checked', false);
                            }
                        });

                        // Initialize
                        fetchRoles();
                        fetchPermissions();
                    });
                </script> --}}

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

    {{-- <script>
        $(function() {
            // === INITIALIZE PLUGINS ===
            $('.select2').select2();
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            });
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            });
            $('[data-mask]').inputmask();
            $('#reservationdate').datetimepicker({
                format: 'L'
            });
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });
            $('#reservation').daterangepicker();
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            });
            $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            }, function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'));
            });
            $('#timepicker').datetimepicker({
                format: 'LT'
            });
            $('.duallistbox').bootstrapDualListbox();
            $('.my-colorpicker1').colorpicker();
            $('.my-colorpicker2').colorpicker();
            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });

        // === BS-Stepper Init ===
        document.addEventListener('DOMContentLoaded', function() {
            const stepperElement = document.querySelector('.bs-stepper');
            if (stepperElement) {
                window.stepper = new Stepper(stepperElement);
            }
        });


        // === Dropzone Configuration ===
        Dropzone.autoDiscover = false;

        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(document.body, {
            url: "{{ route('import.upload') }}",
            paramName: "excel_file", // Important fix
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false,
            previewsContainer: "#previews",
            clickable: ".fileinput-button"
        });


        myDropzone.on("addedfile", function(file) {
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file);
            };
        });

        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}");
        });

        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("queuecomplete", function() {
            document.querySelector("#total-progress").style.opacity = "0";
        });

        myDropzone.on("success", function(file, response) {
            alert(response.message || "File uploaded successfully!");
            console.log("Server response:", response);
            location.reload();
        });

        myDropzone.on("error", function(file, errorMessage, xhr) {
            let message = errorMessage;

            if (typeof errorMessage === 'object' && errorMessage.message) {
                message = errorMessage.message;
            } else if (typeof errorMessage === 'object') {
                message = JSON.stringify(errorMessage);
            }

            alert("Upload failed: " + message);
            console.log("Upload error details:", errorMessage, xhr);
        });

        // === Global Action Buttons ===
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };

        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true);
        };
    </script> --}}

</body>

</html>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('#excel-upload-form').on('submit', function(e) {
            e.preventDefault(); // prevent default submit

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('import.upload') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    alert(response.message || 'File uploaded successfully!');
                    console.log('Full Response:', response);

                    // Access imported users
                    var importedUsers = response.imported_users || [];

                    if (importedUsers.length > 0) {
                        var html = '<p>Imported Users Count: ' + (response.imported_count ||
                            importedUsers.length) + '</p>';
                        html += '<table border="1" cellpadding="5" cellspacing="0">';

                        // Table header
                        html += '<tr>';
                        Object.keys(importedUsers[0]).forEach(function(key) {
                            html += '<th>' + key + '</th>';
                        });
                        html += '</tr>';

                        // Table rows
                        importedUsers.forEach(function(user) {
                            html += '<tr>';
                            Object.values(user).forEach(function(cell) {
                                html += '<td>' + (cell !== null ? cell :
                                    '') + '</td>';
                            });
                            html += '</tr>';
                        });

                        html += '</table>';
                        $('#upload-response').html(html);

                    } else {
                        $('#upload-response').html(
                            '<p>No users found in uploaded file.</p>');
                    }
                },
                error: function(xhr) {
                    console.error('Status:', xhr.status);
                    console.error('Response:', xhr.responseText);
                    alert('Upload failed!');
                    $('#upload-response').html('<pre>' + xhr.responseText + '</pre>');
                }
            });
        });

    });
</script> --}}
