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

        <!-- Property Pending Status Modal -->
        <div class="modal fade" id="propertyPendingModal" tabindex="-1" aria-labelledby="propertyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="propertyModalLabel">Property Pending Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        The status of this property is currently pending. Please review the property.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Pending Status Modal -->
        <div class="modal fade" id="documentPendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pendingModalLabel">Document Pending Status</h5>
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

        <!-- Modal for Image Preview -->
        <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="previewImage" src="" alt="Preview" style="max-width: 100%; max-height: 1000px;">
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
                <form action="{{ route('search') }}" method="GET" id="filterForm">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="status" autocomplete="off" value="Dijual"> Dijual
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="status" autocomplete="off" value="Disewa"> Disewa
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bedrooms">Kamar Tidur</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bedrooms" autocomplete="off" value="1 Kamar"> 1 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bedrooms" autocomplete="off" value="2 Kamar"> 2 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bedrooms" autocomplete="off" value="3 Kamar"> 3 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bedrooms" autocomplete="off" value="3+ Kamar"> 3+ Kamar
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bathrooms">Kamar Mandi</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bathrooms" autocomplete="off" value="1 Kamar"> 1 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bathrooms" autocomplete="off" value="2 Kamar"> 2 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bathrooms" autocomplete="off" value="3 Kamar"> 3 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bathrooms" autocomplete="off" value="3+ Kamar"> 3+ Kamar
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="land_size">Luas Tanah</label>
                        <div class="input-range">
                            <input type="number" name="land_size_min" placeholder="0" class="form-control">
                            <span>m² -</span>
                            <input type="number" name="land_size_max" placeholder="0" class="form-control">
                            <span>m²</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="building_size">Luas Bangunan</label>
                        <div class="input-range">
                            <input type="number" name="building_size_min" placeholder="0" class="form-control">
                            <span>m² -</span>
                            <input type="number" name="building_size_max" placeholder="0" class="form-control">
                            <span>m²</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="certificate">Sertifikat</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="certificate" autocomplete="off" value="SHM"> SHM
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="certificate" autocomplete="off" value="SHGB"> SHGB
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="certificate" autocomplete="off" value="SHGU"> SHGU
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="certificate" autocomplete="off" value="Hak Pakai"> Hak Pakai
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="certificate" autocomplete="off" value="Lainnya"> Lainnya
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="property_type">Tipe Properti</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="property_type" autocomplete="off" value="Rumah"> Rumah
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="property_type" autocomplete="off" value="Apartemen"> Apartemen
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="property_type" autocomplete="off" value="Ruko"> Ruko
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="property_type" autocomplete="off" value="Tanah"> Tanah
                            </label>
                        </div>
                    </div>
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
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr data-property-id="{{ $property->id }}">
                                <td>
                                    <img src="{{ asset($property->images->first()->images) }}" alt="{{ $property->name }}" width="100" class="clickable-image">
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
                                <td>{{ $property->check }}</td>
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
                                    
                                    @if ($property->document->status === 'Pending' && $property->check != 'Pending')
                                        <!-- Pending Status of Document -->
                                        <a href="javascript:void(0);" class="btn btn-warning"
                                        data-bs-toggle="modal" data-bs-target="#documentPendingModal">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                        </a>
                                    @elseif ($property->check === 'Pending')
                                        <!-- Pending Status of Property -->
                                        <a href="javascript:void(0);" class="btn btn-warning"
                                        data-bs-toggle="modal" data-bs-target="#propertyPendingModal">
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
    --primary: #23adad;
    --greyLight: #23adade1;
    --greyLight-2: #cbe0dd;
    --background-color: #f5f5f5;
    --text-color: #333;
    --border-color: #ccc;
    --border-radius: 25px;
    --transition-speed: 0.3s;
    --hover-color: #4A4AC4;
}

.alert {
    font-size: 1.25rem;
    padding: 17px;
    margin-top: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    transition: opacity 0.5s ease, transform 0.5s ease;
    position: relative;
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
    color: #000;
    transition: transform var(--transition-speed) ease, color var(--transition-speed) ease;
}

.alert .close-btn:hover {
    color: #555;
}

.alert .close-btn:active {
    transform: scale(1.2);
}

.alert.fade {
    opacity: 1;
    transform: translateY(0);
}

.alert.fade.hide {
    opacity: 0;
    transform: translateY(-20px);
}

body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

.search-bar {
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 50px;
}

.search-bar .input-group {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    background-color: var(--background-color);
    padding: 5px;
}

.search-bar input[type="text"] {
    flex: 1;
    padding: 10px;
    border: none;
    outline: none;
    font-size: 1rem; 
    background-color: var(--background-color);
    color: var(--text-color);
}

.search-bar button,
.search-bar .filter-button {
    padding: 10px;
    background: none;
    color: black;
    border: none;
    cursor: pointer;
    transition: color var(--transition-speed) ease;
}

.search-bar button:hover,
.search-bar .filter-button:hover {
    color: var(--hover-color);
}

.search-bar button i,
.search-bar .filter-button i {
    font-size: 1rem; 
}

.btn-group-toggle .btn {
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-right: 6px;
  color: black;
  background-color: white;
  font-size: 12px;
}

.btn-group-toggle .btn.active {
  background-color: #4A4AC4;
  color: white;
}

.btn-group-toggle .btn:hover {
  background-color: #4A4AC4;
  color: white;
}

.modal-body {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
}

.modal-body .form-group {
  flex: 1 1 25%;
}

.modal-body .form-group-full {
  flex: 1 1 100%;
}

.input-range {
  display: flex;
  align-items: center;
  gap: 6px;
}

.btn-group-toggle .btn input[type="radio"] {
  display: none;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 3px;
  font-size: 12px;
}

.modal-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-body .btn-group-toggle .btn {
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-right: 6px;
  color: black;
  background-color: white;
  font-size: 12px;
}

.modal-body .btn-group-toggle .btn.active {
  background-color: #5E5DF0;
  color: white;
}

.modal-body .btn-group-toggle .btn:hover {
  background-color: #4A4AC4;
  color: white;
}

.modal-dialog.modal-lg {
  max-width: 50%;
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
@endsection
