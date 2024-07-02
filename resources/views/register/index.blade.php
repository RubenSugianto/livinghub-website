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
        padding-top: 500px; /* Adjust the top padding as needed */
    }

    .container {
        width: 1000px;
        height: 1200px;
        padding: 60px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-top: 250px; /* Adjust the top margin as needed */
    }

    .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-container img {
            width: 400px; 
        }

    .form-registration {
        width: 100%;
        max-width: 700px;
        margin: 0 auto;
    }

    .form-floating {
        margin-bottom: 15px; /* Adjust the bottom margin between form fields */
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

    .small a {
        color: #007bff;
    }

    .small a:hover {
        color: #0056b3;
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

    .toggle-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
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

        <div class="form-floating position-relative">
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
            <img src="icon-google.png" alt="Google"> Google
        </a>

        <small class="d-block text-center mt-4">Already have an account? <a class="text-black" href="/login">Login</a></small>
        <button class="btn btn-primary w-100 py-2 mt-2" type="submit">Register</button>
    </form>
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
