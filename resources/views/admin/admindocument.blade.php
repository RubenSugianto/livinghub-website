@extends('admin.adminproperty')

<!-- @section('navbar')
    @include('partials.navbaradmin')
@endsection -->

@section('content')

@if (session('success'))
    <div id="successAlert" class="alert alert-success fade show" role="alert">
        <i class="fa fa-check-circle alert-icon" aria-hidden="true"></i>
        <span class="alert-content">
            <strong>{{ session('success') }}</strong>
        </span>
        <button type="button" class="btn-close" aria-label="Close" onclick="this.parentElement.style.display='none';">✖</button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-triangle alert-icon" aria-hidden="true"></i>
        <strong>{{ session('error') }}</strong>
    <button type="button" class="btn-close close-btn" aria-label="Close" onclick="this.parentElement.style.display='none';">✖</button>
    </div>
@endif


<div class="container">
    <h1>Persetujuan Dokumen</h1>

    <!-- @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif -->

    <div class="search-bar">
        <div class="input-group">
            <input type="text" placeholder="Cari dokumen disini.." class="form-control">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            <button type="submit" data-toggle="modal" data-target="#filterModal"><i class="fa fa-filter" aria-hidden="true"></i></button>
        </div>
    </div>

    <!-- Tabel Dokumen -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Dokumen</th>
                <th>Properti</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                <tr data-document-id="{{ $document->id }}">
                    <td>{{ $document->id }}</td>
                    <td>{{ $document->name }}</td>
                    <td>{{ $document->property->name }}</td>
                    <td>{{ $document->status }}</td>

                    <td>
                        <!-- Tombol View document -->
                        <form action="{{ route('document.edit', $document->id) }}" method="GET" class="btn" style="display:inline-block; margin: -35px;">
                            @csrf
                            <button type="submit" class="btn btn-info" target="_blank">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </form>

                        <!-- Tombol Approve -->
                        <form action="{{ route('document.approve', $document->id) }}" method="POST" class="btn" style="display:inline-block; margin: 6px;">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </button>
                        </form>

                        <!-- Tombol Reject -->
                        <form action="{{ route('document.decline', $document->id) }}" method="POST" class="delete-form" style="display:inline-block; margin: -26px;">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4 page">
        <!-- Previous Page Button -->
        <button class="page__btn {{ $documents->currentPage() == 1 ? '' : 'active' }}" onclick="window.location='{{ $documents->previousPageUrl() }}'">&lt;</button>

        <!-- Pagination Elements -->
        @for ($i = 1; $i <= $documents->lastPage(); $i++)
            <button class="page__numbers {{ $documents->currentPage() == $i ? 'active' : '' }}" onclick="window.location='{{ $documents->url($i) }}'">{{ $i }}</button>
        @endfor

        <!-- Next Page Button -->
        <button class="page__btn {{ $documents->currentPage() == $documents->lastPage() ? '' : 'active' }}" onclick="window.location='{{ $documents->nextPageUrl() }}'">&gt;</button>
    </div>
</div>

