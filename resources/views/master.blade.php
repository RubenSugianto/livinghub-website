<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


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
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            position: fixed;
            top: 0px;
            width: 100%;
            background: #000; 
            padding: 10px 20px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            z-index: 1000; 
        }

        .logo img {
            width: 130px; 
            height: auto;
        }

        .logo:hover {
            color: #4A4AC4;
        }

        nav {
            display: flex;
            justify-content: flex-end; 
            align-items: center;
            gap: 35px;
        }

        nav a {
            color: #fff !important; 
            font-size: 20px;
            font-weight: 500;
            text-decoration: none !important;
            padding: 5px 0;
            margin: 0;
            position: relative;
        }

        nav a:before {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            height: 3px;
            width: 0;
            background: #4A4AC4; 
            border-radius: 12px;
            transition: all 0.4s ease;
            transform: translateX(-50%);
        }

        nav a:hover:before {
            width: 100%;
        }

        .navbutton {
            background: #5E5DF0;
            border-radius: 999px;
            box-shadow: #5E5DF0 0 10px 20px -10px;
            box-sizing: border-box;
            color: #FFFFFF;
            font-size: 16px;
            font-weight: 700;
            line-height: 24px;
            opacity: 1;
            outline: 0 solid transparent;
            padding: 8px 18px;
            width: fit-content;
            border: 0;
        }

        .navbutton:hover {
            background: #4A4AC4;
            box-shadow: #4A4AC4 0 10px 20px -10px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            color: #000;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            min-width: 160px;
        }

        .dropdown-content a {
            color: black !important;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .fa-user-circle {
            margin-left: 30px;
            cursor: pointer;
            color: #fff; 
        }

        main {
            margin-top: 80px; 
            flex: 1;
            padding: 20px;
        }

        footer {
            width: 100%;
            background: #000; 
            padding: 30px 0; 
            color: #fff; 
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: auto;
        }

        .footer-content {
            width: 100%;
            max-width: 2000px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 0 40px; 
        }

        .footer-description {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            max-width: 500px;
            text-align: justify;
            margin-top: 30px;
            margin-right: 100px;
        }

        .footer-description img {
            height: 100px;
            margin-right: 0;
            margin-bottom: 20px;
            transition: color 0.4s ease;
        }

        .footer-section {
            flex: 1;
            min-width: 150px;
            padding: 20px;
            margin-top: 20px; 
        }

        .footer-section p {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer-section .city-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
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
            gap: 30px;
            margin-top: 50px;
        }

        .social-icons i {
            font-size: 30px;
            color: #fff; 
            transition: color 0.4s ease;
        }

        .social-icons i:hover {
            color: #4A4AC4; 
        }

        .footer-bottom {
            width: 100%;
            border-top: 1px solid #444;
            padding-top: 20px;
            text-align: center;
            margin-top: 30px;
        }
        .full-width-rectangle {
            width: 102.1%;
            height: 350px;
            background-color: black;
            margin: -20px;
            padding: 0px; 
        }

        
    
    </style>
        @yield('styles')
</head>
<body>
    <header>
        <div class="footer-content">
            <a href="{{ route('home') }}" class="logo">
                <img src="Logoo.png" alt="Logo">
            </a>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('dijual') }}">Dijual</a>
                <a href="{{ route('disewa') }}">Disewa</a>
                <a href="{{ route('simulasikpr') }}">Simulasi KPR</a>
                <button class="navbutton" role="button" onclick="location.href='{{ route('property.add') }}'">Tambah Properti</button>
                <div class="dropdown">
                    <i class='fa fa-user-circle' style='font-size:36px;'></i>
                    <div class="dropdown-content">
                        <a href="#">Favorites</a>
                        <a href="#">Like</a>
                        @auth
                            <form action="/logout" method="post" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: black; padding: 12px 16px; width: 100%; text-align: left; cursor: pointer;">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="/login">Login</a>
                        @endauth
                    </div>
                </div>

                <!-- <div class="dropdown">
                    <i class='fa fa-user-circle' style='font-size:36px;'></i>
                    <div class="dropdown-content">
                        <a href="#">Favorites</a>
                        <a href="#">Like</a>
                        @auth
                            <a>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </a>
                        
                        @else
                            <a href="/login">Login</a>
                        @endauth
                    </div>
                </div> -->
                @auth
                    <div class="text-white">Welcome back, {{ auth()->user()->username }}</div>
                @endauth
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
        
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer-description">
            <img src="Logoo.png" alt="Logo">
                <p>Living HUB merupakan platform jual, beli dan sewa properti terkemuka di Indonesia yang memberikan layanan kepada pengguna sejak 2024. Living HUB berkomitmen menjadikan pengalaman jual beli properti Anda semudah mungkin dengan fitur-fitur yang kami sediakan.</p>
            </div>
            <div class="footer-section">
                <p>Jakarta</p>
                <div class="city-links">
                    <a href="#">Jakarta Pusat</a>
                    <a href="#">Jakarta Utara</a>
                    <a href="#">Jakarta Barat</a>
                    <a href="#">Jakarta Selatan</a>
                    <a href="#">Jakarta Timur</a>
                </div>
            </div>
            <div class="footer-section">
                <p>Bogor</p>
                <div class="city-links">
                    <a href="#">Kota Bogor</a>
                    <a href="#">Kabupaten Bogor</a>
                </div>
            </div>
            <div class="footer-section">
                <p>Depok</p>
                <div class="city-links">
                    <a href="#">Kota Depok</a>
                </div>
            </div>
            <div class="footer-section">
                <p>Tangerang</p>
                <div class="city-links">
                    <a href="#">Kota Tangerang</a>
                    <a href="#">Kota Tangerang Selatan</a>
                    <a href="#">Kabupaten Tangerang</a>
                </div>
            </div>
            <div class="footer-section">
                <p>Bekasi</p>
                <div class="city-links">
                    <a href="#">Kota Bekasi</a>
                    <a href="#">Kabupaten Bekasi</a>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>
