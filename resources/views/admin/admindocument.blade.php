@extends('admin.adminproperty')

@section('content')
<div class="container">
    <h1>Pending Document</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                    <td>{{ $document->property->title }}</td>
                    <td>{{ $document->status }}</td>
                    <td>
                        <button class="btn btn-success approve-button" data-document-id="{{ $document->id }}">Setujui</button>
                        <button class="btn btn-danger delete-button" data-document-id="{{ $document->id }}">Hapus</button>
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
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
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
    body {
        font-family: Arial, sans-serif;
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

    .flex {
        display: flex;
    }

    .justify-center {
        justify-content: center;
    }

    .items-center {
        align-items: center;
    }

</style>