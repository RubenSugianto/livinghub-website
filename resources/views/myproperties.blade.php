@extends('master')

@section('title', 'My Property')

@section('content')
    @if (session('success'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container mt-4 text-center">
        <!-- Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this property? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Status Modal -->
        <div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pendingModalLabel">Pending Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        The status of this document is currently pending. Please review the document.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>





        <h1 class="mb-4">{{ $title }}</h1> 

        <div class="search-bar mb-5">
            <form action="{{ route('myproperties.search') }}" method="GET" class="input-group justify-content-center">
                <input type="text" name="search" placeholder="Cari properti disini..">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                <button type="button" class="filter-button" data-toggle="modal" data-target="#filterModal"><i class="fa fa-filter" aria-hidden="true"></i></button>
            </form>
        </div>

        <!-- Filter Modal Dialog Box -->
        <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('myproperties.search') }}" method="GET" id="filterForm">
                            <!-- Filter form fields -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="resetFilters()">Reset</button>
                        <button type="submit" form="filterForm" class="btn btn-primary" style="background-color: #5E5DF0; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#4A4AC4';" onmouseout="this.style.backgroundColor='#5E5DF0';">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center flex-column">
            @if($properties->isEmpty())
                <p>Property tidak ditemukan.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Properti</th>
                            <th>Harga</th>
                            <th>Lokasi</th>
                            <th>Detail</th>
                            <th>Terakhir Update</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr data-property-id="{{ $property->id }}">
                                <td>
                                    <img src="{{ asset($property->images->first()->images) }}" alt="{{ $property->name }}" width="100">
                                </td>
                                <td>{{ $property->name }}</td>
                                <td>Rp {{ number_format($property->price, 0, ',', '.') }}</td>
                                <td>{{ $property->location }}</td>
                                <td>
                                    <p><i class="fa fa-bed" aria-hidden="true"></i> {{ $property->bedroom }}</p>
                                    <p><i class="fa fa-bath" aria-hidden="true"></i> {{ $property->bathroom }}</p>
                                    <p><i class="fa fa-bolt" aria-hidden="true"></i> {{ $property->electricity }} watt</p>
                                    <p><strong>LT:</strong> {{ $property->surfaceArea }} m²</p>
                                    <p><strong>LB:</strong> {{ $property->buildingArea }} m²</p>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($property->updated_at)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('property.edit', $property->id) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <form action="{{ route('property.destroy', $property->id) }}" method="POST" class="delete-form" style="display:inline-block;" data-property-id="{{ $property->id }}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger delete-button" data-property-id="{{ $property->id }}">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    @if ($property->document->status === 'Pending')
                                        <!-- Button for pending status with modal trigger, always using btn-warning -->
                                        <a href="javascript:void(0);" class="btn btn-warning"
                                        data-bs-toggle="modal" data-bs-target="#pendingModal">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                        </a>
                                    @else
                                        <!-- Button for non-pending status that navigates to document edit page, always using btn-secondary -->
                                        <a href="{{ route('document.edit', $property->id) }}" class="btn btn-secondary">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination buttons -->
                <div class="d-flex justify-content-center mt-4 page">
                    <!-- Previous Page Button -->
                    <button class="page__btn {{ $properties->currentPage() == 1 ? '' : 'active' }}" onclick="window.location='{{ $properties->previousPageUrl() }}'">&lt;</button>

                    <!-- Pagination Elements -->
                    @if ($properties->lastPage() > 1)
                        @if ($properties->currentPage() > 3)
                            <button class="page__numbers" onclick="window.location='{{ $properties->url(1) }}'">1</button>
                            @if($properties->currentPage() > 4)
                                <div class="page__dots">...</div>
                            @endif
                        @endif

                        @for ($i = max($properties->currentPage() - 2, 1); $i <= min($properties->currentPage() + 2, $properties->lastPage()); $i++)
                            <button class="page__numbers {{ $properties->currentPage() == $i ? 'active' : '' }}" onclick="window.location='{{ $properties->url($i) }}'">{{ $i }}</button>
                        @endfor

                        @if ($properties->currentPage() < $properties->lastPage() - 2)
                            @if($properties->currentPage() < $properties->lastPage() - 3)
                                <div class="page__dots">...</div>
                            @endif
                            <button class="page__numbers" onclick="window.location='{{ $properties->url($properties->lastPage()) }}'">{{ $properties->lastPage() }}</button>
                        @endif
                    @endif

                    <!-- Next Page Button -->
                    <button class="page__btn {{ $properties->currentPage() == $properties->lastPage() ? '' : 'active' }}" onclick="window.location='{{ $properties->nextPageUrl() }}'">&gt;</button>
                </div>
            @endif
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

    // Add event listeners to all delete buttons
    document.querySelectorAll('.delete-button').forEach(function (button) {
        button.addEventListener('click', function () {
            propertyIdToDelete = this.getAttribute('data-property-id');
            // Find the form associated with the delete button
            formToSubmit = document.querySelector('.delete-form[data-property-id="' + propertyIdToDelete + '"]');
            deleteModal.modal('show');
        });
    });

    // Handle the confirm delete button
    confirmDeleteButton.onclick = function () {
        if (formToSubmit) {
            formToSubmit.submit(); // Submit the form
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
                successAlert.remove(); // Remove alert element after transition
            }, 500); // Match with CSS transition duration
        }
    }

    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.classList.add('hide');
            setTimeout(() => {
                successAlert.remove(); // Remove alert element after transition
            }, 500); // Match with CSS transition duration
        }, 3000); // Hide alert after 3 seconds
    }

    var pendingModal = new bootstrap.Modal(document.getElementById('pendingModal'));

    // Show the modal on click of status button if status is 'Pending'
    document.querySelectorAll('[data-status="pending"]').forEach(function (button) {
        button.addEventListener('click', function () {
            pendingModal.show();
        });
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
    --primary: #23adad;
    --greyLight: #23adade1;
    --greyLight-2: #cbe0dd;
}

.alert {
    font-size: 1.25rem; /* Increase font size */
    padding: 17px; /* Increase padding */
    margin-top: 20px;
    margin-bottom: 20px; /* Add margin */
    border-radius: 5px; /* Rounded corners */
    transition: opacity 0.5s ease, transform 0.5s ease; /* Smooth transition */
    position: relative; /* For positioning the close button */
}

.alert .close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent;
    outline: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #000; /* Change to match your design */
    transition: transform 0.3s ease, color 0.3s ease; /* Smooth transition for scale and color */
}

.alert .close-btn:hover {
    color: #555; /* Change color on hover */
}

.alert .close-btn:active {
    transform: scale(1.2); /* Scale up slightly when clicked */
}

.alert.fade {
    opacity: 1;
    transform: translateY(0);
}

.alert.fade.hide {
    opacity: 0;
    transform: translateY(-20px); /* Slide up effect */
}


body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

.search-bar {
    display: flex;
    justify-content: center;
}

.search-bar input[type="text"] {
    width: 300px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px 0 0 4px;
}

.search-bar button {
    padding: 10px;
    background-color: #5E5DF0;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.search-bar button[type="submit"] {
    border-radius: 0 4px 4px 0;
}

.search-bar button:hover {
    background-color: #4A4AC4;
}

.filter-button {
    background-color: #5E5DF0;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 10px;
    transition: background-color 0.3s;
}

.filter-button:hover {
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

.page__btn, .page__numbers {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 5px 10px;
    margin: 0 2px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.page__btn.active, .page__numbers.active {
    background-color: #5E5DF0;
    color: white;
}

.page__dots {
    padding: 5px 10px;
}

.page {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}
</style>
@endsection
