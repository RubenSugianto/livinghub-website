@extends('master')

@section('title', 'My Profile')

@section('styles')
<style>

    .logo-container {
        text-align: center;
        margin-bottom: 0px;
    }

    .logo-container img {
        width: 400px; 
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 1000px;
        background-color: #f8f9fa;
        margin: 10px;
        padding-top: 500px;
    }

    .container {
        width: 1000px;
        height: 1200px;
        padding: 60px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-top: 250px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select,
    input[type="number"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      box-sizing: border-box;
      margin-bottom: 15px;
    }

    input[type="password"] {
      visibility: hidden;
      display: none;
    }

    .btn-primary {
      background-color: #000000;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }

    .btn-secondary {
      background-color: #000000;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }

    .btn-primary:hover {
      background: #4A4AC4;
      box-shadow: #4A4AC4 0 10px 20px -10px;
    }

    .btn-secondary:hover {
      background: #4A4AC4;
      box-shadow: #4A4AC4 0 10px 20px -10px;
    }
</style>
@endsection

@section('content')
<body>
    <div class="container">
        <div class="logo-container">
            <img src="LogooB.png" alt="Logo">
        </div>
        <h1 class="h3 mb-5 fw-bold text-center">Profil Saya</h1>
        
        <!-- <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" placeholder="Your Fullname" readonly> -->

        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" value=" {{$profile->fullname}} " readonly>

        <label for="username">Username:</label>
        <input type="text" id="username" value="{{ $profile->username }}" readonly>

        <label for="email">Email address:</label>
        <input type="email" id="email" value="{{ $profile->email }}" readonly>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" value="{{ $profile->phone }}" readonly>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" value="{{ $profile->gender }}" readonly>

        <label for="age">Age:</label>
        <input type="number" id="age" value="{{ $profile->age }}" readonly>

        <button class="btn-primary" onclick="editProfile()">Edit Profile</button>
        <button class="btn-secondary" onclick="saveProfile()">Logout</button>
 
    </div>
</body>
@endsection
