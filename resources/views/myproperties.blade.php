@extends('master')

@section('title', 'My Property')

@section('content')
    <div class="container mt-4 text-center">
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
                        <form action="{{ route('myproperties.search') }}" method="GET" id="filterForm">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr data-property-id="{{ $property->id }}">
                                <td>
                                    <img src="{{ asset($property->images->first()->images) }}" alt="{{ $property->name }}" width="100">
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
                                <td>
                                    <a href="#', $property->id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                   <form action="#" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </form>
                                    <a href="#" class="btn btn-secondary"><i class="fa fa-file-text" aria-hidden="true"></i></a>
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
    border-radius: 4px 0 0 4px;
}

.search-bar button {
    padding: 10px;
    background-color: #5E5DF0;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.search-bar button[type="submit"] {
    border-radius: 0 4px 4px 0;
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

.page__btn, .page__numbers {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 5px 10px;
    margin: 0 2px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.page__btn.active, .page__numbers.active {
    background-color: #5E5DF0;
    color: white;
}

.page__dots {
    padding: 5px 10px;
}

.page {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}
</style>
@endsection
