<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            width: 100%;
            background: #fff;
            padding: 15px 20px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .logo {
            margin-right: auto;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            position: relative;
        }

        .logo:hover {
            color: #4A4AC4;
        }

        nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 35px;
        }

        nav a {
            color: #333;
            font-size: 20px;
            font-weight: 500;
            text-decoration: none;
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
            background: #0C0908;
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
            margin-left: 30px;
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
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            min-width: 160px;
        }

        .dropdown-content a {
            color: black;
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
        }

        main {
            flex: 1;
        }

        footer {
            width: 100%;
            background: #000;
            padding: 40px 0px;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: auto;
        }

        .footer-content {
            width: 100%;
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-description {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            max-width: 400px;
            text-align: justify;
            margin-right: 40px;
        }

        .footer-description img {
            height: 50px;
            margin-right: 35px;
            transition: color 0.4s ease;
        }

        .footer-description img:hover {
            filter: invert(44%) sepia(78%) saturate(2481%) hue-rotate(222deg) brightness(96%) contrast(106%);
        }

        .footer-section {
            flex: 1;
            min-width: 150px;
            padding: 10px;
        }

        .footer-section p {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .footer-section .city-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-section a {
            color: white;
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
            color: white;
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
    </style>
</head>
<body>
    <header>
        <div class="logo">
            Living HUB
        </div>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('dijual') }}">Dijual</a>
            <a href="{{ route('disewa') }}">Disewa</a>
            <a href="{{ route('simulasikpr') }}">Simulasi KPR</a>
            <button class="navbutton" role="button">Tambah Properti</button>
            <div class="dropdown">
                <i class='fa fa-user-circle' style='font-size:36px;'></i>
                <div class="dropdown-content">
                    <a href="#">Favorites</a>
                    <a href="#">Like</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer-description">
                <img src="/resources/logo.png" alt="Living HUB Logo">
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
</body>
</html>
