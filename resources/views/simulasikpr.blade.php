@extends('master')

@section('navbar')
    @include('partials.navbaruser')
@endsection

@section('title', 'Simulasi KPR')

@section('content')
<div class="container-fluid mt-5 mb-5 simulasikpr-page">
    <div class="simulasi-kpr-container">
        <h1 class="text-center mb-3">Simulasi KPR</h1>
        <p class="text-center">Cek estimasi pembiayaan kredit rumah dengan kalkulator KPR</p>
        <form action="{{ route('simulasikpr.calculate') }}" method="POST" class="kpr-form">
            @csrf
            <div class="form-group">
                <label for="harga_rumah">Harga Properti</label>
                <input type="number" class="form-control" id="harga_rumah" name="harga_rumah" required>
            </div>
            <div class="form-group">
                <label for="uang_muka">Uang Muka</label>
                <input type="number" class="form-control" id="uang_muka" name="uang_muka" required>
            </div>
            <div class="form-group">
                <label for="suku_bunga">Suku Bunga (%)(Bulan)</label>
                <input type="number" class="form-control" id="suku_bunga" name="suku_bunga" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="tenor">Tenor (tahun)</label>
                <input type="number" class="form-control" id="tenor" name="tenor" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Hitung Cicilan</button>
        </form>
    </div>
</div>
@endsection

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

    .simulasi-kpr-container {
        width: 100%;
        max-width: 800px;
        background: #fff;
        padding: 30px; 
        border-radius: 10px;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1); 
        margin: 0 auto;
        border: 1px solid #ccc;
        position: relative;
        margin-top: 50px;
    }

    .simulasi-kpr-container h1 {
        text-align: center;
        margin-bottom: 20px; 
        color: #333;
        font-size: 20px; 
    }

    .simulasi-kpr-container p {
        text-align: center;
        margin-bottom: 20px; 
        color: #666;
        font-size: 14px; 
    }

    .simulasi-kpr-container label {
        font-weight: 600;
        color: #444;
        font-size: 14px; 
    }

    .simulasi-kpr-container input[type="number"],
    .simulasi-kpr-container button {
        width: 100%;
        padding: 12px; 
        margin-bottom: 15px;
        border-radius: 6px; 
        border: 1px solid #ddd;
        box-sizing: border-box;
        font-size: 14px; 
    }

    .simulasi-kpr-container button {
        background-color: #5e5df0;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s ease;
    }

    .simulasi-kpr-container button:hover {
        background-color: #4a4ac4;
    }


</style>
@endsection
