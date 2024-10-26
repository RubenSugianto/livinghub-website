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

/* Update the form-group style */
.form-group {
    margin-bottom: 20px;
    font-size: 12px;
}

/* Add a new wrapper div for label and input */
.input-wrapper {
    display: flex;
    align-items: center;
    width: 100%;
}

/* Adjust label style */
.input-wrapper label {
    min-width: 150px;
    margin-right: 10px;
    font-weight: bold;
    font-size: 12px; 
}

/* Adjust input container style */
.input-container {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Style for input fields */
.input-container input,
.input-container select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 12px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

/* Style for error message */
.invalid-feedback {
    color: red;
    font-size: 12px;
    margin-top: 4px;
    display: block;
}

/* Style for invalid input */
input.is-invalid {
    border-color: red;
}

/* Common input field styles */
input[type="text"],
input[type="email"],
input[type="number"],
input[type="password"],
select {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc; /* Default border color */
    border-radius: 3px;
    box-sizing: border-box;
    width: 100%; 
    font-size: 12px; 
    transition: border-color 0.3s, box-shadow 0.3s; /* Smooth transition for border color and shadow */
}

/* Style for input fields on focus */
input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    outline: 2px solid; /* Custom outline color and thickness */
    box-shadow: 0 0 5px rgba(74, 74, 196, 0.5); /* Optional shadow for better visibility */
}

input[readonly] {
    background-color: #f1f1f1; /* Light gray background */
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

.form-group .invalid-feedback {
    color: red;
    font-size: 12px; 
    display: block;
    margin-top: 0.25rem;
}

.password-toggle-container input {
    width: 100%; /* Ensure it takes full width */
    padding-right: 40px; /* Make space for the eye icon */
    border-radius: 3px; /* Ensure consistent border-radius */
    box-sizing: border-box; /* Ensure padding doesn’t affect width */
}

.password-toggle-container {
    position: relative;
    flex: 1; /* Ensure the container stretches to the same width */
}

.password-toggle-container .toggle-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%); /* Center vertically */
    cursor: pointer;
    font-size: 18px;
    color: #aaa;
}

.password-toggle-container .toggle-icon:hover {
    color: #333;
}

/* Password requirements styling */
.password-requirements {
    margin-top: 15px;
    margin-bottom: 25px;
    padding: 15px;
    background-color: #f8f9fa;
    border-left: 4px solid #4A4AC4;
    border-radius: 4px;
    font-size: 12px;
    color: #666;
}

.password-requirements h6 {
    color: #333;
    margin: 0 0 8px 0;
    font-size: 13px;
    font-weight: 600;
}

.password-requirements ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.password-requirements li {
    margin: 4px 0;
    padding-left: 20px;
    position: relative;
}

.password-requirements li::before {
    content: "•";
    position: absolute;
    left: 8px;
    color: #4A4AC4;
}

/* Add margin before the submit button */
.password-requirements + .btn-primary {
    margin-top: 20px;
}

