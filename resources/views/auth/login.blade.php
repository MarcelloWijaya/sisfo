<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    @include('templates.header')
</head>

<body class="bg-gradient-primary">

    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <!-- Outer Row -->
        <div class="row justify-content-center w-100">

            <div class="col-lg-4 col-md-6 col-10">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Page</h1>
                                    </div>
                                    <div>
                                        @error('message')
                                            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                                {{ $message }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @enderror
                                    </div>
                                    <div>
                                        @if (\Session::has('message'))
                                            <div class="alert alert-success alert-dismissible fade show mb-3"
                                                role="alert">
                                                <b>{{ \Session::get('message') }}</b>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <form action="{{ route('login.action') }}" method="POST" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmailOrUsername" placeholder="Email or Username"
                                                name="email_or_username"
                                                value="{{ Cookie::has('loginCookie') ? Cookie::get('loginCookie') : old('login') }}">
                                            @error('email_or_username')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                            @error('password')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <!-- Create an Account Link -->
                                    <div class="create-account text-center mt-3">
                                        <p>Don't have an account? <a href="{{ route('register.page') }}">Create an
                                                Account</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    @include('templates.script')
</body>

</html>
