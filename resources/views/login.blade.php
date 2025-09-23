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
            <a href="#" class="h1 text-primary"><b>JMI</b>Vecospace</a>
        </div>

        <div class="card shadow-lg rounded-lg">
            <div class="card-body login-card-body">
                <h4 class="text-center mb-4 font-weight-bold">Sign In to Your Account</h4>

                <form method="POST" action="{{ route('submitLogin') }}">
                    @csrf

                    <div class="form-group">
                        <label for="userId">User ID</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="userId" name="userId"
                                placeholder="Enter your User ID" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your Password" required>
                        </div>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block font-weight-bold">Sign In</button>
                </form>

                <hr>

                {{-- <div class="text-center">
                    <p class="small text-muted">Or sign in using social accounts</p>
                    <a href="#" class="btn btn-outline-primary btn-sm mx-1">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="#" class="btn btn-outline-danger btn-sm mx-1">
                        <i class="fab fa-google"></i> Google
                    </a>
                </div>

                <p class="mt-3 text-center">
                    <a href="#" class="text-decoration-none">Forgot your password?</a><br>
                    <a href="#" class="text-decoration-none">Register a new account</a>
                </p> --}}
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
