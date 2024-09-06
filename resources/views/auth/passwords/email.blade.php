<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.3/sweetalert2.min.css">
    <style>
        .login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('/images/d.gif') center/cover no-repeat;
        }

        .login-box {
            width: 360px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

   
        .form-control {
            border-radius: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-header">{{ __('Reset Password') }}</div>

            <div class="card-body">
               

                <form method="POST" action="{{ route('password.email') }}" class="my-login-validation" novalidate="">
                    @csrf

                    <div class="input-group">
                        <label for="email" class="sr-only">{{ __('Email Address') }}</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Send Password Reset Link') }}
                            </button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if (session('status'))
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('status') }}',
            });
        });
    </script>
@endif

    @if (Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ Session::get('success') }}',
        });
    </script>
    @endif

    @if (Session::get('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ Session::get('error') }}',
        });
    </script>
    @endif
</body>

</html>
