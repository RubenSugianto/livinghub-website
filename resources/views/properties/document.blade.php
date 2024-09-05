@extends('master')

@section('content')
<div class="container">
    <!-- Back Button placed at the top-left corner inside the container -->
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-secondary back-btn" onclick="window.history.back();">
                <i class="fa fa-angle-left" aria-hidden="true"></i> Kembali
            </button>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Verifikasi Dokumen Properti</h1>

            <form action="{{ route('document.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Document Type -->
                <div class="form-group-row">
                    <label for="documentType">Jenis Sertifikat</label>
                    <div class="input-container">
                        <select class="form-control" id="documentType" name="documentType" required>
                            <option value="" disabled selected>Pilih jenis sertifikat</option>
                            <option value="SHM" {{ old('documentType', $document->type ?? '') == 'SHM' ? 'selected' : '' }}>SHM</option>
                            <option value="SHGB" {{ old('documentType', $document->type ?? '') == 'SHGB' ? 'selected' : '' }}>SHGB</option>
                            <option value="SHGU" {{ old('documentType', $document->type ?? '') == 'SHGU' ? 'selected' : '' }}>SHGU</option>
                            <option value="Hak Pakai" {{ old('documentType', $document->type ?? '') == 'Hak Pakai' ? 'selected' : '' }}>Hak Pakai</option>
                        </select>
                    </div>
                </div>

                <!-- Document Name -->
                <div class="form-group-row">
                    <label for="documentName">Nama Dokumen</label>
                    <div class="input-container">
                        <input type="text" class="form-control" id="documentName" name="documentName" value="{{ old('documentName', $document->name ?? '') }}">
                    </div>
                </div>

                <!-- Document Status -->
                <div class="form-group-row">
                    <label for="documentStatus">Status Sertifikat</label>
                    <div class="input-container">
                        <p class="form-control-plaintext" id="documentStatus">{{ $document->status ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Upload Document -->
                <div class="form-group-row">
                    <label for="document">Upload Dokumen PDF (Maksimal 1 Dokumen)</label>
                    <div class="input-container">
                        <input type="file" class="form-control" id="document" name="document" accept=".pdf">
                        <p class="helper-text">Format dokumen harus .pdf. Maksimal 1 dokumen yang dapat diunggah.</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group-row">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.container {
    background-color: #ffffff;
    padding: 30px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 30px;
    position: relative; 
    margin-bottom: 40px;
}

h1 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 30px;
    text-align: center;
    color: #333;
    margin-top: 60px;
}

h2 {
    font-size: 20px;
    font-weight: bold;
    color: #444;
    margin-bottom: 20px;
}

.form-group-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    margin-bottom: 20px;
}

.form-group-row label {
    width: 100%;
    max-width: 200px; 
    font-weight: bold;
    margin-bottom: 10px;
    color: #555;
}

.input-container {
    flex-grow: 1;
    width: calc(100% - 220px); 
}

.form-control {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #5E5DF0;
    box-shadow: 0 0 5px rgba(94, 93, 240, 0.25);
}

.helper-text {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 5px;
}

.form-control-plaintext {
    padding: 0;
    font-weight: bold;
    color: #333;
}

.btn-primary {
    background-color: #5E5DF0;
    border-color: #5E5DF0;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    display: block;
    margin-left: auto;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #4A4AC4; 
    border-color: #4A4AC4;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    transition: background-color 0.3s ease;
    position: absolute;
    top: -20px; 
    left: 0;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

.back-btn i {
    margin-right: 10px;
}

@media (max-width: 768px) {
    .form-group-row {
        flex-direction: column;
        align-items: flex-start;
    }

    .form-group-row label,
    .input-container {
        width: 100%;
    }

    .btn-secondary {
        top: 10px;
        left: 10px;
        width: auto; 
    }
}
</style>
@endsection
