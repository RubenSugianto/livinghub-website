@extends('master')

@section('title', 'Favorites')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Favorit Saya</h1>
    <div class="row justify-content-center flex-column">
        @if($favorites->isEmpty())
            <p>Anda belum memiliki properti favorit.</p>
        @else
            <p>Terdapat {{ $favorites->total() }} properti yang ditemukan</p>
            <div id="comparisonContainer">
                <button id="compareButton" class="btn btn-primary mb-3" disabled>Bandingkan Properti</button>
            </div>
            @foreach($favorites as $property)
                <div class="col-md-10 mb-3">
                    <div class="property-select d-flex align-items-center">
                        <input type="checkbox" class="compare-checkbox" data-property-id="{{ $property->id }}">
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
                                    <h5 class="card-title">{{ $property->name }}</h5>
                                    <p class="price">Rp {{ number_format($property->price, 0, ',', '.') }}</p>
                                    <p class="card-text">{{ $property->location }}</p>
                                    <div class="property-details mt-2 d-flex flex-wrap align-items-center">
                                        <p class="mr-3"><strong>LT:</strong> <span class="spacer">{{ $property->surfaceArea }} m²</span></p>
                                        <p class="mr-3"><strong>LB:</strong> <span class="spacer">{{ $property->buildingArea }} m²</span></p>
                                    </div>
                                    <div class="property-description mt-3">
                                        {!! $property->description !!}
                                    </div>
                                </div>
                            </a>
                            <form action="{{ route('favorites.destroy', $property->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link delete-button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </div>
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
        @endif
    </div>

    <!-- Comparison Table -->
    <div id="comparisonTableContainer" class="mt-4" style="display: none;">
        <h2>Comparison Table</h2>
        <table class="table table-bordered">
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
@endsection

@section('scripts')
<script>
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
                    <td>Description</td>
                    <td>${data[0].description}</td>
                    <td>${data[1].description}</td>
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
body {
    background-color: #f8f9fa;
}

.property-card {
    transition: transform 0.2s;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
}

.property-card:hover {
    transform: scale(1.01);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.property-select {
    display: flex;
    align-items: center;
}

.card-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 50%;
}

.property-description {
    flex-grow: 1;
}

.price {
    color: black;
    font-size: 1em;
}

.card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.card-image {
    width: 30%;
    height: 200px;
}

.card-title {
    font-size: 1.2em;
    font-weight: bold;
}

.delete-form {
    margin-left: auto;
}

.delete-button {
    background: none;
    border: none;
    color: #dc3545;
    font-size: 1.5em;
    cursor: pointer;
}

.delete-button:hover {
    color: #bd2130;
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


.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
    border-top: 2px solid #dee2e6;
}
</style>
@endsection
