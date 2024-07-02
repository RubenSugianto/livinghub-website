@extends('master')

@section('title', 'Login Page')

@section('styles')
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f8f9fa;
        margin: 0;
        padding-top: 400px; 
    }

    .container {
        width: 1000px; 
        height: 870px;
        padding: 10px;    
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .logo-container {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo-container img {
        width: 400px; 
    }

    .form-signin {
        width: 150%;
        max-width: 500px; 
        margin: 0 auto; 
    }

    .form-floating {
        margin-bottom: 20px; 
    }

    .btn-primary {
        background-color: #5E5DF0;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #4A4AC4;
        border-color: #0056b3;
    }

    .invalid-feedback {
        display: block;
    }

    .small-link {
        color: #007bff;
        text-decoration: none; 
    }

    .small-link:hover {
        color: #0056b3;
        text-decoration: none; 
    }

    .btn-google {
        font-size: 18px;
        line-height: 1.2;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px; 
        width: 100%; 
        height: 70px;
        border-radius: 10px;
        box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
        transition: all 0.4s;
        position: relative;
        z-index: 1;
        margin-bottom: 20px;
        text-decoration: none; 
    }

    .btn-google::before {
        content: "";
        display: block;
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        border-radius: 10px;
        top: 0;
        left: 0;
        background: #a64bf4;
        background: linear-gradient(45deg, #00dbde, #fc00ff);
        opacity: 0;
        transition: all 0.4s;
    }

    .btn-google {
        color: #555555;
        background-color: #fff;
        text-decoration: none;
    }

    .btn-google img {
        width: 30px;
        margin-right: 15px;
        padding-bottom: 3px;
    }

    .btn-google:hover::before {
        opacity: 1;
    }

    .btn-google:hover {
        color: #fff;
        text-decoration: none;
    }

    .wrap-input100 {
        width: 100%;
        position: relative;
        background-color: #f7f7f7;
        border: 1px solid #e6e6e6;
        border-radius: 10px;
    }

    .password-toggle {
        position: relative;
    }

    .password-toggle .toggle-icon {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <main class="form-signin mb-10">
                <div class="logo-container">
                    <img src="LogooB.png" alt="Logo">
                </div>
                <h1 class="h3 mb-5 fw-bold text-center">Log In</h1>
              
                <form action="login" method="post">
                    @csrf

                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-floating password-toggle">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <span class="toggle-icon" onclick="togglePasswordVisibility()"> <i class="fa fa-eye-slash" aria-hidden="true"></i> </span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <hr class="w-100 my-3" style="border-top: 1px solid #9f9f9f;">
                        <span class="px-3">atau</span>
                        <hr class="w-100 my-3" style="border-top: 1px solid #9f9f9f;">
                    </div>
                    <a href="#" class="btn-google">
                        <img src="icon-google.png" alt="Google"> Google
                    </a>

                    <small class="d-block text-center mt-4">Belum memiliki akun? <a class="small-link" href="/register">Register</a></small>
                    <small class="d-block text-center mt-4"><a class="small-link" href="/forgot-password">Forgot your password?</a></small>
                    <button class="btn btn-primary w-100 py-2 mt-2" type="submit">Login</button>
                </form>
            </main>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.querySelector('.toggle-icon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>'; 
    } else {
        passwordInput.type = 'password';
        toggleIcon.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>'; 
    }
}
</script>
@endsection
