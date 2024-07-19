@extends('master')

@section('title', 'Home')

@section('styles')
<style>

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
      overflow: hidden;
    }

    .card-image img {
      width: 100%;
      display: block;
      border-radius: 10px;
    }

    .card-image::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 50%; 
      background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
      z-index: 1;
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

    .card-body {
      padding: 1.25rem;
      position: relative;
    }

    .card-title {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .icon-button {
      border: 0;
      background-color: #fff;
      border-radius: 50%;
      width: 2.5rem;
      height: 2.5rem;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-shrink: 0;
      font-size: 1.25rem;
      transition: 0.25s ease;
      box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05), 0 3px 8px 0 rgba(0, 0, 0, 0.15);
      z-index: 2; 
      cursor: pointer;
      color: #565656;
      position: absolute;
      top: -10px;
      right: 0;
    }

    .icon-button svg {
      width: 1em;
      height: 1em;
    }

    .icon-button:hover, .icon-button:focus {
      background-color: #EC4646;
      color: #FFF;
    }

    .icon-button.liked {
      background-color: #EC4646;
      color: #FFF;
    }

    .icon-button.liked:hover {
      background-color: #EC4646;
      color: #FFF;
    }

    .card-footer {
      margin-top: 1.25rem;
      border-top: 1px solid #ddd;
      padding-top: 1.25rem;
      display: flex;
      align-items: center;
      flex-wrap: wrap;
    }

    .card-meta {
      display: flex;
      align-items: center;
      color: #787878;
      
    }
    .card-meta:first-child:after {
      display: block;
      content: "";
      width: 4px;
      height: 4px;
      border-radius: 50%;
      background-color: currentcolor;
      margin-left: 0.75rem;
      margin-right: 0.75rem;
    }
    .card-meta svg {
      flex-shrink: 0;
      width: 1em;
      height: 1em;
      margin-right: 0.25em;
    }


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
  


</style>
@endsection

@section('content')
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
                            <img src="{{ asset($property->images->first()->images) }}" class="card-img-top" alt="{{ $property->name }}">
                        @else
                            <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg" class="card-img-top" alt="{{ $property->name }}">
                        @endif
                        <div class="price-badge">
                            <span>Rp {{ number_format($property->price, 0, ',', '.') }}</span>
                        </div>
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
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14H7v-2h5v2zm0-4H7v-2h5v2zm5 4h-3v-2h3v2zm0-4h-3v-2h3v2z"/>
                                </svg>
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
});

function resetFilters() {
    document.getElementById('filterForm').reset();
    document.querySelectorAll('.btn-group-toggle .btn').forEach(btn => btn.classList.remove('active'));
}
</script>
@endsection
