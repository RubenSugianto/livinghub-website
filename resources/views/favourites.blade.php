<!-- favourites.blade.php -->
@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>My Favourite Properties</h1>
                @foreach(auth()->user()->favourites as $property)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $property->name }}</h5>
                            <p class="card-text">{{ $property->description }}</p>
                            <!-- Add other property details you want to display -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