<!-- Modal untuk Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus dokumen ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Reject</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = $('#deleteModal');
    var confirmDeleteButton = document.getElementById('confirmDelete');
    var documentIdToDelete;
    var formToSubmit;

    document.querySelectorAll('.delete-button').forEach(function (button) {
        button.addEventListener('click', function () {
            documentIdToDelete = this.getAttribute('data-document-id');
            // Find the form associated with the delete button
            formToSubmit = document.querySelector('.delete-form[data-document-id="' + documentIdToDelete + '"]');
            deleteModal.modal('show');
        });
    });

    confirmDeleteButton.onclick = function () {
        if (formToSubmit) {
            formToSubmit.submit(); 
        }
        deleteModal.modal('hide');
    };
});
</script>
@endsection

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

        h1{
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            margin-top: 100px;
        }

        .container {
            position: relative;
        }
        
        .popup-button {
            background-color: #4CAF50; /* Hijau */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }

        .popup {
            display: none; /* Tersembunyi secara default */
            position: absolute;
            top: 40px; /* Posisi di bawah tombol */
            right: 0; /* Menyesuaikan dengan tombol */
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 1000;
        }

        .popup ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .popup li {
            padding: 10px 20px;
        }

        .popup li a {
            text-decoration: none;
            color: black;
            display: block;
        }

        .popup li:hover {
            background-color: #f1f1f1; /* Warna latar saat hover */
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .search-bar {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

           .input-group {
                display: flex;
                align-items: center;
                width: 100%;
                max-width: 700px;
                margin: 0 auto;
                border: 2px solid var(--border-color) !important;
                border-radius: var(--border-radius) !important;
                overflow: hidden;
                background-color: var(--background-color) !important;
                padding: 5px !important;
                height: 50px; 
            }

            .input-group input[type="text"] {
                flex: 1;
                padding: 0 10px !important; 
                border: none !important;
                outline: none !important;
                font-size: 1rem;
                background-color: var(--background-color) !important;
                color: var(--text-color) !important;
                box-shadow: none !important;
                height: 100%; 
            }

            .input-group input[type="text"]:focus {
                background-color: var(--background-color) !important;
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
            }

            .input-group button {
                padding: 0 10px !important; 
                background: none !important;
                color: black !important;
                border: none !important;
                cursor: pointer;
                transition: color var(--transition-speed) ease !important;
                box-shadow: none !important;
                height: 100%; 
            }

            .input-group button i {
                font-size: 1rem;
            }

            .input-group button:focus,
            .input-group button:active {
                background-color: transparent !important;
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
            }

            .input-group button:hover {
                color: #4A4AC4 !important;
                background-color: transparent !important;
            }
        
            .close {
                font-size: 24px;
                color: #333;
                opacity: 0.7;
                transition: color 0.3s, opacity 0.3s;
            }

            .close:hover,
            .close:focus {
                color: #4A4AC4;
                opacity: 1;
            }

            .modal-body input[type="text"],
            .modal-body input[type="number"],
            .modal-body input[type="range"],
            .modal-body select,
            .modal-body textarea {
                font-size: 14px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 100%;
                box-sizing: border-box;
                margin-bottom: 15px;
                
            }

            .modal-title {
                font-size: 14px;
                font-weight: bold;
                color: #333;
            }

            .modal-header, .modal-body, .modal-dialog, label, .btn-group-toggle .btn {
                font-size: 14px;
            }

            label {
                font-weight: bold;
                display: block;
                margin-bottom: 3px;
            }

            .modal-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 14px;
            }

            .modal-footer .btn {
                font-size: 14px;
                padding: 8px 15px;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .modal-body {
                display: flex;
                flex-wrap: wrap;
                gap: 8px 0px;
                justify-content: flex-start;
                text-align: left;
            }

            .modal-body .form-group {
                flex: 1 1 30%;
            }

            .input-range {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .btn-group-toggle .btn {
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-right: 10px;
                background-color: white;
                color: black;
            }

            .btn-group-toggle .btn:hover,
            .btn-group-toggle .btn:active,
            .btn-group-toggle .btn:focus {
                color: white;
                background-color:#4A4AC4;
                text-decoration: none;
            }

            .btn-group-toggle .btn input[type="radio"] {
                background-color: #5E5DF0;
                color: white;
                font-weight: normal;
            }

            .modal-body .btn-group-toggle .btn.active {
                background-color: #5E5DF0;
                color: white;
                font-weight: normal;
            }

            .modal-dialog.modal-lg {
                max-width: 40%;
            }

            .btn-reset {
                background-color: #FF5C5C;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                font-size: 14px;
                transition: background-color 0.3s;
            }

            .btn-reset:hover {
                background-color: #E04040;
            }

            .btn-search {
                background-color: #5E5DF0;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                font-size: 16px;
                transition: background-color 0.3s;
            }

            .btn-search:hover {
                background-color: #4A4AC4;
            }

            .table {
                width: 100%;
                margin-top: 20px;
            }

            .table thead th {
                background-color: #7473f0;
                color: white;
                text-align: center;
            }

            .table tbody tr:nth-of-type(odd) {
                background-color: var(--greyLight);
            }

            .table tbody tr:hover {
                background-color: #f1f1f1;
            }

            .table img {
                max-width: 100px;
                border-radius: 4px;
            }

            .table th, .table td {
                vertical-align: middle;
                text-align: center;
                padding: 10px;
            }


</style>