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
                    @if(Auth::user()->avatar)
                        <img id="dropdownProfilePicture" src="{{ Chatify::getUserWithAvatar(Auth::user())->avatar }}" alt="Profile Picture">
                    @else
                        <i class="fa fa-user-o" style="font-size: 20px; color: grey;"></i>
                    @endif
                        <div class="username">{{ auth::user()->username }}</div>
                    @else
                        <i class="fa fa-user-o" style="font-size: 20px; color: grey;"></i>
                        <div class="username">Guest</div>
                    @endauth
                </div>
                <a href="/lihatprofile"><i class="fa fa-cog" aria-hidden="true"></i> Profil  <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                <a href="/myproperties"><i class="fa fa-home" aria-hidden="true"></i> Properti <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                <a href="/favorites"><i class="fa fa-bookmark" aria-hidden="true"></i> Favorit <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                <a href="/likes"><i class="fa fa-heart" aria-hidden="true"></i> Like <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                <a href="/chatify"><i class="fa fa-commenting" aria-hidden="true"></i> Chat <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
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