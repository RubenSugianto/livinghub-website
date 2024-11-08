@extends('master')

@section('navbar')
    @include('partials.navbaruser')
@endsection

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
                        <select class="form-control @error('documentType') is-invalid @enderror" id="documentType" name="documentType" required>
                            <option value="" disabled selected>Pilih jenis sertifikat</option>
                            <option value="SHM" {{ old('documentType', $document->type ?? '') == 'SHM' ? 'selected' : '' }}>SHM</option>
                            <option value="SHGB" {{ old('documentType', $document->type ?? '') == 'SHGB' ? 'selected' : '' }}>SHGB</option>
                            <option value="SHGU" {{ old('documentType', $document->type ?? '') == 'SHGU' ? 'selected' : '' }}>SHGU</option>
                            <option value="Hak Pakai" {{ old('documentType', $document->type ?? '') == 'Hak Pakai' ? 'selected' : '' }}>Hak Pakai</option>
                            <option value="Lainnya" {{ !in_array(old('documentType', $document->type ?? ''), ['SHM', 'SHGB', 'SHGU', 'Hak Pakai']) ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>

                        <span class="dropdown-icon position-absolute" style="right: 20px; top: 32%">
                         <i class="bi bi-caret-down-fill"></i>
                        </span>

                        <input type="text" class="form-control @error('customType') is-invalid @enderror" id="customType" name="customType"
                        placeholder="Isi tipe dokumen lainnya"
                        value="{{ old('customType', !in_array($document->type ?? '', ['SHM', 'SHGB', 'SHGU', 'Hak Pakai']) ? $document->type : '') }}"
                        style="{{ !in_array(old('documentType', $document->type ?? ''), ['SHM', 'SHGB', 'SHGU', 'Hak Pakai']) ? '' : 'display: none;' }}; margin-top: 10px;">
                    </div>
                        @error('documentType')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Document Name -->
                <div class="form-group-row">
                    <label for="documentName">Nama Dokumen</label>
                    <div class="input-container">
                        <input type="text" class="form-control @error('documentName') is-invalid @enderror" id="documentName" name="documentName" value="{{ old('documentName', $document->name ?? '') }}" required>
                    </div>
                    @error('documentName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Upload Document -->
                <div class="form-group-row">
                    <label for="document">Upload Dokumen PDF (Maksimal 1 Dokumen)</label>
                    <div class="input-container">
                        <input type="file" class="form-control @error('document') is-invalid @enderror" id="document" id="document" name="document" accept=".pdf" required>
                        <p class="helper-text">Hanya 1 dokumen dengan format pdf dan ukuran maksimal 5 MB yang dapat diunggah.</p>
                    </div>
                    @error('document')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="form-group-row">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const documentTypeSelect = document.getElementById('documentType');
        const customTypeInput = document.getElementById('customType');

        // Initially check if the "Lainnya" option is selected, and show the input field if it is
        if (documentTypeSelect.value === 'Lainnya') {
            customTypeInput.style.display = 'block';
        }

        // Event listener to toggle visibility of the custom input based on selection
        documentTypeSelect.addEventListener('change', function () {
            if (this.value === 'Lainnya') {
                customTypeInput.style.display = 'block';
            } else {
                customTypeInput.style.display = 'none';
                customTypeInput.value = '';  // Reset custom input if it's hidden
            }
        });
    });
</script>




<style>
    
.alert {
    margin-top: 100px;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.btn-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: inherit;
    cursor: pointer;
}

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
    padding: 10px 15px; 
    border-radius: 5px; 
    border: 1px solid #DDE3EC; 
    background: #f9f9f9; 
    transition: border-color 0.3s ease;
    min-height: 40px; 
    line-height: 1.2;
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
