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
            margin-right: 20px; 
        }

        .logo img {
            width: 90px;
            height: auto;
        }

        .nav-routes {
            display: flex;
            align-items: center;
            background-color: white; 
            padding: 5px 15px;
            border-radius: 20px; 
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
            margin-left: 20px; 
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
            font-size: 20px;
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
            border-radius: 8px; 
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

        .dropdown-content a i.right-icon {
            margin-left: auto;
            font-size: 14px;
        }

        .dropdown-content a:hover i {
            color: #4A4AC4;
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
            border-radius: 8px; 
        }

        .logout-btn i {
            margin-right: 10px;
            color: #ABB0B4;
            transition: color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #EFF3FF;
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
            font-size: 12px;
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

        .fa.fa-twitter::before{
            content:"𝕏";
            font-size:1.2em;
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
            text-align: center;
        }

        .search-popup h1 {
            color: #fff;
            font-size: 45px; 
            font-weight: bold;
            margin-bottom: 5px;
        }


        .search-input-container {
            margin-top: 10px; 
            display: inline-block;
            width: 100%;
            max-width: 800px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 10px 20px 10px 50px; 
            border-radius: 30px !important; 
            border: none;
            background-color: white; 
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.15); 
            font-size: 14px; 
        }

        .search-icon-input {
            position: absolute;
            left: 20px; 
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem; 
            color: #888;
        }

        .search-popup input[type="text"] {
            padding-left: 40px; 
        }

        .search-popup-close {
            position: absolute;
            top: 15px; 
            right: 15px; 
            font-size: 24px; 
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

        .input-group {
            position: relative;
            display: inline-block;
            width: 100%; 
        }

        .search-input:focus {
            outline: none;
        }

        .search-submit-button {
            display: none; 
        }

        .search-keywords {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 15px; 
        }

        .search-keyword {
            background-color: #f0f0f0;
            border-radius: 20px; 
            padding: 8px 20px; 
            margin: 5px; 
            cursor: pointer;
            font-size: 14px; 
            font-weight: bold;   
            transition: background-color 0.3s, transform 0.2s; 
        }

        .search-keyword:hover {
            transform: scale(1.05); 
            background-color: #4A4AC4;
            color: #ffffff;
        }

   
    </style>
        @yield('styles')
    </head>
    <body>
        @yield('navbar')


<div class="search-popup">
    <div class="search-popup-content">
        <button class="search-popup-close" onclick="closeSearchPopup()">&times;</button>
        <h1>Apa yang Anda cari?</h1>
        <div class="search-input-container">
            <form action="{{ route('search') }}" method="GET" class="input-group">
                <i class="fa fa-search search-icon-input"></i>   
                <input type="text" name="search" placeholder="Cari Properti..." class="search-input" />
                <button type="submit" class="search-submit-button" style="display: none;"></button>
            </form>
        </div>
        <div class="search-keywords">
            <!-- Keywords will be dynamically inserted here -->
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
            <a href="https://www.instagram.com/liv_hub/" target="_blank">
                <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            <a href="https://www.facebook.com/LivvHub/" target="_blank">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
            </a>

            <a href="https://x.com/liv_hub/" target="_blank">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Living HUB. All rights reserved.</p>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const keywordsList = [
            'Rumah mewah', 'Rumah asri', 'Apartemen murah', 'Ruko disewa',
            'Tanah dijual', 'Rumah strategis', 'Apartemen dijual', 'Ruko minimalis',
            'Rumah cluster', 'Villa disewa', 'Kost murah', 'Kavling strategis',
            'Tanah murah', 'Rumah klasik', 'Ruko produktif', 'Apartemen premium',
            'Rumah luas', 'Kost eksklusif', 'Ruko ramai', 'Tanah strategis'
        ];

        function getRandomKeywords(count) {
            const shuffled = [...keywordsList].sort(() => 0.5 - Math.random());
            return shuffled.slice(0, count);
        }

        function generateKeywords() {
            const keywordsContainer = document.querySelector('.search-keywords');
            if (!keywordsContainer) {
                console.error('Keywords container not found');
                return;
            }
            const keywords = getRandomKeywords(5);
            
            keywordsContainer.innerHTML = '';
            keywords.forEach(keyword => {
                const keywordElement = document.createElement('div');
                keywordElement.className = 'search-keyword';
                keywordElement.textContent = keyword;
                keywordElement.addEventListener('click', () => performSearch(keyword));
                keywordsContainer.appendChild(keywordElement);
            });
        }

        function performSearch(keyword) {
            const searchInput = document.querySelector('.search-input');
            if (searchInput) {
                searchInput.value = keyword;
                const form = document.querySelector('form');
                if (form) {
                    form.submit();
                } else {
                    console.error('Search form not found');
                }
            } else {
                console.error('Search input not found');
            }
        }

        function openSearchPopup() {
            const searchPopup = document.querySelector('.search-popup');
            if (searchPopup) {
                searchPopup.classList.add('show');
                generateKeywords();
            } else {
                console.error('Search popup not found');
            }
        }

        function closeSearchPopup() {
            const searchPopup = document.querySelector('.search-popup');
            if (searchPopup) {
                searchPopup.classList.remove('show');
            } else {
                console.error('Search popup not found');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const searchIcon = document.querySelector('.search-icon');
            if (searchIcon) {
                searchIcon.addEventListener('click', openSearchPopup);
            } else {
                console.error('Search icon not found');
            }

            const closeButton = document.querySelector('.search-popup-close');
            if (closeButton) {
                closeButton.addEventListener('click', closeSearchPopup);
            } else {
                console.error('Close button not found');
            }

            // Generate keywords initially
            generateKeywords();
        });
    </script>
        @yield('scripts')
    </body>
</html>