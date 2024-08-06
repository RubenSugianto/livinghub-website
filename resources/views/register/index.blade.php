@extends('master')

@section('title', 'Register Page')

@section('styles')
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f8f9fa;
    margin: 0;
    padding-top: 530px; /* Reduced padding-top */
}

.container {
    width: 800px; /* Reduced width */
    max-width: 100%;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    font-size: 12px; /* Reduced font-size */
    margin: 20px auto;
    padding: 15px; /* Reduced padding */
}

.logo-container {
    text-align: center;
    margin-bottom: 15px; /* Reduced margin-bottom */
}

.logo-container img {
    width: 200px; /* Reduced logo size */
}

h2 {
    font-size: 20px; /* Reduced font-size */
    text-align: center;
    margin-bottom: 15px; /* Reduced margin-bottom */
}

.form-signin {
    width: 100%;
    max-width: 400px; /* Reduced width */
    margin: 0 auto;
}

.form-floating {
    margin-bottom: 8px; /* Reduced margin-bottom */
    width: 100%;
    max-width: 400px; /* Reduced width */
    margin-left: auto;
    margin-right: auto;
}

.form-control, .form-select {
    width: 100%;
    padding: 8px; /* Reduced padding */
    font-size: 12px; /* Reduced font-size */
    height: 40px; /* Reduced height */
    margin-bottom: 8px; /* Reduced margin-bottom */
}

.btn-primary {
    background-color: #5E5DF0;
    border-color: #5E5DF0;
    font-size: 12px; /* Reduced font-size */
    padding: 8px 16px; /* Reduced padding */
    width: 100%;
    max-width: 400px; /* Match the width of input boxes */
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin: 0 auto; /* Centering */
    display: block; /* Centering */
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
    font-size: 12px; /* Reduced font-size */
    line-height: 1.2;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 8px; /* Reduced padding */
    width: 100%;
    max-width: 400px; /* Match the width of input boxes */
    height: 40px; /* Reduced height */
    border-radius: 8px;
    box-shadow: 0 1px 5px 0px rgba(0, 0, 0, 0.2);
    transition: all 0.4s;
    position: relative;
    z-index: 1;
    margin: 0 auto 8px auto; /* Centering and margin */
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
    width: 12px; /* Reduced width */
    margin-right: 5px; /* Reduced margin-right */
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
    padding: 8px; /* Reduced padding */
}

.password-toggle {
    position: relative;
}

.password-toggle .toggle-icon {
    position: absolute;
    top: 50%;
    right: 8px; /* Reduced right position */
    transform: translateY(-50%);
    cursor: pointer;
}

.divider-text {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 20px 0;
}

.divider-text span {
    padding: 0 10px;
    font-size: 12px; /* Same font size as other text */
    color: #6c757d;
}

.divider-text::before, .divider-text::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #9f9f9f;
    margin: 0 10px;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="logo-container">
        <img src="LogooB.png" alt="Logo">
    </div>
    <h1 class="h3 mb-5 fw-bold text-center">Register</h1>
    <form action="/register" method="post" class="form-registration">
        @csrf
        <div class="form-floating">
            <input type="text" name="fullname" class="form-control rounded-top @error('fullname') is-invalid @enderror" id="fullname" placeholder="Name" required value="{{ old('fullname') }}">
            <label for="fullname">Full Name</label>
            @error('fullname')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-floating">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
            <label for="username">Username</label>
            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-floating">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
            <label for="email">Email address</label>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-floating password-toggle">
            <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
            <label for="password">Password</label>
            <span class="toggle-icon" onclick="togglePasswordVisibility()">
                <i class="fa fa-eye-slash" aria-hidden="true"></i>
            </span>
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-floating">
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" required value="{{ old('phone') }}">
            <label for="phone">Phone</label>
            @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-floating">
            <select name="gender" class="form-select @error('gender') is-invalid @enderror" id="gender" required>
                <option value="">Select Gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
            <label for="gender">Gender</label>
            @error('gender')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-floating">
            <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" id="age" placeholder="Age" required value="{{ old('age') }}">
            <label for="age">Age</label>
            @error('age')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="d-flex justify-content-between mb-3">
                        <hr class="w-100 my-3" style="border-top: 1px solid #9f9f9f;">
                        <span class="px-3">atau</span>
                        <hr class="w-100 my-3" style="border-top: 1px solid #9f9f9f;">
                    </div>

        <a href="#" class="btn btn-google">
            <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google"> Google
        </a>

        <button class="btn btn-lg btn-primary" type="submit">Register</button>

        <small class="d-block text-center mt-3">Already registered? <a href="/login" class="small-link">Login</a></small>
    </form>
</div>

<script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var toggleIcon = document.querySelector('.toggle-icon i');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    } else {    
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    }
}
</script>
@endsection
