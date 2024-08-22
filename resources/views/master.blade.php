<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: whitesmoke;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    padding-top: 70px;
}

header {
    position: fixed;
    top: 10px;
    left: 0;
    width: 100%;
    z-index: 1000;
}

.navbar-container {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(10px);
    padding: 5px 10px;
    box-shadow: rgba(0, 0, 0, 0.1) 0 5px 15px;
    border-radius: 20px;
    margin: 0 10px;
}

.navbar-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.logo {
    display: flex;
    align-items: center;
    margin-right: 20px; /* Add some space between the logo and the routes */
}

.logo img {
    width: 70px;
    height: auto;
}

.nav-routes {
    display: flex;
    align-items: center;
    background-color: white; /* Single white background for routes */
    padding: 5px 15px;
    border-radius: 20px; /* Rounded corners for the white background */
    box-shadow: rgba(0, 0, 0, 0.1) 0 5px 10px;
}

nav {
    display: flex;
    align-items: center;
    gap: 15px;
    flex: 1;
    justify-content: center;
}

nav a {
    color: #000000 !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    padding: 5px 10px !important;
    position: relative !important;
    transition: color 0.3s ease !important;
    background-color: transparent !important;
    border-radius: 12px;
}

nav a:before {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 50%;
    height: 2px;
    width: 0;
    background: #4A4AC4;
    border-radius: 12px;
    transition: width 0.4s ease;
    transform: translateX(-50%);
}

nav a:hover:before {
    width: 100%;
}

.navbutton {
    background: #5E5DF0;
    color: #ffffff;
    border-radius: 999px;
    box-shadow: rgba(0, 0, 0, 0.1) 0 5px 10px;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 10px;
    border: none;
    cursor: pointer;
    margin-left: 20px; /* Add some space between the routes and the button */
    transition: background 0.3s ease;
}

.navbutton:hover {
    background: #4A4AC4;
}

.dropdown {
    position: relative;
    margin-left: 15px;
}

.dropdown i {
    cursor: pointer;
    color: #000000;
    font-size: 18px;
    padding: 5px;
    border-radius: 999px;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: white;
    color: #333333;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    z-index: 1;
    min-width: 280px;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.dropdown:hover .dropdown-content {
    display: block;
}
.auth-text {
    color: #333;
    padding: 15px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: #ffffff;
}

.auth-text img {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    object-fit: cover;
    background-color: #ffffff;
    margin-right: 10px;
}

.username {
    font-size: 16px;
}

.dropdown-content a {
    color: #333;
    padding: 12px 20px;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-weight: 500;
    font-size: 14px;
    text-align: left;
    width: 100%;
}

.dropdown-content a:hover {
    background-color: #EFF3FF;
    color: #4A4AC4;
}

.dropdown-content a i {
    margin-right: 10px;
    color: #ABB0B4;
    transition: color 0.3s ease;
}

.dropdown-content a:hover i {
    color: #4A4AC4;
}

.dropdown-content a i.right-icon {
    margin-left: auto;
}

.logout-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 12px 20px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    text-align: left;
    color: #333;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.logout-btn i {
    margin-right: 10px;
    color: #ABB0B4;
    transition: color 0.3s ease;
}

.logout-btn:hover {
    background-color: #EFF3FF;
    border-radius: 8px;
    color: #4A4AC4;
}

.logout-btn:hover i {
    color: #4A4AC4;
}

.logout-btn .right-icon {
    margin-left: auto;
}


        main {
            margin-top: 50px;
            flex: 1;
            padding: 20px;
        }

        footer {
            width: 100%;
            background: #000;
            padding: 15px 0;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: auto;
            font-size: 10px;
        }

        .footer-content {
            width: 100%;
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .footer-description {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            max-width: 300px;
            text-align: justify;
            margin-top: 10px;
            margin-right: 50px;
        }

        .footer-description img {
            height: 60px;
            margin-right: 0;
            margin-bottom: 10px;
            transition: color 0.4s ease;
        }

        .footer-section {
            flex: 1;
            min-width: 100px;
            padding: 10px;
            margin-top: 10px;
        }

        .footer-section p {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .footer-section .city-links {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .footer-section a {
            color: #fff;
            text-decoration: none;
            position: relative;
            padding: 2px 0;
        }

        .footer-section a:before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            height: 2px;
            width: 0;
            background: #4A4AC4;
            border-radius: 12px;
            transition: all 0.4s ease;
        }

        .footer-section a:hover:before {
            width: 100%;
        }

        .social-icons {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .social-icons i {
            font-size: 24px;
            color: #fff;
            transition: color 0.4s ease;
        }

        .social-icons i:hover {
            color: #4A4AC4;
        }

        .footer-bottom {
            width: 100%;
            border-top: 1px solid #444;
            padding-top: 10px;
            text-align: center;
            margin-top: 15px;
        }
 
        .search-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9); 
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 20px;
            overflow-y: auto;
        }

        .search-popup-content {
            text-align: center;
            width: 100%;
            max-width: 80%;
            margin: auto;
        }

        .search-popup h1 {
            color: #fff;
            font-size: 40px; 
            font-weight: bold;
            margin-bottom: 30px;
        }


        .search-input-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .search-input {
            width: 50%;
            padding: 15px;
            font-size: 18px;
            border-radius: 40px; 
            border: none;
            background-color: #fff;
            color: #333;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); 
        }

        .search-icon-input {
            position: relative;
            left: 35px; 
            font-size: 20px;
            color: #333;
        }

        .search-popup input[type="text"] {
            padding-left: 40px; 
        }

        .search-popup-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            cursor: pointer;
            color: #fff;
            background: none;
            border: none; 
        }


        .search-popup.show {
            display: flex;
            opacity: 1;
            transition: opacity 0.3s ease;
        }
        

