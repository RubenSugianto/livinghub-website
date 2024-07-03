@extends('master')

@section('title', 'Detail Property')

@section('content')
    <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8">
                        <h1>{{$property->name}}</h1>

                        <div style="max-height: 350px; overflow:hidden;">
                            <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg" class="img-fluid" alt="{{ $property->name}}">
                        </div>

                        <article class="my-3 fs-5">
                            {!! $property->description !!}
                        </article>

                        <a href="/" class="d-block mt-5">Back to Home</a>
                    </div>
                </div>
        </div>
@endsection

