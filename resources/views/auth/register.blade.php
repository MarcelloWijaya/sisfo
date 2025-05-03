<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    @include('templates.header')
</head>

<body class="bg-gradient-primary">

    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <div class="row justify-content-center w-100">

            <div class="col-lg-4 col-md-6 col-10">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
                                    </div>
                                    <form action="{{ route('register.action') }}" method="POST" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username"
                                                placeholder="Username" value="{{ old('username') }}">
                                            @error('username')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email"
                                                placeholder="Email Address" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Password">
                                            @error('password')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password_confirmation" placeholder="Confirm Password">
                                            @error('password_confirmation')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Create
                                            Account</button>
                                    </form>

                                    <!-- Link to Login Page -->
                                    <div class="text-center mt-3">
                                        <p>Already have an account? <a href="{{ route('login.page') }}">Login here</a>
                                        </p>
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
