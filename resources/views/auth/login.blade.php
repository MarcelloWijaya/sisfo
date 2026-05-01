<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    @include('templates.header')
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            margin: auto;
        }

        .card {
            margin: 0 auto;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container login-container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <i class="fas fa-graduation-cap fa-3x text-primary mb-3"></i>
                                <h1 class="h3 text-gray-900 mb-4">Welcome Back!</h1>
                                <p class="text-muted mb-4">Please login to your account</p>
                            </div>

                            @error('message')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @enderror

                            @if (\Session::has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle"></i> {{ \Session::get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('login.action') }}" method="POST" class="user">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email_or_username"
                                        name="email_or_username" placeholder="Email or Username"
                                        value="{{ Cookie::has('loginCookie') ? Cookie::get('loginCookie') : old('email_or_username') }}">
                                    @error('email_or_username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password"
                                        name="password" placeholder="Password">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </form>

                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

@include('templates.script')

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
</script>
</body>

</html>
