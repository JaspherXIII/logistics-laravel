<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.3/sweetalert2.min.css">
    <style>
        .login-page {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('/images/d.gif') center/cover no-repeat;

        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            margin: 0 auto;
            height: 550px;
        }

        .logo-image {
            max-width: 150px;
            border: 2px solid #007bff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-wider {
            width: 200px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-box-inner">
            <div class="login-logo text-center">
                <a href="#" style="">
                    <img src="{{ asset('images/logo.png') }}" alt="D' One Creatives Logo"
                        style="max-width: 100px; max-height: 100px; border-radius: 50%; margin-right: 10px;">
                </a>
                <h4 class="text-muted mb-3">Northeastern College</h4>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Register a new membership</p>
                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    <div class="input-group mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="{{ __('Name') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="{{ __('Email Address') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" placeholder="{{ __('Password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0">
                            <a href="{{ url('/') }}"><i class="fas fa-arrow-left"></i></a>
                        </p>
                        <p class="mb-0">
                            <a href="{{ route('login') }}"> I already have a membership</a>
                        </p>
                    </div>
                </div
                
       


            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
