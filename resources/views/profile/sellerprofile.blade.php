{{-- resources/views/seller/profile.blade.php --}}
@extends('master')

@section('content')
<div class="container">
    {{-- Seller Profile Card --}}
    <div class="card mb-4 p-4 mt-4" style="border-radius: 15px;">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                @if($seller->avatar)
                    <img id="ProfilePicture" src="{{ Chatify::getUserWithAvatar($seller)->avatar }}" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px;">
                @else
                    <i class="fa fa-user-o" aria-hidden="true" style="font-size: 150px;"></i>
                @endif
            </div>
            <div class="col-md-6">
                <div>
                    <h5 class="card-title">{{ $seller->name }}</h5>
                    <p class="card-text"><strong>Username:</strong> {{ $seller->username }}</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                {{-- Chat Button --}}
                <a href="{{ url('chatify/' . $seller->id) }}" class="btn btn-outline-secondary chat-button">
                    <i class="fa fa-comments-o" aria-hidden="true"></i> Chat
                </a>
            </div>
        </div>
    </div>

    {{-- Property Section --}}
    <h2 class="mb-4 text-center">PROPERTY</h2>
    <div class="row">
    @foreach($properties as $property)
        <div class="col-md-3 mb-3">
            <a href="{{ route('property.show', $property->id) }}" class="text-decoration-none text-dark">
                <div class="card property-card" data-property-id="{{ $property->id }}">
                    <div class="card-image position-relative">
                        <!-- Updated Image Handling -->
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
@endsection
