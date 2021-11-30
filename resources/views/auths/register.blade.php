<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/auth-style.css')}}" rel="stylesheet" type="text/css">

</head>

<body id="Web_1280__1" class="mx-auto mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <img id="k1_b" src="{{asset('assets/img/k1_b.png')}}">

                <div id="Group_247">
                    <img id="Group_4" src="{{asset('assets/img/Group_4.png')}}">
                </div>
                <img id="k1_b" src="{{asset('assets/img/k1_b.png')}}">
            </div>

            <div id="text" class="col-lg-6">
                <svg class="Rectangle_163" class="col-lg-12">
                    <rect id="Rectangle_163" rx="0" ry="0" x="0" y="0" width="586" height="800">
                    </rect>
                </svg>
                <div id="Logo" class="col-lg-12">
                    <span>AUDIT MANAGEMENT</span>
                </div>
                <div id="Welcome_back_Please_login_to_y" class="col-lg-12">
                    <span>Welcome back! Please Input to your identity.</span>
                </div>
                <div class="login-content" class="col-lg-12">

                    <form class="user" method="post" action="/register">
                        @csrf
                        @if(Session::has('BerhasilRegister'))
                        <div class="alert alert-success" class="col-lg-12">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <strong>Success,</strong>
                            {{ Session::get('BerhasilRegister') }}
                        </div>
                        @endif
                        <div class="input-div one" class="col-lg-12">
                            <div class="i">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="div">
                                <h5>Username</h5>
                                <input type="text" name="username" class="input @error('username') is-invalid @enderror"
                                    id="username" required value="{{ old('username') }}">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group"> --}}
                            <!-- #Scrollable SelecBox -->
                            {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a> --}}
                            <!-- onfocus='this.size=4;' onblur='this.size=1;' onchange='this.size=1; this.blur();' -->
                            {{-- <div class="alert alert-danger" class="col-lg-12"> --}}
                                <div class="input-div one" class="col-lg-12">
                                    <div class="i">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="div">
                                        {{-- <h5>Choose Department</h5> --}}
                                        <select name="id_department"
                                            class=" form-control @error('id_department') is-invalid @enderror"
                                            id="id_department" required>
                                            {{-- <option value="selected">Choose Department</option> --}}
                                            <option value="" selected>Pilih Department</option>   
                                            @foreach ($id_depart as $item) 
                                            <option value="{{ $item->id}}">{{ $item->nama_department}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_department')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-div one" class="col-lg-12">
                                    <div class="i">
                                        <i class="fas fa-user-tag"></i>
                                    </div>
                                    <div class="div">
                                        <select name="role"  class=" form-control  @error('role') is-invalid @enderror" id="role"   required>
                                            <option value="" selected>Pilih Role</option>                 
                                            <option value="auditor">Auditor</option>
                                            <option value="auditee">Auditee</option>           
                                        </select>
                                        @error('id_role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{--
                            </div> --}}
                            <div class="input-div pass" class="col-lg-12">
                                <div class="i">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="div">
                                    <h5>Password</h5>
                                    <input type="password" class="input @error('password') is-invalid @enderror"
                                        name="password" id="password" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-marginreg">Register</button>
                            <a class="text-center   " href="/login">Already have an Account? Click here to Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('assets/js/auth-js.js')}}"></script>


</html>
