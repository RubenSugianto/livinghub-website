@extends('master')

@section('title', 'My Favorites')

@section('content')

    <div class="container mt-4">
        <h1 class="mb-4">Properti Favorit</h1>
       
<!-- Search and Filter Buttons -->
<div class="search-bar mb-5">
    <form action="{{ route('favorites') }}" method="GET" class="input-group">
        <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Cari Properti..." class="form-control">
        <div class="input-group-append">
            <button type="submit" class="btn btn-outline-secondary">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary filter-button" data-toggle="modal" data-target="#filterModal">
                <i class="fa fa-filter" aria-hidden="true"></i>
            </button>
        </div>
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
                <form action="{{ route('favorites') }}" method="GET" id="filterForm">
                    <!-- Status Filter -->
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

    @if($favorites->isEmpty())
    <div class="col-12 text-center">
            <p class="text-muted">Anda belum memiliki properti favorit</p>
    </div>
    @endif

    <div id="comparisonContainer">
        <button id="compareButton" class="btn btn-primary mb-3 d-flex align-items-center" disabled>
            Bandingkan Properti
            <i class="fa fa-star ml-2" aria-hidden="true"></i>
        </button>
    </div>

    @foreach($favorites as $property)
        <div class="col-md-10 mb-3 position-relative"> 
            <div class="property-select d-flex align-items-center">
                <div class="card property-card d-flex align-items-center">
                    <a href="{{ route('property.show', $property->id) }}" class="text-decoration-none text-dark d-flex align-items-center">
                        <div class="card-image">
                            @if($property->images->isNotEmpty())
                                <img src="{{ asset($property->images->first()->images) }}" class="card-img-top" alt="{{ $property->name }}">
                            @else
                                <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Default Image">
                            @endif
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $property->type }}</p>
                            <h5 class="card-title">{{ $property->name }}</h5>
                            <p class="property-location">
                                <i class="fa fa-map-marker"></i> {{ $property->location }}
                            </p>
                            <p class="card-text">{{ $property->certificate }}</p>
                            <p class="price mb-0">Rp {{ number_format($property->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                
                        <!-- Star Checkbox -->
                        <input type="checkbox" id="star-checkbox-{{ $property->id }}" class="compare-checkbox star-checkbox" data-property-id="{{ $property->id }}">
                        <label for="star-checkbox-{{ $property->id }}"></label>
                    </form>
                </div>
                <!-- Delete Button -->
                    <button type="button" class="btn btn-link delete-button" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $property->id }}').submit();">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>

                            <form id="delete-form-{{ $property->id }}" action="{{ route('favorites.destroy', $property->id) }}" method="POST" class="delete-form d-none">
                                @csrf
                                @method('DELETE')
                            </form>

                        </div>
                    </div>
                @endforeach


            <!-- Pagination buttons -->
            <div class="d-flex justify-content-center mt-4 page">
                <!-- Previous Page Button -->
                <button class="page__btn {{ $favorites->currentPage() == 1 ? '' : 'active' }}" onclick="window.location='{{ $favorites->previousPageUrl() }}'">&lt;</button>

                <!-- Pagination Elements -->
                @if ($favorites->lastPage() > 1)
                    @if ($favorites->currentPage() > 3)
                        <button class="page__numbers" onclick="window.location='{{ $favorites->url(1) }}'">1</button>
                        @if($favorites->currentPage() > 4)
                            <div class="page__dots">...</div>
                        @endif
                    @endif

                    @for ($i = max($favorites->currentPage() - 2, 1); $i <= min($favorites->currentPage() + 2, $favorites->lastPage()); $i++)
                        <button class="page__numbers {{ $favorites->currentPage() == $i ? 'active' : '' }}" onclick="window.location='{{ $favorites->url($i) }}'">{{ $i }}</button>
                    @endfor

                    @if ($favorites->currentPage() < $favorites->lastPage() - 2)
                        @if($favorites->currentPage() < $favorites->lastPage() - 3)
                            <div class="page__dots">...</div>
                        @endif
                        <button class="page__numbers" onclick="window.location='{{ $favorites->url($favorites->lastPage()) }}'">{{ $favorites->lastPage() }}</button>
                    @endif
                @endif

                <!-- Next Page Button -->
                <button class="page__btn {{ $favorites->currentPage() == $favorites->lastPage() ? '' : 'active' }}" onclick="window.location='{{ $favorites->nextPageUrl() }}'">&gt;</button>
            </div>
         </div>

        <!-- Comparison Table -->
        <div id="comparisonTableContainer" class="mt-4" style="display: none;">
            <div class="table-container"> <!-- Added container for background -->
            <h2>Comparison Table</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Property 1</th>
                            <th>Property 2</th>
                        </tr>
                    </thead>
                    <tbody id="comparisonTableBody">
                        <!-- Comparison data will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>


        @section('scripts')
        <script>
            
        function resetFilters() {
            document.getElementById('filterForm').reset();
            document.querySelectorAll('.btn-group-toggle .btn').forEach(btn => btn.classList.remove('active'));
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.compare-checkbox');
            const compareButton = document.getElementById('compareButton');
            const comparisonTableContainer = document.getElementById('comparisonTableContainer');
            const comparisonTableBody = document.getElementById('comparisonTableBody');
            let selectedProperties = [];

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const propertyId = this.getAttribute('data-property-id');
                    if (this.checked) {
                        if (selectedProperties.length < 2) {
                            selectedProperties.push(propertyId);
                        } else {
                            this.checked = false;
                            alert('You can only compare 2 properties at a time.');
                        }
                    } else {
                        selectedProperties = selectedProperties.filter(id => id !== propertyId);
                    }
                    compareButton.disabled = selectedProperties.length !== 2;
                });
            });

            compareButton.addEventListener('click', function() {
                fetch('/compare-properties', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ propertyIds: selectedProperties })
                })
                .then(response => response.json())
                .then(data => {
                    comparisonTableBody.innerHTML = `
                        <tr>
                    <td>Name</td>
                    <td>${data[0].name}</td>
                    <td>${data[1].name}</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>Rp ${data[0].price.toLocaleString()}</td>
                    <td>Rp ${data[1].price.toLocaleString()}</td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>${data[0].location}</td>
                    <td>${data[1].location}</td>
                </tr>
                <tr>
                    <td>Surface Area</td>
                    <td>${data[0].surfaceArea} m²</td>
                    <td>${data[1].surfaceArea} m²</td>
                </tr>
                <tr>
                    <td>Building Area</td>
                    <td>${data[0].buildingArea} m²</td>
                    <td>${data[1].buildingArea} m²</td>
                </tr>
                <tr>
                    <td>Bedrooms</td>
                    <td>${data[0].bedroom}</td>
                    <td>${data[1].bedroom}</td>
                </tr>
                <tr>
                    <td>Bathrooms</td>
                    <td>${data[0].bathroom}</td>
                    <td>${data[1].bathroom}</td>
                </tr>
                <tr>
                    <td>Electricity</td>
                    <td>${data[0].electricity} Watts</td>
                    <td>${data[1].electricity} Watts</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>${data[0].status}</td>
                    <td>${data[1].status}</td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td>${data[0].type}</td>
                    <td>${data[1].type}</td>
                </tr>
                <tr>
                    <td>Document Type</td>
                    <td>${data[0].document ? data[0].document.type : '-'}</td>
                    <td>${data[1].document ? data[1].document.type : '-'}</td>
                </tr>
                <tr>
                    <td>Document Status</td>
                    <td>${data[0].document ? data[0].document.status : '-'}</td>
                    <td>${data[1].document ? data[1].document.status : '-'}</td>
                </tr>
                    `;
                    comparisonTableContainer.style.display = 'block';
                });
            });
        });
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

        .container {
            width: 1200px;
            margin: 0 auto;
            padding: 20px;
            justify-content: center;
            align-items: center;
        }

        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            margin-top: 80px;
        }


        .text-normal {
            font-size: 15px;
            color: #555;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            width: 1200px;
            height: 200px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .property-card {
            display: flex;
            flex-direction: row;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s ease;
        }

        .property-card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .custom-hr {
            border-top: 2px solid #9f9f9f;
            width: 120%;
            margin-left: -10%;
        }


        .card-img-top {
            width: 250px;
            height: 150px;
            object-fit: cover;
            border-right: 1px solid #e0e0e0;
            border-radius: 10px;
        }

        .property-card .card-body {
            padding-left: 20px;
            flex-grow: 1;
        }

        .property-location {
            font-size: 1rem;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .property-details {
            margin-top: 10px;
            font-size: 0.9rem;
            display: flex;
            gap: 15px;
        }

        .property-details p {
            margin: 0;
            color: #555;
        }

        .property-card .price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #e74c3c;
            margin-bottom: 8px;
            margin-right: 10px;
        }

        .property-footer::before {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: #e0e0e0;
            margin-bottom: 10px;
        }

        #compareButton {
            background-color: #5E5DF0;
            color: #fff;
            border-radius: 25px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            font-size: 0.9rem;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #compareButton i.fa-star {
            margin-left: 8px;
            font-size: 1.2rem;
            color: #FFD700;
        }

        #compareButton:disabled {
            background-color: #bdc3c7;
            cursor: not-allowed;
        }

        #compareButton:hover:not(:disabled) {
            background-color: #4A4AC4;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        .table {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            border-collapse: collapse;
            font-size: 16px;
        }
        .property-select {
            position: relative;
        }

        .star-checkbox {
            display: none;
        }

        .star-checkbox + label {
            cursor: pointer;
            font-size: 1.5rem;
            color: #ccc;
            margin-left: 10px;
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
        }

        .star-checkbox + label:before {
            font-family: FontAwesome;
            content: "\f006";
        }

        .star-checkbox:checked + label:before {
            content: "\f005";
            color: #FFD700;
        }

        .delete-button {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #dc3545;
            cursor: pointer;
            position: absolute;
            top: 90px;
            right: -80px;
            z-index: 10;
        }

        .delete-button:hover {
            color: #bb2d3b;
        }

        .delete-button:focus {
            outline: none;
            border: none;
            box-shadow: none;
        }

        .table-container {
            background-color: white; 
            padding: 20px; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        }

        .table thead th {
            background-color: #5E5DF0;
            color: white;
            text-align: center;
            padding: 15px 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table th, .table td {
            border: none;
            padding: 15px 20px;
            text-align: center;
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: #f2f2f9;
        }

        .table tbody tr:nth-of-type(even) {     
            background-color: #ffffff;
        }

        .table tbody tr:hover {
            background-color: #4A4AC4;
            transition: background-color 0.3s ease;
        }

        @media (max-width: 768px) {
            .property-card {
                flex-direction: column;
            }

            .property-details {
                flex-direction: column;
                gap: 30px;
            }

            #compareButton {
                width: 100%;
            }
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

        </style>
        @endsection
