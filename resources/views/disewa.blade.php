@extends('master')

@section('navbar')
    @include('partials.navbaruser')
@endsection

@section('title', 'Properti Sewa')

@section('content')
<div class="container mt-4 dijual-page">
 <!-- Search and filter buttons -->

<div class="search-bar mb-5">
    <form action="{{ route('search') }}" method="GET" class="input-group">
        <input type="text" name="search" id="search-input" placeholder="Cari Properti..." class="form-control">
        <button type="submit" class="btn btn-outline-secondary">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary filter-button" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-filter" aria-hidden="true"></i>
        </button>
    </form>
    <div class="keyword-suggestions mt-15">
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
                <button type="submit" form="filterForm" class="btn btn-primary" style="background-color: #5E5DF0; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#4A4AC4';" onmouseout="this.style.backgroundColor='#5E5DF0';">Cari</button>
            </div>
        </div>
    </div>
</div>


    <h1>Hasil Pencarian</h1>
    <div class="row justify-content-center flex-column">
        @if($properties->isEmpty())
            <p>Properti tidak ditemukan.</p>
        @else
            <p>Terdapat {{ $properties->total() }} properti yang ditemukan</p>
            @foreach($properties as $property)
                <div class="col-md-10 mb-3">
                    <a href="{{ route('property.show', $property->id) }}" class="text-decoration-none text-dark">
                    <div class="card property-card" data-property-id="{{ $property->id }}">
                    <div class="card-image position-relative">
                        @if($property->images->isNotEmpty())
                            <img src="{{ asset($property->images->first()->images) }}" alt="{{ $property->name }}" width="100">
                        @else
                            <img src="https://a57.foxnews.com/static.foxbusiness.com/foxbusiness.com/content/uploads/2022/02/0/0/Screen-Shot-2022-02-08-at-1.01.01-PM-gigapixel-low_res-scale-2_00x.png?ve=1&tl=1" alt="No Image Available" width="100">
                        @endif
                         </div>
                            <div class="card-body">
                                <div class="price mb-2">
                                    <span class="font-weight-bold" style="font-size: 20px;">Rp {{ number_format($property->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="card-title d-flex justify-content-between align-items-center">
                                    <h5 style="font-size: 20px;">{{ $property->name }}</h5>
                                </div>
                                <p class="card-text">{{ $property->location }}</p>
                                <div class="d-flex justify-content-start">
                                <span class="badge bg-secondary">{{ $property->status }}</span>
                                <span class="badge bg-secondary">{{ $property->type }}</span>
                                <span class="badge bg-secondary">{{ $property->documents->first()->type }}</span>

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
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                    @if ($property->published_at)
                                        <span class="ml-2">{{ \Carbon\Carbon::parse($property->updated_at)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center">
                                @if($property->user->profilepicture)
                                    <img id="ProfilePicture" src="{{ asset('storage/' . $property->user->profilepicture) }}" alt="Profile Picture" onerror="this.src='{{ asset('path/to/default/profile.png') }}'">
                                @else
                                <i class="fa fa-user-o" style="font-size: 15px; color: grey;"></i>
                                @endif
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

    const keywordSuggestions = document.querySelector('.keyword-suggestions');
    const searchInput = document.getElementById('search-input');
    const searchForm = document.querySelector('.search-bar form');

    // List of potential keywords (you can extend this list)
    const keywords = [
        'Rumah mewah', 'Rumah asri', 'Apartemen murah', 'Ruko disewa',
        'Tanah dijual', 'Rumah strategis', 'Apartemen dijual', 'Ruko minimalis',
        'Rumah cluster', 'Villa disewa', 'Kost murah', 'Kavling strategis',
        'Tanah murah', 'Rumah klasik', 'Ruko produktif', 'Apartemen premium',
        'Rumah luas', 'Kost eksklusif', 'Ruko ramai', 'Tanah strategis'
    ];

    // Function to generate random keywords
    function getRandomKeywords(count) {
        const shuffled = keywords.sort(() => 0.5 - Math.random());
        return shuffled.slice(0, count);
    }

    // Generate and display keyword suggestions
    function displayKeywordSuggestions() {
        const randomKeywords = getRandomKeywords(5);
        keywordSuggestions.innerHTML = randomKeywords.map(keyword => 
            `<button type="button" class="btn btn-outline-secondary btn-sm mr-2 mb-2 keyword-btn">${keyword}</button>`
        ).join('');
    }

    // Initial display of keyword suggestions
    displayKeywordSuggestions();

    // Event delegation for keyword buttons
    keywordSuggestions.addEventListener('click', function(event) {
        if (event.target.classList.contains('keyword-btn')) {
            searchInput.value = event.target.textContent;
            searchForm.submit();
        }
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

    .property-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        max-width: 100%;
        width: 100%;
        margin: 8px auto;
    }

    .property-card:hover {
        transform: scale(1.005);
    }

    .badge {
        font-size: 14px;
        padding: 0.3em 0.8em;
        margin-right: 8px;
    }

    .card-image img {
        width: 100%;
        height: 350px;
        object-fit: cover;
    }

    .price {
        font-size: 14px;
        font-weight: bold;
    }

    .card-body {
        padding: 15px;
    }

    .card-title h5 {
        font-size: 16px;
        font-weight: bold;
    }

    .card-title svg {
        margin-left: 6px;
        cursor: pointer;
    }

    .card-text {
        font-size: 12px;
        color: #555;
    }

    .card-footer {
        padding: 8px;
        background: #f8f9fa;
    }

    .card-meta img {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        margin-right: 6px;
    }

    .spacer {
        margin-left: 3px;
    }

    .property-details p {
        margin-right: 6px;
        font-size: 12px;
    }

    .property-details svg {
        margin-right: 3px;
    }

    .property-details strong {
        font-weight: bold;
    }

    .property-description {
        font-size: 12px;
        color: #555;
        margin-top: 6px;
        max-height: 70px;
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
        align-items: center;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        border: 2px solid #ccc;
        border-radius: 25px;
        overflow: hidden;
        background-color: var(--background-color);
        padding: 5px;
        margin-top: 90px;
    }

    .search-bar input[type="text"] {
        flex: 1;
        padding: 10px;
        border: none;
        outline: none;
        font-size: 14px;
        background-color: var(--background-color);
    }

    .input-group input[type="text"]:focus {
        outline: none !important; 
        box-shadow: none; 
    }

    .input-group button {
        padding: 10px;
        background-color: transparent !important; 
        border: none !important; 
        box-shadow: none !important; 
        cursor: pointer;
        color: black; 
        transition: color 0.3s ease, background-color 0.3s ease; 
    }

    .input-group button i {
        font-size: 14px;
    }

    .input-group button:hover {
        color: #4A4AC4; 
        background-color: transparent !important; 
    }
    
    .input-group button:focus {
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

    .keyword-suggestions {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;  
        margin-top: 15px;
    }

    .keyword-btn {
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        border-radius: 25px;  
        padding: 7px 15px;    
        font-size: 14px;  
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
        color: grey;
    }

    .keyword-btn:hover {
        background-color: #4A4AC4 !important;
        transform: scale(1.05);  
        color: #ffffff;
    }


    .keyword-btn:active,
    .keyword-btn:focus {
        background-color: #4A4AC4 !important; 
        color: #ffffff;
        box-shadow: none !important; 
    }


</style>
@endsection