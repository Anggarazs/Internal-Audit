<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">



<!-- Custom fonts for this template-->
<link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

<link href="{{asset('assets/css/auth-style.css')}}" rel="stylesheet" type="text/css">

<title>Login</title>
</head>
<body>
<div id="Web_1280__1">
	<div id="text">
		<svg class="Rectangle_163">
			<rect id="Rectangle_163" rx="0" ry="0" x="0" y="0" width="586" height="800">
			</rect>
		</svg>
		<div id="Logo">
			<span>AUDIT MANAGEMENT</span>
		</div>
		<div id="Welcome_back_Please_login_to_y">
			<span>Welcome back! Please login to your account.</span>
		</div>
        <div class="login-content">
            
			<form class="user" method="post" action="/login">
                @csrf
                @if(session()->has('LoginError'))
                        <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('LoginError') }}
                        </div>
                        @endif
                    <div class="input-div one">
                    <div class="i">
                            <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input  type="text" name="username" class="input @error('username') is-invalid @enderror" id="username" required>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    </div>
                    <div class="input-div pass">
                    <div class="i"> 
                            <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="password" class="input" id="password" required>
                    </div>
                </div>
                    <button type="submit" class="btn btn-margin">Login</button>
                    <a class="text-center" href="/register">Don't have an Account yet? Register here.</a>

                </div>
            </form>
        </div>
		
	</div>
	<img id="k1_b" src="{{asset('assets/img/k1_b.png')}}">
		
	<div id="Group_247">
		<img id="Group_4" src="{{asset('assets/img/Group_4.png')}}">
		
	</div>
	<img id="k1_b" src="{{asset('assets/img/k1_b.png')}}">
		
</div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('assets/js/auth-js.js')}}"></script>
</body>
</html>