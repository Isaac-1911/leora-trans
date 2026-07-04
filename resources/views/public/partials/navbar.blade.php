<nav class="public-navbar">
    <div class="public-navbar-container">

        <a href="{{ route('home') }}" class="public-logo">
            <span class="public-logo-text">LEORA TRANS</span>

            <span class="public-logo-stripe">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <div class="public-nav-menu">
            <a href="{{ route('home') }}">HOME</a>
            <a href="{{ route('vehicles.index') }}">VEHICLES</a>
            <a href="{{ route('about') }}">ABOUT</a>
            <a href="{{ route('contact') }}">CONTACT</a>

            <a href="#booking" class="public-nav-button">
                BOOK NOW
            </a>
        </div>

    </div>
</nav>
