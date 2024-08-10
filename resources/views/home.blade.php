@extends('master')

@section('title', 'Home')

@section('styles')
<style>
 /* Alert Styles */
.alert {
    font-size: 2rem; /* Increase font size */
    padding: 25px; /* Increase padding */
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

/* Carousel Styles */
.carousel-item img {
    max-height: 400px; 
    width: 100%;
    margin: auto; 
    object-fit: contain;  
}

.carousel-control-prev,
.carousel-control-next {
    width: 5%; 
    top: 50%; 
    transform: translateY(-50%);
    opacity: 0.8; 
    z-index: 1;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5); 
    border-radius: 50%; 
    padding: 12px; 
}

.carousel-control-prev-icon {
    margin-right: 5px; 
}

.carousel-control-next-icon {
    margin-left: 5px; 
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    opacity: 1; 
}

/* Search Bar Styles */
.search-bar .input-group {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 30%; 
    margin: 0 auto;
    border: 2px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
}

.search-bar input[type="text"] {
    flex: 1;
    padding: 10px;
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

/* Button Group Toggle Styles */
.btn-group-toggle .btn {
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
    color: black; 
    background-color: white; 
}

.btn-group-toggle .btn.active {
    background-color: #4A4AC4;
    color: white;
}

.btn-group-toggle .btn:hover {
    background-color: #4A4AC4;
    color: white;
}

.btn-group-toggle .btn input[type="radio"] {
    display: none;
}

/* Modal Styles */
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

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
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

/* General Styles */
body {
    line-height: 1.5;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #393232;
    margin: 0;
    padding-top: 10px; 
}

img {
    max-width: 100%;
    display: block;
}

.card-list {
    width: 90%;
    max-width: 400px;
}

.card {
    background-color: #FFF;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05), 0 20px 50px 0 rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    overflow: hidden;
    padding: 1.25rem;
    position: relative;
    transition: 0.15s ease-in;
    margin: 10px;
}

.card:hover, .card:focus-within {
    box-shadow: 0 0 0 2px #5E5DF0, 0 10px 60px 0 rgba(0, 0, 0, 0.1);
    transform: translateY(-5px);
}

.card-image {
    position: relative;
    border-radius: 10px;
    height: 200px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.price-badge {
    position: absolute;
    bottom: 10px;
    left: 10px;
    color: #fff;
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    font-weight: bold;
    z-index: 2;
}

.card-footer {
    margin-top: 1.25rem;
    border-top: 1px solid #ddd;
    padding-top: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

.like-count-icon {
    margin-right: 10px; 
}

.like-button {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    z-index: 2; 
}

.like-button .btn {
    border-radius: 50%;
    padding: 10px;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    border: none; 
}

.like-button .btn-outline-danger {
    color: #dc3545;
    background: #fff;
}

.like-button .btn-outline-danger:hover {
    background: #dc3545;
    color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
}

.like-button .btn-outline-danger i {
    font-weight: bold; 
    color: var(--greyDark);
}

.like-button .btn-danger {
    color: #fff;
    background: #dc3545;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); 
    border: none; 
}

.like-button .btn-danger:hover {
    background: #bd2130;
    color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); 
}

.card-meta .like-count-icon {
    font-size: 1.2em; 
    color: var(--greyDark);
}

.like-button .btn i {
    font-size: 1.5em; 
    line-height: 1; 
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

/* Pagination Styles */
.page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 5rem;
    margin: 3rem auto;
    border-radius: 5rem;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05), 0 5px 20px 0 rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
    list-style: none;
}

.page-item {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 1;
}

.page-item:not(:last-child) {
    margin-right: 0.3rem;
}

.page-link {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: transparent;
    border: 0;
    color: #555;
    cursor: pointer;
    transition: all 0.3s;
    padding: 1rem 2rem;
    z-index: 1;
    font-size: 1.6rem;
    font-weight: 700;
    position: relative;
}

.page-link:hover {
    color: #000;
}

.page-item.active .page-link {
    color: #000;
}

.page-item.active {
    box-shadow: none;
}

.page-item.active:not(:last-child) {
    margin-right: 0.3rem;
}

.page-link::before,
.page-link::after {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    border-radius: 50%;
    content: "";
    width: 4rem;
    height: 4rem;
    z-index: -1;
    transition: all 0.3s;
}

.page-link::before {
    background-color: var(--orange);
    top: 0.3rem;
    right: -2rem;
    box-shadow: 2px -2px 0 var(--orange);
}

.page-link::after {
    background-color: var(--pink);
    bottom: 0.3rem;
    left: -2rem;
    box-shadow: -2px 2px 0 var(--pink);
}

.page-item.active .page-link::before,
.page-item.active .page-link::after {
    width: 100%;
    height: 100%;
    border-radius: 5rem;
    box-shadow: none;
}

.page-link[aria-disabled="true"] {
    pointer-events: none;
    color: #ccc;
}

/* Responsive Adjustments */
@media (max-width: 576px) {
    .card-image {
        height: 200px;
    }

    .card-list {
        max-width: 300px;
    }

    .price-badge {
        padding: 0.4rem 0.8rem;
        font-size: 1rem;
    }

    .card-footer {
        flex-direction: column;
        align-items: flex-start;
    }

    .modal-body .form-group {
        flex: 1 1 100%;
    }

    .modal-dialog.modal-lg {
        max-width: 100%;
    }
}

@media (min-width: 768px) and (max-width: 991px) {
    .modal-body .form-group {
        flex: 1 1 45%;
    }

    .modal-dialog.modal-lg {
        max-width: 70%;
    }
}


</style>
@endsection

@section('content')
@if (session('success'))
<div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="C3.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="C3.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="C3.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<!-- Search and filter buttons -->
<div class="search-bar mb-5">
    <img src="LogooB.png" alt="Living HUB Logo" width="400" style="display: block; margin: auto;">
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
<!-- Properties Section -->
<div class="container mt-4">
    <div class="row">
        @foreach($properties as $property)
        <div class="col-md-3 mb-3">
            <a href="{{ route('property.show', $property->id) }}" class="text-decoration-none text-dark">
                <div class="card property-card" data-property-id="{{ $property->id }}">
                    <div class="card-image position-relative">
                        @if($property->images->isNotEmpty())
                            <img src="{{ asset($property->images->first()->images) }}" alt="{{ $property->name }}" width="100">
                        @else
                            <img src="https://a57.foxnews.com/static.foxbusiness.com/foxbusiness.com/content/uploads/2022/02/0/0/Screen-Shot-2022-02-08-at-1.01.01-PM-gigapixel-low_res-scale-2_00x.png?ve=1&tl=1" alt="No Image Available" width="100">
                        @endif
                        <div class="price-badge">
                            <span>Rp {{ number_format($property->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="like-button">
                        @auth
                            @if(auth()->user()->likes && auth()->user()->likes->contains($property->id))
                                <form action="{{ route('properties.unlike', $property) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger liked">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('properties.like', $property) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-danger">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </a>
                        @endauth
                    </div>
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between">
                            <h5>{{ $property->name }}</h5>
                        </div>
                        <p class="card-text">{{ $property->location }}</p>
                        <p class="card-text">LB: {{ $property->buildingArea }} m²</p>
                        <p class="card-text">LS: {{ $property->surfaceArea }} m²</p>
                    </div>
                    <div class="card-footer">
                        <div class="card-meta d-flex justify-content-between">
                            <span class="position-relative like-count-icon">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                {{ $property->like_count }}
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                @if ($property->published_at)
                                    {{ \Carbon\Carbon::parse($property->updated_at)->format('d/m/Y') }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<!-- Pagination Section -->
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

    <!-- Next Page Button -->
    <button class="page__btn {{ $properties->currentPage() == $properties->lastPage() ? '' : 'active' }}" onclick="window.location='{{ $properties->nextPageUrl() }}'">&gt;</button>
@endif
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

    function hideAlert() {
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            successAlert.classList.add('hide');
            setTimeout(() => {
                successAlert.remove(); 
            }, 500); 
        }
    }

    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.classList.add('hide');
            setTimeout(() => {
                successAlert.remove(); 
            }, 500); 
        }, 3000); 
    }
});

function resetFilters() {
    document.getElementById('filterForm').reset();
    document.querySelectorAll('.btn-group-toggle .btn').forEach(btn => btn.classList.remove('active'));
}
</script>
@endsection
