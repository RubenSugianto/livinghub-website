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

    input[type="file"] {
        margin-bottom: 15px; /* Add this line to add space */
    }

    .btn-primary {
        background-color: #4A4AC4;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: right;
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
            <img id="profilePicturePreview" src="{{ $profile->profilepicture ? asset('storage/' . $profile->profilepicture) : asset('defaultprofilepicture.png') }}" alt="Profile Picture">
            <button type="button" class="delete-btn" id="deletePictureBtn">Remove Image</button>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="profilepicture" class="formbold-form-label">Add / Edit Profile Picture</label>
                <input type="file" class="form-control" id="profilepicture" name="profilepicture" accept="image/*" onchange="previewImage(event)">

                <input type="hidden" name="remove_picture" id="removePicture" value="0">

                <div class="form-floating">
                    <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" id="fullname" placeholder="Full Name" required value="{{ old('fullname', $profile->fullname) }}">
                    <label for="fullname">Full Name</label>
                    @error('fullname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username', $profile->username) }}">
                    <label for="username">Username</label>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" required value="{{ old('email', $profile->email) }}">
                    <label for="email">Email address</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" required value="{{ old('phone', $profile->phone) }}">
                    <label for="phone">Phone</label>
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <select name="gender" class="form-select @error('gender') is-invalid @enderror" id="gender" required>
                        <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <label for="gender">Gender</label>
                    @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" id="age" placeholder="Age" required value="{{ old('age', $profile->age) }}">
                    <label for="age">Age</label>
                    @error('age')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div style="text-align: right;">
                    <button type="submit" class="btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('profilePicturePreview');
            output.src = reader.result;
            document.getElementById('removePicture').value = '0'; // Reset the remove picture flag
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('deletePictureBtn').addEventListener('click', function() {
        const output = document.getElementById('profilePicturePreview');
        output.src = '{{ asset('defaultprofilepicture.png') }}';
        document.getElementById('removePicture').value = '1'; // Set the remove picture flag
    });
</script>
@endsection