.btn-primary {
    background-color: #4A4AC4;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    font-size: 12px;
    float: right;
}
</style>
@endsection
@section('content')

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Konfirmasi Penghapusan Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteAccount">Iya</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="sidebar">
        <a href="#" class="active" id="informasiPribadiLink">Informasi Pribadi</a>
        @if($profile->google_id != null && $profile->password == null)
            <a href="#" id="ubahKataSandiLink">Set Kata Sandi</a>
        @else
            <a href="#" id="ubahKataSandiLink">Ubah Kata Sandi</a>
        @endif
        <a class="delete-account" href="javascript:void(0);" data-toggle="modal" data-target="#deleteAccountModal">Hapus Akun</a>
    </div>
    <div class="content">
        <div id="informasiPribadiSection">
            <div class="profile-header">
                <h1>Informasi Pribadi</h1>
            </div>
            <div class="profile-pic">
            <img id="profilePicturePreview" src="{{ Chatify::getUserWithAvatar(Auth::user())->avatar }}" alt="Profile Picture">
                <button type="button" class="delete-btn" id="deletePictureBtn">Hapus Gambar</button>
            </div>
            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="profilepicture">Tambah / Edit Foto Profil</label>
                        <div class="input-container">
                            <label for="profilepicture" class="custom-file-upload">
                                <i class="fa fa-cloud-upload"></i> Upload File
                            </label>
                            <input type="file" id="profilepicture" name="profilepicture" accept="image/*" class="@error('profilepicture') is-invalid @enderror">
                            @error('profilepicture')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <input type="hidden" name="remove_picture" id="removePicture" value="0">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="name">Nama Lengkap</label>
                        <div class="input-container">
                            <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror" placeholder="Full Name" required value="{{ old('name', $profile->name) }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="username">Username</label>
                        <div class="input-container">
                            <input type="text" id="username" name="username" value="{{ old('username', $profile->username) }}" class="@error('username') is-invalid @enderror">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="email">Email</label>
                        <div class="input-container">
                            <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}" class="@error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="phone">Nomor Telepon</label>
                        <div class="input-container">
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}" class="@error('phone') is-invalid @enderror">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="gender">Jenis Kelamin</label>
                        <div class="input-container">
                            <select id="gender" name="gender" class="@error('gender') is-invalid @enderror">
                                <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="age">Umur</label>
                        <div class="input-container">
                            <input type="number" id="age" name="age" value="{{ old('age', $profile->age) }}" class="@error('age') is-invalid @enderror">
                            @error('age')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Simpan</button>
            </form>

            <form id="delete-account-form" action="{{ route('profile.destroy') }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>

        <div id="ubahKataSandiSection" style="display: none;">
            <div class="profile-header">
                @if($profile->google_id != null && $profile->password == null)
                    <h1>Set Kata Sandi</h1>
                @else
                    <h1>Ubah Kata Sandi</h1>
                @endif
                
            </div>
            <form id="changePasswordForm" 
                action="{{ $profile->google_id != null && $profile->password == null ? route('password.set') : route('password.change') }}" 
                method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="email">Email</label>
                        <div class="input-container">
                            <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror" required value="{{ old('email', Auth::user()->email) }}" readonly>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                @if($profile->password != null)
                    <div class="form-group">
                        <div class="input-wrapper">
                            <label for="old_password">Kata Sandi Lama</label>
                            <div class="input-container">
                                <div class="password-toggle-container">
                                    <input type="password" id="old_password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password" required>
                                    <span class="toggle-icon" onclick="togglePasswordVisibility('old_password', this)">
                                        <i class="fa fa-eye-slash"></i>
                                    </span>
                                </div>
                                @error('old_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="password">Kata Sandi Baru</label>
                        <div class="input-container">
                            <div class="password-toggle-container">
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" required>
                                <span class="toggle-icon" onclick="togglePasswordVisibility('password', this)">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <div class="input-container">
                            <div class="password-toggle-container">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" required>
                                <span class="toggle-icon" onclick="togglePasswordVisibility('password_confirmation', this)">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                            </div>
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="password-requirements">
                    <h6>Persyaratan Kata Sandi:</h6>
                    <ul>
                        <li>Minimal 8 karakter</li>
                        <li>Minimal 1 Huruf Besar</li>
                        <li>Minimal 1 Huruf Kecil</li>
                        <li>Minimal 1 Angka</li>
                        <li>Minimal 1 Karakter Spesial</li>
                    </ul>
                </div>

                <button type="submit" class="btn-primary">Simpan</button>
            </form>
        </div>

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

        document.getElementById('informasiPribadiLink').addEventListener('click', function(event) {
            event.preventDefault();
            // Show Informasi Pribadi section
            document.getElementById('informasiPribadiSection').style.display = 'block';
            document.getElementById('ubahKataSandiSection').style.display = 'none';
            this.classList.add('active');
            document.getElementById('ubahKataSandiLink').classList.remove('active');
        });

        document.getElementById('ubahKataSandiLink').addEventListener('click', function(event) {
            event.preventDefault();
            // Show Ubah Kata Sandi section
            document.getElementById('informasiPribadiSection').style.display = 'none';
            document.getElementById('ubahKataSandiSection').style.display = 'block';
            this.classList.add('active');
            document.getElementById('informasiPribadiLink').classList.remove('active');
        });

        window.togglePasswordVisibility = function(inputId, iconElement) {
            const passwordInput = document.getElementById(inputId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconElement.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>'; 
            } else {
                passwordInput.type = 'password';
                iconElement.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>'; 
            }
        };

        @if ($errors->has('old_password') || $errors->has('password') || $errors->has('password_confirmation'))
            // If there are errors in the password change form, show the ubahKataSandiSection
            informasiPribadiSection.style.display = 'none';
            ubahKataSandiSection.style.display = 'block';
        @else
            // Otherwise, show the informasiPribadiSection
            informasiPribadiSection.style.display = 'block';
            ubahKataSandiSection.style.display = 'none';
        @endif
    });
</script>

@endsection
