@extends('master')

@section('title', 'My Property')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ $title }}</h1> 

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
                                    @if($property->images->isNotEmpty())
                                        <img src="{{ asset($property->images->first()->images) }}" class="card-img-top" alt="{{ $property->name }}">
                                    @else
                                        <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg" class="card-img-top" alt="{{ $property->name }}">
                                    @endif
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
            border-radius: 4px;
        }

        .search-bar button {
            padding: 10px;
            background-color: #5E5DF0;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
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

        .property-card {
            transition: transform 0.2s;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .property-card:hover {
            transform: translateY(-10px);
        }

        .card-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 10px 20px;
            border-top: 1px solid #ddd;
        }

        .property-details p {
            margin-right: 20px;
        }

        .spacer {
            margin-left: 5px;
        }

        .property-description {
            max-height: 100px;
            overflow: hidden;
        }

        .page__btn {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px 10px;
            margin: 0 2px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .page__btn.active {
            background-color: #5E5DF0;
            color: white;
        }

        .page__numbers {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px 10px;
            margin: 0 2px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .page__numbers.active {
            background-color: #5E5DF0;
            color: white;
        }

        .page__dots {
            padding: 5px 10px;
            color: #888;
        }

        .page {
            display: flex;
            align-items: center;
        }

        .card-footer svg {
            margin-right: 5px;
        }

        .card-footer img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
        }

        .card-footer span {
            margin-left: 5px;
        }
    </style>
@endsection
