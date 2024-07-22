@extends('master')

@section('title', 'My Profile')

@section('styles')
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;
        max-width: 2000px; 
        padding: 40px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        display: flex;
        margin-top: 500px; 
        box-sizing: border-box; 
    }

    .sidebar {
        width: 25%;
        padding-right: 20px;
        border-right: 1px solid #e0e0e0;
    }

    .sidebar a {
        display: block;
        padding: 10px 0;
        color: #333;
        text-decoration: none;
        position: relative;
    }

    .sidebar a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        background: #4A4AC4;
        bottom: 0;
        left: 0;
        transition: width 0.3s;
    }

    .sidebar a:hover::after {
        width: 100%;
    }

    .sidebar a.active {
        font-weight: bold;
        color: #4A4AC4;
        border-bottom: 2px solid #4A4AC4;
        padding-bottom: 8px;
        margin-bottom: 10px;
    }

    .sidebar .delete-account {
        color: red;
        cursor: pointer;
        display: block;
        margin-top: 20px;
        text-decoration: none;
    }

    .sidebar .delete-account:hover::after {
        width: 0;
    }

    .content {
        width: 75%;
        padding-left: 20px;
        box-sizing: border-box; 
    }

    .profile-header {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .profile-header h1 {
        margin: 0;
        font-size: 24px;
    }

    .profile-pic {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .profile-pic img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
    }

    .profile-pic button {
        background-color: #4A4AC4;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .profile-pic button:hover {
        background-color: #3737c1;
    }

    .profile-pic .delete-btn {
        background-color: #ff4b4b;
    }

    .profile-pic .delete-btn:hover {
        background-color: #ff1f1f;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box; 
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #4A4AC4;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #3737c1;
    }

    .delete-account {
        color: red;
        cursor: pointer;
        display: block;
        margin-top: 20px;
        text-decoration: none;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="sidebar">
        <a href="#" class="active">Personal Info</a>
        <a href="#">Change Password</a>
        <a class="delete-account" href="#">Delete Account</a>
    </div>
    <div class="content">
        <div class="profile-header">
            <h1>Personal Info</h1>
        </div>
        <div class="profile-pic">
            <img src="https://kukangku.id/wp-content/uploads/2021/08/kukang-kalimantan-scaled.jpg" alt="Profile Picture">
            <button>Upload Picture</button>
            <button class="delete-btn">Delete Picture</button>
        </div>

        <form>
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" value="{{ $profile->fullname }}" readonly>

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

            <button type="submit" class="btn-primary">Save Changes</button>
        </form>
    </div>
</div>
@endsection
