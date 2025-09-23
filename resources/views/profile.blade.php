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
    <title>Profile-SDGvecospace</title>
    @include('layout.favicon')
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
                            <h1>PROFILE DETAILS</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active">Profile Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            @if (session('successMessage'))
                <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
                    <div class="alert-content">
                        <strong></strong> {{ session('successMessage') }}
                    </div>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif


            {{-- Error messages --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert"
                    style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 250px;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- Success message --}}
            @if (session('successMessage'))
                <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
                    {{ session('successMessage') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            {{-- Error messages --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Update Profile</h3>
                                </div>
                                <form action="{{ route('profile.update') }}" method="POST">
                                    @csrf
                                    <div class="card-body">

                                        {{-- Hidden field for ID --}}
                                        <input type="hidden" name="id" value="{{ session('admin')['id'] }}">

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ session('admin')['name'] }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input type="email" name="email"
                                                value="{{ session('admin')['email'] }}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" name="company"
                                                value="{{ session('admin')['company'] }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </div>
                                </form>

                            </div>

                            <div class="card card-success mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Change Password</h3>
                                </div>
                                <form action="{{ route('profile.updatePassword') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ session('admin')['id'] }}">

                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input type="password" name="current_password" class="form-control"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="new_password" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" name="new_password_confirmation"
                                                class="form-control" required>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">Update Password</button>
                                    </div>
                                </form>


                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

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
    <!-- jQuery -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/js/adminlte.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/js/demo.js') }}"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.custom-alert');
            alerts.forEach(function(alert) {
                setTimeout(() => {
                    alert.remove();
                }, 4000); // Auto hide after 4 seconds
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all alerts with class 'custom-alert'
            const alerts = document.querySelectorAll('.custom-alert');

            alerts.forEach(function(alert) {
                // Auto hide after 4 seconds
                setTimeout(function() {
                    // Fade out effect
                    alert.classList.remove('show');
                    alert.classList.add('fade');

                    // Remove from DOM after fade
                    setTimeout(() => alert.remove(), 500);
                }, 4000);
            });
        });
    </script>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.custom-alert');

        alerts.forEach(function(alert) {
            setTimeout(() => {
                alert.style.animation = 'slideOut 0.5s ease forwards';
                setTimeout(() => alert.remove(), 500);
            }, 4000); // 4 seconds auto-hide
        });
    });
</script>

</html>

<style>
    .custom-alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 280px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        padding: 15px 20px;
        font-weight: 500;
        animation: slideIn 0.5s ease forwards;
    }

    .custom-alert .alert-content {
        display: flex;
        align-items: center;
        flex: 1;
    }

    .custom-alert .icon {
        width: 20px;
        height: 20px;
        margin-right: 10px;
        color: #fff;
    }



    .custom-alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 280px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        padding: 15px 20px;
        font-weight: 500;
        display: flex;
        /* flex container */
        justify-content: space-between;
        /* space between text and close */
        align-items: center;
        /* vertical center */
        background-color: #28a745;
        /* success green */
        color: #fff;
        animation: slideIn 0.5s ease forwards;
    }

    .custom-alert .close {
        color: #fff;
        font-size: 18px;
        opacity: 0.9;
        cursor: pointer;
        background: transparent;
        border: none;
        margin-left: 10px;
        /* spacing from text */
    }




    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }

        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
</style>
