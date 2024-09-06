{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.3/sweetalert2.min.css">
</head>
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
        width: 360px;
        margin: 0 auto;
        height: 440px;
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
                <p class="login-box-msg">Login to your account</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="Email">
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
                            autocomplete="current-password" placeholder="Password">
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
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                    <div class="row">
                        <div class="col-6 text-left">
                            <a href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#passwordResetModal">Forgot Password</a>
                            <br><a href="{{ route('register') }}">Register</a>
                        </div>
                    </div>
                </div>
                
                    

            </div>

        </div>
    </div>

    <div class="modal fade" id="passwordResetModal" tabindex="-1" role="dialog"
        aria-labelledby="passwordResetModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordResetModalLabel">Password Reset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('password.email') }}" class="my-login-validation" novalidate>
                        @csrf

                        <div class="input-group">
                            <label for="email" class="sr-only">{{ __('Email Address') }}</label>
                            <input id="email2" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="{{ __('Email Address') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-danger btn-block">Send Password Reset Link</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {

            $('.btn-danger').click(function() {
                $('#passwordResetModal').modal('show');
            });
        });
    </script>

</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Logistics - Retail</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/logistic-assets/images/favicon-osave.ico" />
    <link rel="stylesheet" href="/logistic-assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="/logistic-assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="/logistic-assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="/logistic-assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="/logistic-assets/vendor/remixicon/fonts/remixicon.css">
  </head>
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="login-content">
         <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
               <div class="col-lg-7">
                  <div class="card auth-card">
                     <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                           <div class="col-lg-6 align-self-center">
                              <div class="p-3">
                                 <h2 class="mb-2 text-dark">Retail O!SAVE</h2>
                                 <p class="text-dark">ADMIN | Login to stay connected.</p>

                                 
                                 <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="Email">
                                            
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                            <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="current-password" placeholder="Password">
                             
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-danger">{{ __('Log In') }}</button>
                                   
                                 </form>
                              </div>
                           </div>
                           <div class="col-lg-5 ml-2 image-right">
                              <img src="/logistic-assets/images/login/1.png" class="img-fluid image-right mr-5" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      </div>
    
    <!-- Backend Bundle JavaScript -->
    <script src="/logistic-assets/js/backend-bundle.min.js"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="/logistic-assets/js/table-treeview.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="/logistic-assets/js/customizer.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="/logistic-assets/js/chart-custom.js"></script>
    
    <!-- app JavaScript -->
    <script src="/logistic-assets/js/app.js"></script>

    @if (session('status'))
    <script>
        $(document).ready(function() {
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
    </script> @endif
  </body>
</html>
