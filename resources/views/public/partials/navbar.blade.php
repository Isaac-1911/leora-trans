<nav class="public-navbar">
    <div class="public-navbar-container">

        <a href="{{ route('home') }}" class="public-logo">
            <span class="public-logo-text">LEONY BINTANG TRANS</span>

            <span class="public-logo-stripe">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <div class="public-nav-menu">
            <a href="{{ route('home') }}">BERANDA</a>
            <a href="{{ route('vehicles.index') }}">KENDARAAN</a>
            <a href="{{ route('about') }}">TENTANG</a>
            <a href="{{ route('contact') }}">KONTAK</a>
        </div>

    </div>
</nav>
