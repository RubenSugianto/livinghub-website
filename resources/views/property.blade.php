@extends('master') 

@section('title', 'Detail Properti') 

@section('content') 
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <a href="javascript:history.back()" class="back-button">
            <i class="fa fa-angle-left" aria-hidden="true"></i> Kembali
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
                            <strong>{{ $comment->user_name }}</strong>
                        </div>
                        <p>{{ $comment->comment }}</p>
                        <small>{{ $comment->created_at->format('d F Y') }}</small>
                    </div>
                @endforeach

                <hr>

                @auth
                    <h4>Tambahkan Komentar</h4>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <div class="comment-input d-flex align-items-center">
                            @if(Auth::user()->profilepicture)
                                <img src="{{ asset('storage/' . Auth::user()->profilepicture) }}" alt="Profile Picture" class="profile-picture" />
                            @else
                                <i class="fa fa-user-o profile-icon" aria-hidden="true"></i>
                            @endif
                            <strong class="ml-2">{{ Auth::user()->username }}</strong>
                        </div>

                        <div class="comment-input">
                            <textarea id="commentTextarea" name="comment" placeholder="Tulis komentar..."></textarea>
                            <small id="wordCount" class="word-counter">0/200 characters</small>
                        </div>
                        <button type="submit" id="submitButton">Komen</button>
                    </form>
                @else
                    <p>Silahkan <a href="{{ route('login') }}">Login</a> untuk menambahkan komentar.</p>
                @endauth
            </div>

           <script>
            document.addEventListener("DOMContentLoaded", function() {
                const textarea = document.getElementById("commentTextarea");
                const wordCount = document.getElementById("wordCount");  
                const submitButton = document.getElementById("submitButton");

            textarea.addEventListener("input", function() {
            let text = this.value;

            if (text.length > 200) {
                text = text.substring(0, 200);
                textarea.value = text;
            }

            wordCount.innerText = `${text.length}/200 characters`;

            submitButton.disabled = text.length > 200;
        });
    });
        </script>

        </div>
    </div>
</div>
<style>


.profile-section {
    margin: 20px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.profile-picture, .comment-profile-picture {
    width: 35px;
    height: 35px;
    border-radius: 50%;
}

.profile-icon {
    font-size: 30px;
    color: #777;
}

.profile-username {
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-left: 10px;
}

.chat-button {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #333;
    border: 1px solid #ccc;
    padding: 5px 10px;
    border-radius: 8px;
    transition: color 0.3s, border-color 0.3s;
}

.chat-button:hover {
    color: #4A4AC4;
    border-color: #4A4AC4;
}

.comment {
    margin-top: 30px;
    max-width: 100%;
    word-wrap: break-word; 
    overflow-wrap: break-word; 
}

.comment-header {
    display: flex;
    align-items: center;
}

.comment-header img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin-right: 0.75rem;
}

.comment-header strong {
    font-size: 15px;
    color: #333;
    font-weight: bold;
}

.comment p {
    font-size: 13px;
    color: #555;
    margin: 0.375rem 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.comment small {
    font-size: 0.75rem;
    color: #aaa;
}

.comment-input {
    position: relative; 
    display: flex;
    align-items: flex-start;
    margin-bottom: 0.625rem;
}

textarea[name="comment"] {
    width: 100%;
    height: 150px;
    border: 1px solid #ccc;
    border-radius: 12px;
    padding: 0.625rem;
    font-size: 0.9375rem;
    resize: none;
    outline: none;
    padding-right: 70px; 
    padding-bottom: 40px; 
}

textarea[name="comment"]::placeholder {
    color: #bbb;
}

.word-counter {
    position: absolute;
    bottom: 10px;
    right: 20px;
    font-size: 0.75rem;
    color: #bbb;
    background-color: white;
    padding: 0 5px;
    pointer-events: none; 
}

button[type="submit"] {
    background-color: #777;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 0.625rem 1.25rem;
    font-size: 0.9375rem;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s ease-in-out;
    margin-top: 0.625rem;
}

button[type="submit"]:hover {
    background-color: #555;
    transform: translateY(-2px);
}

.tags-favorite {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
    
}
.like-favorite-buttons button {
    background-color: white;
    color: #dc3545;
    border: 2px solid #dc3545;
    padding: 10px 20px; 
    border-radius: 10px; 
    font-size: 16px; 
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease-in-out;
}

.like-favorite-buttons {
    display: flex;
    gap: 15px; 
}

.like-favorite-buttons button:hover {
    background-color: #dc3545;
    color: white;
    transform: translateY(-2px); 
}

.like-favorite-buttons button:focus, 
.like-favorite-buttons button:active {
    outline: none;
    box-shadow: 0 0 8px rgba(220, 53, 69, 0.6); 
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
    color: white;
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

.image-container {
    position: relative;
    max-height: 500px; 
    overflow: hidden;
    border-radius: 15px;
    margin-top: 30px;
}

.back-button {
    display: inline-flex;
    align-items: center;
    background-color: #6D757D;
    border-color: #6D757D;
    font-weight: bold;
    font-size: 16px;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
    text-decoration: none;
    cursor: pointer;
    border: none;
    margin-top: 30px;
}

.back-button i {
    margin-right: 10px;
    font-size: 18px;
    color: white;
}

.back-button:hover {
    background-color: #4A4AC4;
    border-color: #4A4AC4;
    color: white;
    text-decoration: none;
}

</style>
@endsection
