@extends('master')

@section('navbar')
    @include('partials.navbaruser')
@endsection

@section('title', 'Verify Email')

@section('styles')
<style>
 :root {
        --primary-color: #5E5DF0;
        --secondary-color: #4A4AC4;
        --text-color: #393232;
        --background-color: #f5f5f5;
        --border-radius: 5px;
        --transition-speed: 0.3s;
        --font-family: "Poppins", sans-serif;
    }

    body {
        line-height: 1.5;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-color);
        margin: 0;
        padding-top: 0;
        font-family: var(--font-family);
    }

    html {
        box-sizing: border-box;
        font-size: 70%;
        overflow-y: scroll;
        letter-spacing: 0.6px;
        line-height: 1.4;
        -webkit-user-select: none;
        backface-visibility: hidden;
        -webkit-font-smoothing: subpixel-antialiased;
    }


    .container {
        width: 800px;
        max-width: 100%;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        font-size: 12px;
        margin: 30px auto;
        padding: 15px;
        margin-top: 100px;
    }

    .logo-container {
        text-align: center;
        margin-bottom: 15px;
    }

    .logo-container img {
        width: 200px;
    }

    h1 {
        font-size: 20px;
        text-align: center;
        margin-bottom: 15px;
    }

    .form-signin {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    .icon-envelope {
        font-size: 8rem;
        color: #5E5DF0;
        display: block;
        text-align: center;
        margin-bottom: 10px;
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
        display: block;
    }

    .btn-primary:hover {
        background-color: #4A4AC4;
        border-color: #4A4AC4;
    }

    .alert {
        padding: 15px;
        margin: 10px auto;
        border-radius: 10px;
        width: calc(100% - 40px);
        display: flex;
        align-items: center;
        position: relative;
        margin-top: 100px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert .btn-close {
        background: transparent;
        border: none;
        font-size: 1.5rem;
        color: #155724;
        cursor: pointer;
        margin-left: auto;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
    }

    .alert .btn-close:hover {
        color: #0b2e13;
    }

    .alert .alert-icon {
        font-size: 2rem;
        margin-right: 15px;
    }
</style>
@endsection

@section('content')
@if(session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-check-circle alert-icon" aria-hidden="true"></i>
    <strong>{{ session('message') }}</strong>
    <button type="button" class="btn-close close-btn" aria-label="Close" onclick="this.parentElement.style.display='none';">✖</button>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <main class="form-signin mb-10">
                <div class="logo-container">
                    <img src="{{ asset('LogooB.png') }}" alt="Logo">
                </div>
                <h1 class="h3 mb-5 fw-bold text-center">Verifikasi Email</h1>
                
                <!-- Large icon between the title and paragraph -->
                <i class="bi bi-envelope-check icon-envelope"></i>
                <!-- <i class="bi bi-envelope-check-fill icon-envelope"></i> -->

                <h6 class="mb-5 fw-bold text-center">Silahkan verifikasi email anda</h6>
                
                <!-- Informational text for email verification -->
                <p class="text-center mb-4">
                    Kami telah mengirimkan link verifikasi ke email Anda. Silakan cek email Anda dan klik link untuk verifikasi.
                </p>

                <!-- Resend Verification Email Form -->
                <form action="{{ route('verification.send') }}" method="post">
                    @csrf
                    <button class="btn btn-primary w-100 py-2 mt-2" type="submit">Kirim Ulang Link Verifikasi</button>
                </form>
            </main>
        </div>
    </div>
</div>
@endsection
