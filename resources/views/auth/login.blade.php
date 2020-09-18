<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}}
              <img src="{{asset('img/bg/login.jpg')}}" class="ml-2" style="width: 450px; height: 450px;">
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session()->has('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session()->get('fail') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form class="user" method="POST" action="{{ route('aksi.login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="username" name="username" class="form-control form-control-user {{ $errors->has('username') ? 'is-invalid' : '' }}" aria-describedby="emailHelp" placeholder="Enter Your Username" value="{{ old('username') }}">
                            @if ($errors->has('username'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('username')}}</small>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control form-control-user input-password {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter Your Password">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input input-checkbox" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Show Password</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                    </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ url('/forgot_password') }}">Forgot Password?</a>
                  </div>
                  <div class="text-center mt-4">
                    <a class="small text-danger" href="{{ url('/') }}">Back to main page</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script>
      $(document).ready(function(){
            $('.input-checkbox').click(function(){
                if($(this).is(':checked')){
                    $('.input-password').attr('type','text');
                }else{
                    $('.input-password').attr('type','password');
                }
            });
        });
  </script>

</body>

</html>
