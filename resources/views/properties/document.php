@extends('master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Verifikasi Dokumen Properti</h1>
            <h2>Verifikasi dokumen Anda!</h2>
            <form action="{{ route('document.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Property Details -->
                <div class="form-group-row">
                    <label for="certificate">Jenis Sertifikat</label>
                    <div class="input-container">
                        <input type="text" class="form-control" id="certificate" name="certificate" value="{{ old('certificate', $document->type ?? '') }}">
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="documentName">Nama Dokumen</label>
                    <div class="input-container">
                        <input type="text" class="form-control" id="documentName" name="documentName" value="{{ old('documentName', $document->name ?? '') }}">
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="documentStatus">Status Sertifikat</label>
                    <div class="input-container">
                        <p class="form-control-plaintext" id="documentStatus">{{ $document->status ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="form-group-row">
                    <label for="document">Upload Dokumen PDF (Maksimal 1 Dokumen)</label>
                    <div class="input-container">
                        <input type="file" class="form-control" id="document" name="document" accept=".pdf">
                        <p class="helper-text">Format dokumen harus .pdf. Maksimal 1 dokumen yang dapat diunggah.</p>
                    </div>
                </div>

                <div class="form-group-row">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group-row {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .form-group-row label {
        width: 20%;
        margin-right: 1rem;
        align-self: flex-start;
    }

    .input-container {
        width: 80%;
    }

    .form-control {
        width: 100%;
    }

    .helper-text {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.5rem;
    }

    .btn-primary {
        margin-left: auto;
        display: block;
    }
</style>
@endsection
