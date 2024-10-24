@extends('master')

@section('title', 'Login Page')

@section('styles')
<style>
body {
    display: flex;
    justify-content: center;
    align-items: flex-start; /* Ganti dari center ke flex-start agar container berada di atas */
    height: 100vh;
    background-color: #f8f9fa;
    margin: 0;
    padding-top: 350px; 
}

.container {
    width: 800px; 
    max-width: 100%;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    font-size: 12px; 
    margin: 20px auto;
    padding: 15px; 
}

.logo-container {
    text-align: center;
    margin-bottom: 15px; 
}

.logo-container img {
    width: 200px; 
}

h2 {
    font-size: 20px; 
    text-align: center;
    margin-bottom: 15px; 
}

.form-signin {
    width: 100%;
    max-width: 400px; 
    margin: 0 auto;
}

.form-floating {
    margin-bottom: 8px; 
    width: 100%;
    max-width: 400px; 
    margin-left: auto;
    margin-right: auto;
}

.form-control {
    width: 100%;
    padding: 8px; 
    font-size: 12px; 
    height: 40px; 
    margin-bottom: 8px; 
}

.btn-primary {
    background-color: #5E5DF0;
    border-color: #5E5DF0;
    font-size: 12px; 
    padding: 8px 16px; 
    width: 100%;
    max-width: 400px; 
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: 0 auto; 
    display: block; 
}

.btn-primary:hover {
    background-color: #4A4AC4;
    border-color: #4A4AC4;
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
    font-size: 12px;
    line-height: 1.2;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 8px; 
    width: 100%;
    max-width: 400px; 
    height: 40px; 
    border-radius: 8px;
    box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
    transition: all 0.4s;
    position: relative;
    z-index: 1;
    margin: 0 auto 8px auto; 
    text-decoration: none;
    background-color: #ffffff;
    color: #555555;
}

.btn-google::before {
    content: "";
    display: block;
    position: absolute;
    z-index: -1;
    width: 100%;
    height: 100%;
    border-radius: 8px;
    top: 0;
    left: 0;
    background: linear-gradient(45deg, #00dbde, #fc00ff);
    opacity: 0;
    transition: all 0.4s;
}

.btn-google img {
    width: 12px; 
    margin-right: 5px; 
    padding-bottom: 1.5px;
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
    border-radius: 8px;
    padding: 8px;
}

.password-toggle {
    position: relative;
}

.password-toggle .toggle-icon {
    position: absolute;
    top: 50%;
    right: 8px; 
    transform: translateY(-50%);
    cursor: pointer;
}
.alert {
    padding: 15px;
    margin: 10px auto;
    border-radius: 10px;
    width: calc(100% - 40px);
    position: relative;
    top: -10px;
    margin-top: 150px;
    display: flex;
    align-items: center;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-warning {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert .btn-close {
    background: transparent;
    border: none;
    font-size: 1.5rem;
    color: #721c24; 
    cursor: pointer;
    margin-left: auto;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
}

.alert-success .btn-close {
    color: #155724;
}

.alert .btn-close:hover {
    color: #5a3b02;
}

.alert .btn-close:active {
    transform: translateY(-50%) scale(1.1);
}

.alert .alert-icon {
    font-size: 2rem;
    margin-right: 15px;
    vertical-align: middle;
}

.alert.fade {
    opacity: 1;
    transform: translateY(0);
}

.alert.fade.hide {
    opacity: 0;
    transform: translateY(-15px);
}

</style>
@endsection
@section('content')
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-check-circle alert-icon" aria-hidden="true"></i>
    <strong>{{ session('success') }}</strong>
    <button type="button" class="btn-close close-btn" aria-label="Close" onclick="this.parentElement.style.display='none';">✖</button>
</div>
@endif

@if(session()->has('password_reset_success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-check-circle alert-icon" aria-hidden="true"></i>
    <strong>{{ session('password_reset_success') }}</strong>
    <button type="button" class="btn-close close-btn" aria-label="Close" onclick="this.parentElement.style.display='none';">✖</button>
</div>
@endif

@if(session()->has('loginError'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa fa-exclamation-triangle alert-icon" aria-hidden="true"></i>
    <strong>{{ session('loginError') }}</strong>
    <button type="button" class="btn-close close-btn" aria-label="Close" onclick="this.parentElement.style.display='none';">✖</button>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <main class="form-signin mb-10">
                <div class="logo-container">
                    <img src="LogooB.png" alt="Logo">
                </div>
                <h1 class="h3 mb-5 fw-bold text-center">Log In</h1>
              
                <form action="login" method="post">
                    @csrf

                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        <label for="email">Email</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-floating password-toggle">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Kata Sandi</label>
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
                    <small class="d-block text-center mt-4"><a class="small-link" href="/forgot-password">Lupa password?</a></small>
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
