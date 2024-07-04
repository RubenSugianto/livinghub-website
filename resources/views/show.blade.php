@extends('master')

@section('title', $property->name)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>{{ $property->name }}</h1>
                </div>
                <div class="card-body">
                    <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg" class="img-fluid mb-3" alt="{{ $property->name }}">
                    <p><strong>Price:</strong> Rp {{ number_format($property->price, 0, ',', '.') }}</p>
                    <p><strong>Location:</strong> {{ $property->location }}</p>
                    <p><strong>Description:</strong> {{ $property->description }}</p>
                    <p><strong>Bedrooms:</strong> {{ $property->bedroom }}</p>
                    <p><strong>Bathrooms:</strong> {{ $property->bathroom }}</p>
                    <p><strong>Electricity:</strong> {{ $property->electricity }} Watt</p>
                    <p><strong>Building Area:</strong> {{ $property->buildingArea }} m²</p>
                    <p><strong>Surface Area:</strong> {{ $property->surfaceArea }} m²</p>
                    <p><strong>Status:</strong> {{ $property->status }}</p>
                    <p><strong>Type:</strong> {{ $property->type }}</p>
                    @if ($property->published_at)
                        <p><strong>Published at:</strong> {{ \Carbon\Carbon::parse($property->published_at)->format('d/m/Y') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
