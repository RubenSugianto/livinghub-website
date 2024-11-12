@extends('admin.adminproperty')

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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Detail Properti</th>
                    <th>Nama Properti</th>
                    <th>Nama Dokumen</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr data-document-id="{{ $document->id }}">
                        <td>
                            <!-- Tombol View Property -->
                            <form action="{{ route('property.show', $document->property->id) }}" method="GET" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                        <td>{{ $document->property->name }}</td>
                        <td>{{ $document->name }}</td>
                        <td>{{ $document->status }}</td>
                        <td>
                            <!-- Tombol View Document -->
                            <form action="{{ route('document.edit', $document->id) }}" method="GET" style="display:inline-block;  margin: 10px;">
                                @csrf
                                <button type="submit" class="btn btn-info" target="_blank">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </form>

                            <!-- Tombol Approve -->
                            <form action="{{ route('document.approve', $document->id) }}" method="POST" style="display:inline-block; margin: -20px;">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </button>
                            </form>

                            <!-- Tombol Reject -->
                            <form action="{{ route('document.decline', $document->id) }}" method="POST" style="display:inline-block; margin: 10px;">
                                @csrf
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

        .alert {
            padding: 15px;
            margin: 10px auto;
            border-radius: 10px;
            width: calc(100% - 40px);
            position: relative;
            top: -10px; 
            display: flex;
            align-items: center;
            margin-top:100px;
        }

        .alert-success {
            background-color: #d4edda; 
            border: 1px solid #c3e6cb; 
            color: #155724; 
        }

        .alert .btn-close {
            background: transparent;
            border: none;
            font-size: 1.5rem; 
            color: #155724; 
            cursor: pointer;
            margin-left: auto;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            right: 15px; 
            top: 50%;
            transform: translateY(-50%); 
        }

        .alert .btn-close:hover {
            color: #0d3c1e; 
        }

        .alert .btn-close:active {
            transform: translateY(-50%) scale(1.1); 
        }

        .alert .alert-icon {
            font-size: 2rem;
            margin-right: 15px;
            vertical-align: middle;
        }

        .alert.fade {
            opacity: 1;
            transform: translateY(0);
        }

        .alert.fade.hide {
            opacity: 0;
            transform: translateY(-15px);
        }


        h1{
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            margin-top: 100px;
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
                background-color: var(--greyLight) !important; 
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

            .page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 3rem;
            margin: 1rem auto;
            border-radius: 0.4rem;
            background: #ffffff;
            box-shadow: 0 0.4rem 1rem rgba(90, 97, 129, 0.05);
            width: fit-content;
            }

            .page__numbers,
            .page__btn,
            .page__dots {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0.4rem;
            font-size: 1.2rem;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
            }

            .page__dots {
            width: 2rem;
            height: 2rem;
            color: var(--greyLight);
            cursor: initial;
            }

            .page__numbers {
            width: 2rem;
            height: 2rem;
            border-radius: 0.2rem;
            color: var(--greyDark);

            &:hover {
                color: #ffffff !important;
                background: #5E5DF0 !important;
            }

            &.active {
                color: #ffffff !important;
                background: #5E5DF0 !important;
                font-weight: 600 !important;
                border: 1px solid var(--primary) !important;
            }
            }

            .page__btn {
            color: var(--btnColor);
            pointer-events: none;

            &.active {
                color: var(--btnColor);
                pointer-events: initial;

                &:hover {
                color: var(--primary) !important;
                }
            }
        }


</style>