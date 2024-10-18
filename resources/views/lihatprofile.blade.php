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
    padding-top: 330px;
    font-size: 12px; 
}

.container {
    width: 100%;
    max-width: 1200px;
    padding: 40px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    display: flex;
    box-sizing: border-box;
    font-size: 12px; 
    margin-top: 150px;
    margin-bottom: 30px;
}

.sidebar {
    width: 25%;
    padding-right: 20px;
    border-right: 1px solid #e0e0e0;
    font-size: 12px; 
}

.sidebar a {
    display: block;
    padding: 10px 0;
    color: #333;
    text-decoration: none;
    position: relative;
    font-size: 12px; 
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
    font-size: 12px; 
}

.profile-header {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    font-size: 12px; 
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
    font-size: 12px; 
}

.profile-pic img {
    border-radius: 10%;
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

.form-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    font-size: 12px; 
}

label {
    min-width: 150px;
    margin-right: 10px;
    font-weight: bold;
    font-size: 12px; 
}

input[type="text"],
input[type="email"],
input[type="number"],
select {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
    width: 500px; 
    font-size: 12px; 
}

input[type="file"] {
    display: none;
}

.custom-file-upload {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 12px; 
}

.custom-file-upload:hover {
    background-color: #f1f1f1;
}

.btn-primary {
    background-color: #4A4AC4;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    float: right;
    font-size: 12px; 
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
    font-size: 12px; 
}

.invalid-feedback {
    color: red;
    font-size: 12px; 
}
</style>
@endsection
@section('content')

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Confirm Account Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your account? This action is permanent and cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteAccount">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="sidebar">
        <a href="#" class="active">Personal Info</a>
        <a href="#">Change Password</a>
        <a class="delete-account" href="javascript:void(0);" data-toggle="modal" data-target="#deleteAccountModal">Delete Account</a>
    </div>
    <div class="content">
        <div class="profile-header">
            <h1>Personal Info</h1>
        </div>
        <div class="profile-pic">
        <img id="profilePicturePreview" src="{{ Chatify::getUserWithAvatar(Auth::user())->avatar }}" alt="Profile Picture">
            <button type="button" class="delete-btn" id="deletePictureBtn">Remove Image</button>
        </div>
        <form id="profileForm" action="{{ route('profile.update') }}" method="PUT" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="profilepicture">Add / Edit Profile Picture</label>
                <label for="profilepicture" class="custom-file-upload">
                    <i class="fa fa-cloud-upload"></i> Upload File
                </label>
                <input type="file" id="profilepicture" name="profilepicture" accept="image/*">
                <input type="hidden" name="remove_picture" id="removePicture" value="0">
            </div>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror" placeholder="Full Name" required value="{{ old('name', $profile->name) }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username', $profile->username) }}">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender">
                    <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" value="{{ old('age', $profile->age) }}">
            </div>
            <button type="submit" class="btn-primary">Save Changes</button>
        </form>

        <form id="delete-account-form" action="{{ route('profile.destroy') }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('profilepicture').addEventListener('change', function(event) {
            previewImage(event);
            document.getElementById('removePicture').value = '0'; 
        });

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profilePicturePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        document.getElementById('deletePictureBtn').addEventListener('click', function() {
            document.getElementById('profilePicturePreview').src = '{{ asset('defaultprofilepicture.png') }}';
            document.getElementById('removePicture').value = '1';
        });

        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const confirmSave = confirm('Are you sure you want to save the changes?');
            if (confirmSave) {
                fetch('{{ route('profile.update') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the profile picture in the UI
                        document.getElementById('profilePicturePreview').src = data.profile_picture;
                        document.querySelector('.dropdown-content .auth-text img').src = data.profile_picture;

                        // Redirect to home page after saving
                        window.location.href = '{{ route('home') }}';
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
        
        // Show delete account modal
        document.querySelector('.delete-account').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('deleteAccountModal').style.display = 'block';
        });

        // Close modal function
        function closeModal() {
            document.getElementById('deleteAccountModal').style.display = 'none';
        }

        function removeBackdrop() {
            let backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        }

        // Close modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('deleteAccountModal') || 
                event.target.matches('#deleteAccountModal .btn-secondary') || 
                event.target.matches('#deleteAccountModal .btn-close')
            ) {
                closeModal();
                removeBackdrop();
            }
        });

        document.getElementById('confirmDeleteAccount').addEventListener('click', function() {
            console.log('Delete button clicked');
            document.getElementById('delete-account-form').submit();
        });
    });
</script>

@endsection
