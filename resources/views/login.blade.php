<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JMIvecospace| Login</title>

    <link rel="shortcut icon" href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/img/logo11.png') }}"
        type="image/x-icon">
    <link rel="icon" href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/img/logo11.png') }}" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- icheck bootstrap -->
    <link rel="stylesheet"
        href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/css/adminlte.min.css') }}">
</head>
@if ($errors->has('login_error'))
    <div class="flash-message flash-error">
        {{ $errors->first('login_error') }}
    </div>
@elseif (session('error'))
    <div class="flash-message flash-error">{{ session('error') }}</div>
@elseif (session('success'))
    <div class="flash-message flash-success">{{ session('success') }}</div>
@endif

<style>
    .flash-message {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        border-radius: 8px;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        opacity: 0;
        transform: translateY(-20px);
        transition: all 0.5s ease;
    }

    .flash-message.show {
        opacity: 1;
        transform: translateY(0);
    }

    .flash-success {
        background-color: #28a745;
        color: #fff;
    }

    .flash-error {
        background-color: #dc3545;
        color: #fff;
    }
</style>






<body class="hold-transition login-page bg-light">
    <div class="login-box">
        <div class="login-logo mb-4">
            <a href="#">
                <img src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/img/login-logo.png') }}" alt="Logo"
                    style="max-height: 80px; width: auto;">
            </a>
        </div>


        <div class="card shadow-lg rounded-3 overflow-hidden"
            style="max-width: 400px; margin: auto; margin-top: 10px; border: none;">
            <div class="card-header text-center p-2"
                style="background: linear-gradient(135deg, #6a11cb, #2575fc); color: white;">
                <h4 class="font-weight-bold mb-0">Welcome Back</h4>
                <small>Sign in to your account</small>
            </div>

            <div class="card-body p-4 bg-light">
                <form method="POST" action="{{ route('submitLogin') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="userId" class="font-weight-bold">User ID</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white"><i class="fas fa-user text-primary"></i></span>
                            </div>
                            <input type="text" class="form-control border-left-0" id="userId" name="userId"
                                placeholder="Enter your User ID" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="font-weight-bold">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white"><i class="fas fa-lock text-primary"></i></span>
                            </div>
                            <input type="password" class="form-control border-left-0" id="password" name="password"
                                placeholder="Enter your Password" required>
                        </div>
                    </div>

                    <div class="form-group form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm"
                        style="background: linear-gradient(135deg, #6a11cb, #2575fc); border: none; padding: 10px; font-size: 16px;">
                        Sign In
                    </button>
                </form>
                <hr class="my-4">
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('admin/ColorlibHQ-AdminLTE-bd4d9c7/dist/js/adminlte.min.js') }}"></script>
</body>

<style>
    body {
        background: linear-gradient(135deg, #ece9e6, #ffffff);
        font-family: 'Segoe UI', sans-serif;
    }

    .input-group-text {
        border-right: none;
    }

    .form-control {
        border-left: none;
    }

    .form-control:focus {
        box-shadow: 0 0 8px rgba(102, 126, 234, 0.6);
        border-color: #6a11cb;
    }

    .btn:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }
</style>

</html>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const msg = document.querySelector('.flash-message');
        if (msg) {
            // show with animation
            msg.classList.add('show');

            // hide after 3 seconds
            setTimeout(() => {
                msg.classList.remove('show');
                setTimeout(() => msg.remove(), 500); // remove after fade
            }, 3000);
        }
    });
</script>
