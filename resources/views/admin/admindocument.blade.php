@extends('master')

<!-- @section('navbar')
    @include('partials.navbaradmin')
@endsection -->

@section('title', 'My Property')
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
<div class="container mt-4 text-center">
    <h1>Persetujuan Dokumen</h1>
    <div class="row justify-content-center flex-column" style="position: relative">
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
                            <!-- Tombol Downlaod Document -->
                            <form action="{{ route('document.download', urlencode($document->file)) }}" method="GET" style="display:inline-block; margin: 35px;">
                                @csrf
                                <button type="submit" class="btn btn-info" style="background-color:grey ;color: white; border: 1px solid #ccc;" target="_blank">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                </button>
                            </form>

                            <!-- Tombol Approve -->
                            <form action="{{ route('document.approve', $document->id) }}" method="POST" style="display:inline-block; margin: -30px;">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </button>
                            </form>

                            <!-- Tombol Reject -->
                            <form action="{{ route('document.decline', $document->id) }}" method="POST" style="display:inline-block; margin: 35px;">
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
    </div>

    <!-- Pagination buttons -->
    <div class="d-flex justify-content-center mt-4 page">
        <!-- Previous Page Button -->
        <button class="page__btn {{ $pendingProperties->currentPage() == 1 ? '' : 'active' }}" onclick="window.location='{{ $pendingProperties->previousPageUrl() }}'">&lt;</button>

        <!-- Pagination Elements -->
        @if ($pendingProperties->lastPage() > 1)
            @if ($pendingProperties->currentPage() > 3)
                <button class="page__numbers" onclick="window.location='{{ $pendingProperties->url(1) }}'">1</button>
                @if ($pendingProperties->currentPage() > 4)
                    <div class="page__dots">...</div>
                @endif
            @endif

            @for ($i = max($pendingProperties->currentPage() - 2, 1); $i <= min($pendingProperties->currentPage() + 2, $pendingProperties->lastPage()); $i++)
                <button class="page__numbers {{ $pendingProperties->currentPage() == $i ? 'active' : '' }}" onclick="window.location='{{ $pendingProperties->url($i) }}'">{{ $i }}</button>
            @endfor

            @if ($pendingProperties->currentPage() < $pendingProperties->lastPage() - 2)
                @if ($pendingProperties->currentPage() < $pendingProperties->lastPage() - 3)
                    <div class="page__dots">...</div>
                @endif
                <button class="page__numbers" onclick="window.location='{{ $pendingProperties->url($pendingProperties->lastPage()) }}'">{{ $pendingProperties->lastPage() }}</button>
            @endif
        @endif

        <!-- Next Page Button -->
        <button class="page__btn {{ $pendingProperties->currentPage() == $pendingProperties->lastPage() ? '' : 'active' }}" onclick="window.location='{{ $pendingProperties->nextPageUrl() }}'">&gt;</button>
    </div>
</div>
@endsection


@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const propertyRows = document.querySelectorAll('tr[data-property-id]');

    propertyRows.forEach(row => {
        row.addEventListener('click', function(event) {
            const target = event.target;
            if (!target.closest('.btn')) {
                const propertyId = row.getAttribute('data-property-id');
                window.location.href = `/property/${propertyId}`;
            }
        });
    });

    var deleteModal = $('#deleteModal');
    var confirmDeleteButton = document.getElementById('confirmDelete');
    var propertyIdToDelete;
    var formToSubmit;

    document.querySelectorAll('.delete-button').forEach(function (button) {
        button.addEventListener('click', function () {
            propertyIdToDelete = this.getAttribute('data-property-id');
            // Find the form associated with the delete button
            formToSubmit = document.querySelector('.delete-form[data-property-id="' + propertyIdToDelete + '"]');
            deleteModal.modal('show');
        });
    });

    confirmDeleteButton.onclick = function () {
        if (formToSubmit) {
            formToSubmit.submit(); 
        }
        deleteModal.modal('hide');
    };

    document.querySelectorAll('[data-dismiss="modal"]').forEach(function (button) {
        button.addEventListener('click', function () {
            deleteModal.modal('hide');
        });
    });

    function hideAlert() {
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            successAlert.classList.add('hide');
            setTimeout(() => {
                successAlert.remove(); 
            }, 500); 
        }
    }

    var documentPendingModal = new bootstrap.Modal(document.getElementById('documentPendingModal'));
    var propertyPendingModal = new bootstrap.Modal(document.getElementById('propertyPendingModal'));

    document.querySelectorAll('[data-status="pending"]').forEach(function (button) {
        button.addEventListener('click', function () {
            documentPendingModal.show();
            propertyPendingModal.show();
        });
    });

    const imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
    const previewImage = document.getElementById('previewImage');
    
    document.querySelectorAll('.clickable-image').forEach(function (image) {
        image.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent row click event
            const imageSrc = this.getAttribute('src');
            previewImage.src = imageSrc;
            imagePreviewModal.show();
        });
    });

    // Add this new code for handling the close button
    document.querySelector('#imagePreviewModal .btn-close').addEventListener('click', function () {
        imagePreviewModal.hide();
    });

});

function resetFilters() {
    document.querySelectorAll('#filterForm input, #filterForm select').forEach(input => {
        input.value = '';
    });
}


</script>
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

        h1{
            font-size: 25px;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            margin-top: 100px;
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
        font-size: 14px;
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
@endsection
