@extends('master')
@section('title', 'Seller Profile')
@section('content')


<div class="container">
{{-- Seller Profile Card --}}
<div class="seller-profile-card mb-4 p-4 mt-4" style="border-radius: 15px;">
    <div class="row align-items-center">
        <div class="col-md-3 text-center">
            @if($seller->avatar)
                <img id="ProfilePicture" src="{{ Chatify::getUserWithAvatar($seller)->avatar }}" alt="Profile Picture" class="rounded-circle">
            @else
                <i class="fa fa-user-o" aria-hidden="true" style="font-size: 150px;"></i>
            @endif
        </div>
        <div class="col-md-6">
            <div>
                <h5 class="seller-profile-card-title">{{ $seller->name }}</h5>
                <p class="seller-profile-card-text"><strong>@</strong> {{ $seller->username }}</p>
            </div>
        </div>
        <div class="col-md-3 text-center">
            {{-- Chat Button --}}
            <a href="{{ url('chatify/' . $seller->id) }}" class="btn btn-outline-secondary seller-profile-chat-button">
                <i class="fa fa-comments-o" aria-hidden="true"></i> Chat
            </a>
        </div>
    </div>
</div>

<!-- Search and filter buttons -->
<div class="search-bar mb-5">
    <h2 style="text-align: center; font-weight: bold;">Search for properties at this agency</h2>
    <form action="{{ route('profileseller', $seller->id) }}" method="GET" class="input-group">
        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Search Keyword">
        <button type="button" class="filter-button" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-filter" aria-hidden="true"></i>
        </button>
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
                <form action="{{ route('profileseller', $seller->id) }}" method="GET" id="filterForm">
                    <!-- Status Filter -->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="status" autocomplete="off" value="Dijual" {{ request('status') == 'Dijual' ? 'checked' : '' }}> Dijual
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="status" autocomplete="off" value="Disewa" {{ request('status') == 'Disewa' ? 'checked' : '' }}> Disewa
                            </label>
                        </div>
                    </div>

                    <!-- Bedrooms Filter -->
                    <div class="form-group">
                        <label for="bedrooms">Kamar Tidur</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bedrooms" autocomplete="off" value="1 Kamar" {{ request('bedrooms') == '1 Kamar' ? 'checked' : '' }}> 1 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bedrooms" autocomplete="off" value="2 Kamar" {{ request('bedrooms') == '2 Kamar' ? 'checked' : '' }}> 2 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bedrooms" autocomplete="off" value="3 Kamar" {{ request('bedrooms') == '3 Kamar' ? 'checked' : '' }}> 3 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bedrooms" autocomplete="off" value="3+ Kamar" {{ request('bedrooms') == '3+ Kamar' ? 'checked' : '' }}> 3+ Kamar
                            </label>
                        </div>
                    </div>

                    <!-- Bathrooms Filter -->
                    <div class="form-group">
                        <label for="bathrooms">Kamar Mandi</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bathrooms" autocomplete="off" value="1 Kamar" {{ request('bathrooms') == '1 Kamar' ? 'checked' : '' }}> 1 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bathrooms" autocomplete="off" value="2 Kamar" {{ request('bathrooms') == '2 Kamar' ? 'checked' : '' }}> 2 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bathrooms" autocomplete="off" value="3 Kamar" {{ request('bathrooms') == '3 Kamar' ? 'checked' : '' }}> 3 Kamar
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="bathrooms" autocomplete="off" value="3+ Kamar" {{ request('bathrooms') == '3+ Kamar' ? 'checked' : '' }}> 3+ Kamar
                            </label>
                        </div>
                    </div>

                    <!-- Land Size Filter -->
                    <div class="form-group">
                        <label for="land_size">Luas Tanah</label>
                        <div class="input-range">
                            <input type="number" name="land_size_min" placeholder="0" class="form-control" value="{{ request('land_size_min') }}">
                            <span>m² -</span>
                            <input type="number" name="land_size_max" placeholder="0" class="form-control" value="{{ request('land_size_max') }}">
                            <span>m²</span>
                        </div>
                    </div>

                    <!-- Building Size Filter -->
                    <div class="form-group">
                        <label for="building_size">Luas Bangunan</label>
                        <div class="input-range">
                            <input type="number" name="building_size_min" placeholder="0" class="form-control" value="{{ request('building_size_min') }}">
                            <span>m² -</span>
                            <input type="number" name="building_size_max" placeholder="0" class="form-control" value="{{ request('building_size_max') }}">
                            <span>m²</span>
                        </div>
                    </div>

                    <!-- Property Type Filter -->
                    <div class="form-group">
                        <label for="property_type">Tipe Properti</label>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="property_type" autocomplete="off" value="Rumah" {{ request('property_type') == 'Rumah' ? 'checked' : '' }}> Rumah
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="property_type" autocomplete="off" value="Apartemen" {{ request('property_type') == 'Apartemen' ? 'checked' : '' }}> Apartemen
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="property_type" autocomplete="off" value="Ruko" {{ request('property_type') == 'Ruko' ? 'checked' : '' }}> Ruko
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="property_type" autocomplete="off" value="Tanah" {{ request('property_type') == 'Tanah' ? 'checked' : '' }}> Tanah
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

{{-- Property Section --}}
<div class="row">
    @if($properties->isEmpty())
        <div class="col-12 text-center">
            <p class="text-muted">Property not found.</p>
        </div>
    @else
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
    @endif
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
</div>
            
@section('scripts')
<script>
    window.addEventListener("pageshow", function(event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        // Reload the page if it's from cache
        location.reload();
        }
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
    padding-top: 80px;
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

.seller-profile-card {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); 
    border: none;
    border-radius: 15px;
    background-color: #fff;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    margin-top: 1000px;
}

.seller-profile-card:hover {
    transform: translateY(-5px); 
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); 
}

#ProfilePicture {
    width: 150px;
    height: 150px;
    object-fit: cover; 
    border: 5px solid #f0f0f0; 
    transition: border-color 0.3s ease-in-out;
}

.seller-profile-card-title {
    font-size: 26px;
    font-weight: bold;
    color: #333;
}

.seller-profile-card-text {
    font-size: 16px;
    color: #555;
}

.seller-profile-card-text strong {
    color: #888;
}

.seller-profile-chat-button {
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 25px;
    transition: all 0.3s ease;
    color: #333;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    transition: color 0.3s ease, border-color 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    text-decoration: none;
}
.seller-profile-chat-button:hover {
    color: #fff !important;
    background-color: #4A4AC4 !important;
    border-color: #4A4AC4 !important;
    box-shadow: 0px 4px 10px rgba(74, 74, 196, 0.4) !important;
}

.seller-profile-chat-button:focus {
    outline: none;
    color: #fff !important; 
    background-color: #4A4AC4 !important;
    border-color: #4A4AC4 !important;
}

@media (max-width: 768px) {
    .seller-profile-card {
        padding: 20px;
    }

    #ProfilePicture {
        width: 120px;
        height: 120px;
    }

    .seller-profile-card-title {
        font-size: 22px;
    }

    .seller-profile-chat-button {
        padding: 8px 16px;
        font-size: 14px;
    }
}

.property-card {
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.property-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
.card-list {
    width: 100%; 
    max-width: 400px; 
    margin: 0 auto; 
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
    width: 100%; 
}

.card-image {
    position: relative;
    border-radius: 10px;
    height: 200px; 
    max-height: 200px;
    overflow: hidden;
}

.card-image img {
    width: 100%;
    height: 100%; 
    object-fit: cover;
    border-radius: 10px;
    max-height: none; 
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


</style>
@endsection