</style>
        @yield('styles')
        </head>
        <body>
        <header>
    <div class="navbar-container">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('LogooB.png') }}" alt="Logo">
        </a>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('dijual') }}">Dijual</a>
            <a href="{{ route('disewa') }}">Disewa</a>
            <a href="{{ route('simulasikpr') }}">Simulasi KPR</a>
            <button class="navbutton" role="button" onclick="location.href='{{ route('property.add') }}'">Tambah Properti</button>
        </nav>
        <div class="search-container">
        <i class="fa fa-search search-icon" aria-hidden="true" style="font-size: 20px; color: #000;" onclick="openSearchPopup()"></i>
        </div>
        <div class="dropdown">
            <i class="fa fa-bars" style='font-size:25px;'></i>
            <div class="dropdown-content">
                <div class="auth-text">
                    @auth
                        @if(auth()->user()->profilepicture)
                        <img id="dropdownProfilePicture" src="{{ asset('storage/' . auth()->user()->profilepicture) }}" alt="Profile Picture">
                        @else
                        <i class="fa fa-user-o" style="font-size: 20px; color: grey;"></i>
                        @endif
                        <div class="username">{{ auth()->user()->username }}</div>
                    @else
                        <i class="fa fa-user-o" style="font-size: 20px; color: grey;"></i>
                        <div class="username">Guest</div>
                    @endauth
                </div>
                <a href="/lihatprofile"><i class="fa fa-cog" aria-hidden="true"></i> My Profile <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                <a href="/myproperties"><i class="fa fa-home" aria-hidden="true"></i> My Property <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                <a href="/favorites"><i class="fa fa-bookmark" aria-hidden="true"></i> Favorites <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> Like <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                @auth
                <form action="/logout" method="post" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></button>
                </form>
                @else
                <a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i> Login <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                @endauth
            </div>
        </div>
    </div>
</header>

<div class="search-popup">
    <div class="search-popup-content">
        <button class="search-popup-close" onclick="closeSearchPopup()">&times;</button>
        <h1>What are you looking for?</h1>
        <div class="search-input-container">
            <i class="fa fa-search search-icon-input"></i>   
            <input type="text" placeholder="Search..." class="search-input">
        </div>
    </div>
</div>
            @yield('content')
        </main>
        <footer>
            <div class="footer-content">
                <div class="footer-description">
                <img src="{{ asset('Logoo.png') }}" alt="Logo">
                    <p>Living HUB merupakan platform jual, beli dan sewa properti terkemuka di Indonesia yang memberikan layanan kepada pengguna sejak 2024. Living HUB berkomitmen menjadikan pengalaman jual beli properti Anda semudah mungkin dengan fitur-fitur yang kami sediakan.</p>
                </div>
                <div class="footer-section">
                    <p>Jakarta</p>
                    <div class="city-links">
                        <a href="{{ route('search', ['kota' => 'Jakarta Pusat']) }}">Jakarta Pusat</a>
                        <a href="{{ route('search', ['kota' => 'Jakarta Utara']) }}">Jakarta Utara</a>
                        <a href="{{ route('search', ['kota' => 'Jakarta Barat']) }}">Jakarta Barat</a>
                        <a href="{{ route('search', ['kota' => 'Jakarta Selatan']) }}">Jakarta Selatan</a>
                        <a href="{{ route('search', ['kota' => 'Jakarta Timur']) }}">Jakarta Timur</a>
                    </div>
                </div>
                <div class="footer-section">
                    <p>Bogor</p>
                    <div class="city-links">
                        <a href="{{ route('search', ['kota' => 'Kota Bogor']) }}">Kota Bogor</a>
                        <a href="{{ route('search', ['kota' => 'Kabupaten Bogor']) }}">Kabupaten Bogor</a>
                    </div>
                </div>
                <div class="footer-section">
                    <p>Depok</p>
                    <div class="city-links">
                        <a href="{{ route('search', ['kota' => 'Kota Depok']) }}">Kota Depok</a>
                    </div>
                </div>
                <div class="footer-section">
                    <p>Tangerang</p>
                    <div class="city-links">
                        <a href="{{ route('search', ['kota' => 'Kota Tangerang']) }}">Kota Tangerang</a>
                        <a href="{{ route('search', ['kota' => 'Kota Tangerang Selatan']) }}">Kota Tangerang Selatan</a>
                        <a href="{{ route('search', ['kota' => 'Kabupaten Tangerang']) }}">Kabupaten Tangerang</a>
                    </div>
                </div>
                <div class="footer-section">
                    <p>Bekasi</p>
                    <div class="city-links">
                        <a href="{{ route('search', ['kota' => 'Kota Bekasi']) }}">Kota Bekasi</a>
                        <a href="{{ route('search', ['kota' => 'Kabupaten Bekasi']) }}">Kabupaten Bekasi</a>
                    </div>
                </div>
            </div>
            <div class="social-icons">
                <i class="fa fa-instagram" aria-hidden="true"></i>
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Living HUB. All rights reserved.</p>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script>
function openSearchPopup() {
    document.querySelector('.search-popup').classList.add('show');
}

function closeSearchPopup() {
    document.querySelector('.search-popup').classList.remove('show');
}


</script>

    @yield('scripts')
</body>
</html>