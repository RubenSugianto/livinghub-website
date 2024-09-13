@extends('master') 

@section('title', 'Detail Properti') 

@section('content') 
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <a href="javascript:history.back()" class="back-button">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
            </a>

            <div id="propertyCarousel" class="carousel slide image-container" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($propertyImages as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset($image->images) }}" class="d-block w-100 img-fluid" alt="Property Image">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#propertyCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#propertyCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- Likes and Favorites -->
            <div class="tags-favorite">
                <div class="tags">
                    <span class="tag">{{ $property->status }}</span>
                    <span class="tag">{{ $property->type }}</span>
                </div>

                <div class="like-favorite-buttons">
                    <!-- Like Button -->
                    <div class="like-button">
                        @auth
                            @if(auth()->user()->likes && auth()->user()->likes->contains($property->id))
                                <form action="{{ route('properties.unlike', $property) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-heart" aria-hidden="true"></i> {{ $property->like_count }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('properties.like', $property) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i> {{ $property->like_count }}
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-danger">
                                <i class="fa fa-heart" aria-hidden="true"></i> {{ $property->like_count }}
                            </a>
                        @endauth
                    </div>

                    <!-- Favorite Button -->
                    <div class="favorite-button">
                        @auth
                            @if(auth()->user()->favorites && auth()->user()->favorites->contains($property->id))
                                <form action="{{ route('properties.unfavorite', $property) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-bookmark" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('properties.favorite', $property) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-danger">
                                <i class="fa fa-bookmark" aria-hidden="true"></i>
                            </a>
                        @endauth
                    </div>
                </div>
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
                <hr>
            </div>

            <!-- Profile Section -->
            <div class="profile-section d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    @if($property->user->profilepicture)
                        <img id="ProfilePicture" src="{{ asset('storage/' . $property->user->profilepicture) }}" alt="Profile Picture" class="profile-picture">
                    @else
                        <i class="fa fa-user-o profile-icon" aria-hidden="true"></i>
                    @endif
                    <span class="ml-2 profile-username">{{ $property->user->username }}</span>
                </div>
                <a href="#" class="btn btn-outline-secondary chat-button">
                    <i class="fa fa-comments-o" aria-hidden="true"></i> Chat
                </a>
            </div>

            <div>
                <h3 class="section-title">Komentar</h3>
                @foreach ($property->comments as $comment)
                <div class="comment">
                    <div class="comment-header">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/user--v1.png" alt="User Icon"/>
                        <strong>{{ $comment->user_name }}</strong>
                    </div>
                    <p>{{ $comment->comment }}</p>
                    <small>{{ $comment->created_at->format('d F Y') }}</small>
                </div>
                @endforeach

                <hr>

                @auth <!-- Hanya tampilkan form jika pengguna sudah login -->
                <h4>Tambahkan Komentar</h4>
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">

                    <div class="comment-input">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/user--v1.png" alt="User Icon"/>
                        <!-- Nama pengguna bisa ditampilkan di sini jika diinginkan -->
                        <strong>{{ Auth::user()->username }}</strong>
                    </div>

                    <textarea name="comment" placeholder="Tambahkan komentar..." required></textarea>
                    <button type="submit">Komen</button>
                </form>
                @else
                <p>Silahkan <a href="{{ route('login') }}">Login</a> untuk menambahkan komentar.</p>
                @endauth
            </div>


        </div>
    </div>
</div>

<style>

    .comment-input {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .comment-input img {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .comment-input strong {
        font-size: 14px;
        color: #333;
        margin-right: 10px;
    }

    textarea[name="comment"] {
        width: calc(100%); /* Sesuaikan lebar sesuai kebutuhan */
        height: 40px; 
        border: 1px solid #ccc;
        border-radius: 15px;
        padding: 8px 15px;
        font-size: 14px;
        resize: none;
        outline: none;
    }

    textarea[name="comment"]::placeholder {
        color: #aaa;
    }

    button[type="submit"] {
        background-color: #777;
        color: white;
        border: none;
        border-radius: 15px;
        padding: 8px 20px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
        background-color: #555;
    }

    .tags-favorite {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        margin-top: 10px;
    }

    .like-favorite-buttons {
        display: flex;
        gap: 10px; 
    }

    .image-container {
        position: relative;
        max-height: 250px;
        overflow: hidden;
        border-radius: 15px;
        margin-top: 50px;
    }

    .back-button {
        position: absolute;
        top: 10px;
        left: 10px;
        text-decoration: none;
        z-index: 10;
        font-size: 18px;
        color: black;
        transition: color 0.3s;
    }

    .back-button:hover {
        color: #4A4AC4 !important; 
        text-decoration: none;
    }

    .image-container {
        position: relative;
        max-height: 500px; /* Increased max-height */
        overflow: hidden;
        border-radius: 15px;
        margin-top: 50px;
    }

    .tags {
        display: flex;
        gap: 10px; 
    }

    .tag {
        background-color: #777; 
        border-radius: 10px;
        padding: 5px 8px;
        font-size: 12px;
        font-weight: bold;
        color: #ddd;
    }

    h1 {
        font-size: 24px; 
        font-weight: bold;
    }

    .price {
        font-size: 20px; 
        color: #000;
    }

    .location {
        font-size: 14px; 
        color: #777;
    }

    .section-title {
        font-size: 16px;
        font-weight: bold;
        margin-top: 20px;
    }

    .property-info p {
        font-size: 12px; 
        color: #555;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
    }

    .property-info hr {
        border: 1px solid #ddd; 
    }

    .info-item {
        display: flex;
        flex-direction: column;
        font-size: 12px; 
        color: #555;
        margin-bottom: 8px;
    }

    .profile-section {
        margin-top: 20px;
    }

    .profile-picture {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    .profile-icon {
        font-size: 30px;
        color: grey;
    }

    .profile-username {
        font-size: 12px;
        color: #333;
    }

    .chat-button {
        display: flex;
        align-items: center;
        font-size: 12px;
        transition: color 0.3s, border-color 0.3s;
    }

    .chat-button:hover {
        color: #4A4AC4 !important; 
        border-color: #4A4AC4 !important; 
    }
</style>
@endsection
