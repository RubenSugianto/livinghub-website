@extends('master')

@section('title', 'Hasil KPR')

@section('content')
<div class="container mt-5 mb-5">
    <div class="simulasi-kpr-container">
        <h1 class="text-center">Hasil KPR</h1>
        <p>Jumlah Pinjaman: Rp {{ number_format($jumlah_pinjaman, 2) }}</p>
        <p>Tenor: {{ $tenor }} tahun</p>
        <p>Cicilan Per Bulan: Rp {{ number_format($cicilan_per_bulan, 2) }}</p>
        <p>Cicilan Per Tahun: Rp {{ number_format($cicilan_per_tahun, 2) }}</p>
        <button type="button" onclick="history.back()" class="btn btn-primary btn-block mt-4">Kembali</button>
    </div>
</div>
@endsection

@section('styles')
<style>
    .simulasi-kpr-container {
        max-width: 600px;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
        border: 1px solid #ccc;
    }

    .simulasi-kpr-container h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .simulasi-kpr-container button {
        background-color: #5e5df0;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s ease;
    }

    .simulasi-kpr-container input,
    .simulasi-kpr-container button {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 6px;
        border: 1px solid #ddd;
        box-sizing: border-box;
    }

    .simulasi-kpr-container button {
        background-color: #5e5df0;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s ease;
        margin-top: 20px; /* Tambahkan margin-top di sini */
    }

    .simulasi-kpr-container button:hover {
        background-color: #4a4ac4;
    }

</style>
@endsection
