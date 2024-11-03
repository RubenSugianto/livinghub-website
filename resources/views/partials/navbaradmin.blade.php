<header>
    <div class="navbar-container">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('LogooB.png') }}" alt="Logo">
        </a>
        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('admin.property') }}">Approve Property</a>
            <a href="{{ route('document.pending') }}">Approve Document</a>
            <!-- <button class="navbutton" role="button" onclick="location.href='{{ route('property.add') }}'">Tambah Properti</button> -->
        </nav>
        <!-- <div class="search-container">
            <i class="fa fa-search search-icon" aria-hidden="true" style="font-size: 20px; color: #000;" onclick="openSearchPopup()"></i>
        </div> -->
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
                <a href="{{ route('admin.property') }}"><i class="fa fa-check" aria-hidden="true"></i> Persetujuan Properti <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
                <a href="{{ route('document.pending') }}"><i class="fa fa-file" aria-hidden="true"></i> Persetujuan Dokumen <i class="fa fa-chevron-right right-icon" aria-hidden="true"></i></a>
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