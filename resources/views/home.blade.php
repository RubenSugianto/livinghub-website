@extends('master')

@section('title', 'Home')

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

img {
    max-width: 100%;
    display: block;
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
    margin-top: 80px;
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


#carouselExampleIndicators {
    margin-top: 120px; 
    position: relative;

}

.carousel-item img {
    max-height: 400px;
    width: 100%;
    object-fit: contain;
}


.search-bar h2 {
    margin-top: 50px;
    text-align: center;
    font-weight: bold;
    font-size: 4rem;
    margin-bottom: 20px;
}

.search-bar .input-group {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    border: 2px solid #ccc;
    border-radius: 25px;
    overflow: hidden;
    background-color: var(--background-color);
    padding: 5px;
}

.search-bar input[type="text"] {
    flex: 1;
    padding: 10px;
    border: none;
    outline: none;
    font-size: 1.2rem;
    background-color: var(--background-color);
}

.search-bar button,
.search-bar .filter-button {
    padding: 10px;
    background: none;
    color: black;
    border: none;
    cursor: pointer;
    transition: color var(--transition-speed) ease;
    font-size: 1.2rem;
}

.search-bar button:hover,
.search-bar .filter-button:hover {
    color: var(--secondary-color);
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

.btn-group-toggle .btn input[type="radio"] {
    display: none;
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

img {
    max-width: 100%;
    display: block;
}
.header-pic-container {
    width: 100%;
    position: relative ;
    top: 0 ;
    left: 0 ;
    right: 0 ;
    z-index: 0 ; 

}

.header-pic-container img {
    width: 100vw; 
    height: auto;
    display: block;
    object-fit: cover; /
}

.header-button {
    position: absolute ;
    top: 75% ; 
    left: 50% ;
    transform: translate(-50%, -50%);
    padding: 10px 20px ; 
    background-color:  #5E5DF0 !important; 
    color: #fff !important; 
    text-decoration: none !important; 
    border-radius: 50px !important; 
    font-size: 14px !important; 
    font-weight: bold !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important; 
    display: flex ;
    align-items: center ;
    justify-content: center ;

}

.header-button::after {
    content: '\2197'; 
    font-size: 16px; 
    margin-left: 8px;
    transition: margin-left 0.3s ease;
}

.header-button:hover::after {
    margin-left: 12px; 
}

.header-button:hover {
    background-color: #4A4AC4 !important; 
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
    display: flex;
    align-items: center; 
    gap: 15px; 
}

.like-count-icon,
.card-footer span {
    display: inline-flex;
    align-items: center; 
    gap: 5px; 
}

.like-count-icon i,
.card-footer i {
    font-size: 1rem; 
    vertical-align: middle;
}

.card-footer span {
    line-height: 1; 
}

.card-footer i {
    vertical-align: middle; 
}

.like-count-icon {
    margin-right: 15px; 
}

.like-button {
    position: absolute;
    top: 55%;
    right: 8px;
    transform: translateY(-50%);
    z-index: 4; 
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
.card {
    margin-top: 50px;
    border: none;
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-10px);
}

.card img {
    max-width: 200px; 
    height: auto;
    display: block;
    margin: 0 auto 40px; /
}

.btn {
    border: 2px solid #333; 
    background-color: transparent; 
    color: #333; 
    padding: 10px 20px; 
    margin-top: 20px; 
    font-weight: bold; 
    transition: all 0.3s ease; 
    outline: none; 
}

.btn:hover {
    background-color: #333; 
    color: #fff; 
}

.btn:focus {
    outline: none; 
}

.latest-property-heading {
    text-align: center;
    font-size: 4rem;
    font-weight: 700;
    color: #333;
    margin-top: 50px;
}


.ks {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.keyword-suggestions {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;  
    margin-top: 20px;
}
.keyword-suggestion {
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 30px;
    padding: 10px 25px;
    font-size: 1.25rem; 
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    color: grey;
}

.keyword-suggestion:hover {
    background-color: #4A4AC4;
    transform: scale(1.05);
    color: #ffffff;
}


</style>
@endsection
@section('content')
@if (session('success'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle alert-icon" aria-hidden="true"></i>
        <span class="alert-content">
            <strong>{{ session('success') }}</strong>
        </span>
        <button type="button" class="btn-close close-btn" aria-label="Close" onclick="this.parentElement.style.display='none';">✖</button>
    </div>
@endif

<!-- Header Image -->
<div class="header-pic-container">
    <img src="HeaderPic.png" alt="Header Image">

    <!-- Button -->
    <a href="{{ route('search')}}" class="header-button">Explore Property</a>
</div>

<!-- Text Section -->
<div class="container text-center mt-5" style="padding-top: 50px;">
    <h2 style="font-size: 5rem; font-weight: 700;">What we provide</h2>
    <p style="font-size: 1.25rem; font-weight: 400;">Discover your perfect dream property effortlessly with our expert assistance, guiding you every step of the way.</p>
</div>
<!-- Cards Section -->
<div class="container mt-4">
    <div class="row text-center">
        <!-- First Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="icon mb-3">
                        <img src="icon1.png" alt="Buy a property">
                    </div>
                    <h5 class="card-title">Buy a home</h5>
                    <div class="details preview">
                        <p class="card-text">Find your dream home with a rich photo experience and access to the largest number of listings.</p>
                    </div>
                    <button class="btn btn-outline-dark mt-3 toggle-details" type="button" onclick="window.location.href='{{ route('dijual') }}'">BUY NOW</button>
                </div>
            </div>
        </div>

        <!-- Second Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 ">
                <div class="card-body">
                    <div class="icon mb-3">
                        <img src="icon2.png" alt="Sell a property">
                    </div>
                    <h5 class="card-title">Sell a home</h5>
                    <div class="details preview">
                        <p class="card-text">List your home with ease and connect with potential buyers through our extensive network.</p>
                    </div>
                    <button class="btn btn-outline-dark mt-3 toggle-details" type="button" onclick="window.location.href='{{ route('property.add') }}'">SELL NOW</button>
                </div>
            </div>
        </div>

        <!-- Third Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="icon mb-3">
                        <img src="icon3.png" alt="Rent a home">
                    </div>
                    <h5 class="card-title">Rent a home</h5>
                    <div class="details preview">
                        <p class="card-text">Explore rental properties and find a place to call home with our comprehensive listings.</p>
                    </div>
                    <button class="btn btn-outline-dark mt-3 toggle-details" type="button" onclick="window.location.href='{{ route('disewa') }}'">RENT NOW</button>
                    </div>
            </div>
        </div>
    </div>
</div>


<!-- Carousel Section -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="C1.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="C2.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="C3.png" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="C4.png" alt="Fourth slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="C5.png" alt="Fifth slide">
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

 <!-- Property Card-->
<div class="container mt-4">
    <h2 class="latest-property-heading mb-4">Latest Property</h2>
    <div class="row">
        @foreach($properties as $property)
        <div class="col-md-3 mb-3">
            <a href="{{ route('property.show', $property->id) }}" class="text-decoration-none text-dark">
                <div class="card property-card" data-property-id="{{ $property->id }}">
                    <div class="card-image position-relative">
                        @if($property->images->isNotEmpty())
                            <img src="{{ asset($property->images->first()->images) }}" alt="{{ $property->name }}" class="img-fluid">
                        @else
                            <img src="https://a57.foxnews.com/static.foxbusiness.com/foxbusiness.com/content/uploads/2022/02/0/0/Screen-Shot-2022-02-08-at-1.01.01-PM-gigapixel-low_res-scale-2_00x.png?ve=1&tl=1" alt="No Image Available" class="img-fluid">
                        @endif
                        <div class="price-badge">
                            <span>Rp {{ number_format($property->price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Like Button -->
                    <div class="like-button">
                        @auth
                            <button data-property-id="{{ $property->id }}" class="like-btn btn @if(auth()->user()->likes && auth()->user()->likes->contains($property->id)) btn-danger @else btn-outline-danger @endif" aria-label="Like Property">
                                <i class="fa @if(auth()->user()->likes->contains($property->id)) fa-heart @else fa-heart-o @endif" aria-hidden="true"></i>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-danger" aria-label="Login to Like Property">
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
                                <span class="like-count">{{ $property->likeCount() }}</span>
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                @if ($property->published_at)
                                    {{ \Carbon\Carbon::parse($property->published_at)->format('d/m/Y') }}
                                @else
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


<!-- Search and filter buttons -->
<div class="search-bar mb-5">
    <h2 style="text-align: center; font-weight: bold;">Looking for something else?</h2>
    <form action="{{ route('search') }}" method="GET" class="input-group">
        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        <input type="text" name="search" id="searchInput" placeholder="Search Keyword">
        <button type="button" class="filter-button" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-filter" aria-hidden="true"></i>
        </button>
    </form>
    <div class="keyword-suggestions">
        <!-- Keyword suggestions will be dynamically inserted here -->
    </div>
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


@section('scripts')
<script>
    window.addEventListener("pageshow", function(event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        // Reload the page if it's from cache
        location.reload();
        }
    });
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

    const keywordSuggestions = document.querySelector('.keyword-suggestions');
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.querySelector('.search-bar form');

    // List of possible keywords
    const keywords = [
        'Rumah mewah', 'Rumah asri', 'Apartemen murah', 'Ruko disewa',
        'Tanah dijual', 'Rumah strategis', 'Apartemen dijual', 'Ruko minimalis',
        'Rumah cluster', 'Villa disewa', 'Kost murah', 'Kavling strategis',
        'Tanah murah', 'Rumah klasik', 'Ruko produktif', 'Apartemen premium',
        'Rumah luas', 'Kost eksklusif', 'Ruko ramai', 'Tanah strategis'
    ];

    // Function to generate random keywords
    function generateRandomKeywords(count) {
        const shuffled = keywords.sort(() => 0.5 - Math.random());
        return shuffled.slice(0, count);
    }

    // Function to create keyword suggestion elements
    function createKeywordSuggestions() {
        const randomKeywords = generateRandomKeywords(5);
        keywordSuggestions.innerHTML = '';
        randomKeywords.forEach(keyword => {
            const suggestionElement = document.createElement('span');
            suggestionElement.classList.add('keyword-suggestion');
            suggestionElement.textContent = keyword;
            suggestionElement.addEventListener('click', () => {
                searchInput.value = keyword;
                searchForm.submit();
            });
            keywordSuggestions.appendChild(suggestionElement);
        });
    }

    // Generate keyword suggestions on page load
        createKeywordSuggestions();
    });

    function resetFilters() {
        document.getElementById('filterForm').reset();
        document.querySelectorAll('.btn-group-toggle .btn').forEach(btn => btn.classList.remove('active'));
    }
    $(document).ready(function() {
        // Event untuk klik tombol like
        $('.like-btn').click(function(e) {
            e.preventDefault();
            e.stopPropagation(); // Stop the click event from bubbling up

            var propertyId = $(this).data('property-id');
            var url = '';

            if (!propertyId) {
                console.error('Property ID not found!');
                return;
            }

            // Tentukan URL berdasarkan status like/unlike
            if ($(this).hasClass('btn-danger')) {
                url = '{{ route("properties.unlike", "__property_id__") }}'.replace('__property_id__', propertyId);
            } else {
                url = '{{ route("properties.like", "__property_id__") }}'.replace('__property_id__', propertyId);
            }

            // Nonaktifkan tombol untuk mencegah multiple clicks
            $(this).prop('disabled', true);

            // Store reference to the button
            var $button = $(this); 

            // Kirim permintaan AJAX
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    property_id: propertyId
                },
                success: function(response) {
                    if (response.success) {
                        // Ambil elemen like count yang hanya berisi angka
                        let likeCountElement = $button.closest('.property-card').find('.like-count');
                        let currentLikes = parseInt(likeCountElement.text());

                        // Pastikan nilai currentLikes tidak NaN
                        if (isNaN(currentLikes)) {
                            currentLikes = 0;
                        }

                        if ($button.hasClass('btn-danger')) {
                            $button.removeClass('btn-danger').addClass('btn-outline-danger');
                            $button.find('i').removeClass('fa-heart').addClass('fa-heart-o');
                            // Decrease like count
                            likeCountElement.text(currentLikes - 1);
                        } else {
                            $button.removeClass('btn-outline-danger').addClass('btn-danger');
                            $button.find('i').removeClass('fa-heart-o').addClass('fa-heart');
                            // Increase like count
                            likeCountElement.text(currentLikes + 1);
                        }
                    } else if (response.status === 401) {
                        // If the user is not logged in, redirect to login page
                        window.location.href = '{{ route("login") }}';
                    }
                },

                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                },
                complete: function() {
                    // Aktifkan kembali tombol setelah permintaan selesai
                    $button.prop('disabled', false);
                }
            });
        });
    });

    </script>
    @endsection
