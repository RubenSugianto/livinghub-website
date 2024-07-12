@extends('master')

@section('title', 'Search Results')

@section('content')
<div class="container mt-4">
 <!-- Search and filter buttons -->
<div class="search-bar mb-5">
    <form action="{{ route('search') }}" method="GET" class="input-group">
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


    <h1>Hasil Pencarian</h1>
    <div class="row justify-content-center flex-column">
        @if($properties->isEmpty())
            <p>Property tidak ditemukan.</p>
        @else
            <p>Terdapat {{ $properties->total() }} properti yang ditemukan</p>
            @foreach($properties as $property)
                <div class="col-md-10 mb-3">
                    <a href="{{ route('property.show', $property->id) }}" class="text-decoration-none text-dark">
                        <div class="card property-card" data-property-id="{{ $property->id }}">
                            <div class="card-image position-relative">
                                <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg" class="card-img-top" alt="{{ $property->name }}">
                            </div>
                            <div class="card-body">
                                <div class="price mb-2">
                                    <span class="font-weight-bold" style="font-size: 1.4em;">Rp {{ number_format($property->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 style="font-size: 20px;">{{ $property->name }}</h5>
                                </div>
                                <p class="card-text">{{ $property->location }}</p>
                                <div class="d-flex justify-content-start">
                                <span class="badge bg-secondary">{{ $property->status }}</span>
                                <span class="badge bg-secondary">{{ $property->type }}</span>

                                </div>
                                <div class="property-details mt-2 d-flex flex-wrap align-items-center">
                                    <p class="mr-3"><i class="fa fa-bed" aria-hidden="true"></i> <span class="spacer">{{ $property->bedroom }}</span></p>
                                    <p class="mr-3"><i class="fa fa-bath" aria-hidden="true"></i> <span class="spacer">{{ $property->bathroom }}</span></p>
                                    <p class="mr-3"><i class="fa fa-bolt" aria-hidden="true"></i> <span class="spacer">{{ $property->electricity }} watt</span></p>
                                    <p class="mr-3"><strong>LT:</strong> <span class="spacer">{{ $property->surfaceArea }} m²</span></p>
                                    <p class="mr-3"><strong>LB:</strong> <span class="spacer">{{ $property->buildingArea }} m²</span></p>
                                </div>
                                <div class="property-description mt-3">
                                    {!! $property->description !!}
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14H7v-2h5v2zm0-4H7v-2h5v2zm5 4h-3v-2h3v2zm0-4h-3v-2h3v2z"/>
                                    </svg>
                                    @if ($property->published_at)
                                        <span class="ml-2">{{ \Carbon\Carbon::parse($property->updated_at)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="https://images.pexels.com/photos/1239291/pexels-photo-1239291.jpeg" class="rounded-circle" alt="User" width="30" height="30">
                                    <span class="ml-2">{{ $property->user->username }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

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
    const propertyCards = document.querySelectorAll('.property-card');

    propertyCards.forEach(card => {
        card.addEventListener('click', function() {
            const propertyId = card.getAttribute('data-property-id');
            window.location.href = `/properties/${propertyId}`;
        });
    });
});

function resetFilters() {
    document.getElementById('filterForm').reset();
    document.querySelectorAll('.btn-group-toggle .btn').forEach(btn => btn.classList.remove('active'));
}
</script>
@endsection

@section('styles')
<style>
:root {
  --primary: #23adad;
  --greyLight: #23adade1;
  --greyLight-2: #cbe0dd;
  --greyDark: #2d4848;
  --btnColor: #5E5DF0;
}

html {
  box-sizing: border-box;
  font-size: 70%; 
  overflow-y: scroll;
  font-family: "Poppins", sans-serif;
  letter-spacing: 0.6px;
  line-height: 1.4;
  -webkit-user-select: none;
  backface-visibility: hidden;
  -webkit-font-smoothing: subpixel-antialiased;
}

.page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 5rem;
  margin: 3rem auto;
  border-radius: 0.6rem;
  background: #ffffff;
  box-shadow: 0 0.8rem 2rem rgba(90, 97, 129, 0.05);
  width: fit-content;
}

.page__numbers,
.page__btn,
.page__dots {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0.8rem;
  font-size: 1.6rem; 
  cursor: pointer;
  border: none;
  background: none;
  padding: 0;
}

.page__dots {
  width: 3rem; 
  height: 3rem; 
  color: var(--greyLight);
  cursor: initial;
}

.page__numbers {
  width: 3rem; 
  height: 3rem; 
  border-radius: 0.4rem;
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

.property-card {
  border: 1px solid #ccc;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: transform 0.2s;
  max-width: 100%;
  width: 100%;
  margin: 15px auto;
}

.property-card:hover {
  transform: scale(1.02);
}

.badge {
    font-size: 1em; 
    padding: 0.5em 1em; 
    margin-right: 10px;
}

.card-image img {
  width: 100%;
  height: 300px;
  object-fit: cover;
}

.price {
  font-size: 1.6em; 
  font-weight: bold;
}

.card-body {
  padding: 15px;
}

.card-title h5 {
  font-size: 22px; 
  font-weight: bold;
}

.card-title svg {
  margin-left: 10px;
  cursor: pointer;
}

.card-text {
  font-size: 16px; 
  color: #555;
}

.card-footer {
  padding: 15px;
  background: #f8f9fa;
}

.card-meta {
  font-size: 16px; 
  color: #777;
}

.card-meta svg {
  margin-right: 5px;
  vertical-align: middle;
}

.card-meta img {
  width: 35px; 
  height: 35px; 
  border-radius: 50%;
  margin-right: 10px;
}

.spacer {
  margin-left: 5px;
}

.property-details p {
  margin-right: 10px;
  font-size: 16px; 
}

.property-details svg {
  margin-right: 5px;
}

.property-details strong {
  font-weight: bold;
}

.property-description {
  font-size: 16px; 
  color: #555;
  margin-top: 10px;
  max-height: 100px;
  overflow: hidden;
  text-overflow: ellipsis;
}

.page__numbers.active a {
  color: #ffffff !important;
  background: var(--primary) !important;
  font-weight: 600 !important;
  border: 1px solid var(--primary) !important;
}


.search-bar .input-group {
display: flex;
justify-content: flex-start;
align-items: center;
width: 50%; 
margin: 0;
border: 2px solid #ccc;
border-radius: 5px;
overflow: hidden;
}

.search-bar input[type="text"] {
flex: 1;
padding: 13px;
border: none;
outline: none;
min-width: 0; 
}

.search-bar button {
padding: 10px;
background: none;
color: black;
border: none;
cursor: pointer;
min-width: 50px; 
display: flex;
align-items: center;
justify-content: center;
}

.search-bar button:hover {
color: #4A4AC4;
}

.search-bar button.filter-button:hover {
color: #4A4AC4;
}


.btn-group-toggle .btn {
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-right: 10px;
  color: black; 
  background-color: white; 
  font-size: 16px; 
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
  gap: 50px;
}

.modal-body .form-group {
  flex: 1 1 30%;
}

.modal-body .form-group-full {
  flex: 1 1 100%;
}

.input-range {
  display: flex;
  align-items: center;
  gap: 10px;
}

.btn-group-toggle .btn input[type="radio"] {
  display: none;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
  font-size: 16px;
}

.modal-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-body .btn-group-toggle .btn {
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-right: 10px;
  color: black; 
  background-color: white; 
  font-size: 16px; 
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
  max-width: 40%; 
}

</style>
@endsection
