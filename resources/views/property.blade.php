@extends('master')

@section('title', 'Detail Property')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
            <a href="javascript:history.back()" class="back-button">
             <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                </a>

                <div class="image-container">
                    <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg" class="img-fluid" alt="{{ $property->name }}">
                </div>

                <div class="tags">
                    <span class="tag">{{ $property->status }}</span>
                    <span class="tag">{{ $property->type }}</span>
                </div>

                <h1 class="mt-2">{{ $property->name }}</h1>
                <h1 class="mt-3">Rp {{ number_format($property->price, 0, ',', '.') }}</h1>
                <p class="location">{{ $property->location }}</p>

                <h3 class="section-title">Deskripsi Properti</h3>
                <article class="my-3 fs-5">
                    {!! $property->description !!}
                </article>

                <h3 class="section-title">Informasi Properti</h3>
                <div class="property-info">
                    <p><i class="fa fa-bed" aria-hidden="true"></i> <span class="spacer">{{ $property->bedroom }}</span></p>
                    <hr>
                    <p><i class="fa fa-bath" aria-hidden="true"></i> <span class="spacer">{{ $property->bathroom }}</span></p>
                    <hr>
                    <p><i class="fa fa-bolt" aria-hidden="true"></i> <span class="spacer">{{ $property->electricity }} watt</span></p>
                    <hr>
                    <div class="info-item">
                        <p><strong>Luas Tanah</strong> <span class="spacer">{{ $property->surfaceArea }} m²</span></p>
                        <hr>
                        <p><strong>Luas Bangunan</strong> <span class="spacer">{{ $property->buildingArea }} m²</span></p>
                    </div>
                    <hr>
                    <p><strong>Terakhir Update</strong> <span class="spacer">{{ $property->updated_at ? \Carbon\Carbon::parse($property->updated_at)->format('d/m/Y') : '-' }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .image-container {
            position: relative;
            max-height: 400px;
            overflow: hidden;
            border-radius: 15px;
            margin-top: 80px;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            text-decoration: none;
            z-index: 10;
            font-size: 28px;
            color: black;
        }

        .back-button:hover {
            color: #4A4AC4 !important;
            text-decoration: none;
        }

        .img-fluid {
            width: 100%;
            height: auto;
            border-radius: 15px;
        }

        .tags {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .tag {
            background-color: #777;
            border-radius: 10px;
            padding: 10px 15px; 
            font-size: 18px; 
            font-weight: bold;
            color: #ddd;
        }

        h1 {
            font-size: 40px;
            font-weight: bold;
        }

        .price {
            font-size: 28px;
            color: #000;
        }

        .location {
            font-size: 18px;
            color: #777;
        }

        .section-title {
            font-size: 22px;
            font-weight: bold;
            margin-top: 20px;
        }

        .property-info p {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }

        .property-info hr {
            border: 1px solid #ddd;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }
    </style>
@endsection
