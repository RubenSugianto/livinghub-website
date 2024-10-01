{{-- resources/views/seller/profile.blade.php --}}
@extends('master')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="row no-gutters">
            <div class="col-md-3">
                @if($seller->profilepicture)
                    <img src="{{ asset('storage/' . $seller->profilepicture) }}" class="img-fluid rounded-circle" alt="Profile Picture">
                @else
                    <i class="fa fa-user-o profile-icon" aria-hidden="true" style="font-size: 50px;"></i> <!-- Adjust size as needed -->
                @endif
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h5 class="card-title">{{ $seller->fullname }}</h5>
                    <p class="card-text"><strong>Username:</strong> {{ $seller->username }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $seller->email }}</p>
                    <p class="card-text"><strong>Phone:</strong> {{ $seller->phone }}</p>
                    <p class="card-text"><strong>Gender:</strong> {{ $seller->gender }}</p>
                    <p class="card-text"><strong>Age:</strong> {{ $seller->age }}</p>
                </div>
            </div>
        </div>
    </div>

    <h4>Properties for Sale</h4>
    <div class="row">
        @foreach($properties as $property)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $property->image) }}" class="card-img-top" alt="{{ $property->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="card-text">{{ $property->description }}</p>
                        <a href="{{ route('property.show', $property) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
