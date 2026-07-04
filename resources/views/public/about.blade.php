@extends('public.layouts.public')

@section('content')

    @include('public.partials.navbar')

    <main class="about-page">

        <section class="about-hero">
            <div class="about-hero-overlay"></div>

            <div class="about-hero-content">
                <div class="hero-stripe">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <h1>ABOUT LEONA TRANS</h1>

                <p>
                    Delivering premium car rental experiences since inception.
                    We combine luxury vehicles with professional service to make every journey extraordinary.
                </p>
            </div>
        </section>

        <section class="about-story-section">
            <div class="about-narrow-container">

                <div class="section-title-row">
                    <div class="section-side-stripe">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div>
                        <h2>OUR STORY</h2>
                    </div>
                </div>

                <div class="about-story-text">
                    <p>
                        Leona Trans was founded with a singular vision: to redefine the premium car rental
                        experience in Indonesia. We recognized a gap in the market for truly exceptional service
                        combined with the world's finest vehicles.
                    </p>

                    <p>
                        Our journey began with a carefully curated fleet of luxury and performance vehicles,
                        each selected for its exceptional engineering, design, and capability. We believe that
                        the vehicle you drive is an extension of your personality and ambitions.
                    </p>

                    <p>
                        Today, we continue to expand our collection while maintaining our unwavering commitment
                        to quality, service, and customer satisfaction. Every member of our team shares a passion
                        for automotive excellence and a dedication to making your experience seamless.
                    </p>
                </div>

            </div>
        </section>

        <section class="vision-mission-section">
            <div class="about-card-container">

                <div class="about-vm-grid">

                    <article class="about-vm-card">
                        <div class="detail-m-stripe"></div>

                        <h3>OUR VISION</h3>

                        <p>
                            To be Indonesia's most trusted and respected premium car rental service,
                            recognized for our exceptional fleet, uncompromising standards,
                            and dedication to customer excellence.
                        </p>
                    </article>

                    <article class="about-vm-card">
                        <div class="detail-m-stripe"></div>

                        <h3>OUR MISSION</h3>

                        <p>
                            To provide access to the world's finest vehicles with professional service
                            that exceeds expectations, making luxury automotive experiences accessible
                            for business, celebration, and adventure.
                        </p>
                    </article>

                </div>

            </div>
        </section>

        <section class="about-values-section">
            <div class="public-container">

                <div class="section-title-row">
                    <div class="section-side-stripe">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div>
                        <h2>OUR VALUES</h2>
                        <p>The principles that guide us</p>
                    </div>
                </div>

                <div class="values-grid">

                    <article class="value-card">
                        <div class="why-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>

                        <h3>TRUST & RELIABILITY</h3>

                        <p>
                            Building lasting relationships through consistent quality
                            and professional service
                        </p>
                    </article>

                    <article class="value-card">
                        <div class="why-icon">
                            <i class="fa-solid fa-award"></i>
                        </div>

                        <h3>EXCELLENCE</h3>

                        <p>
                            Maintaining the highest standards in vehicle quality
                            and customer experience
                        </p>
                    </article>

                    <article class="value-card">
                        <div class="why-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <h3>CUSTOMER FOCUS</h3>

                        <p>
                            Your satisfaction and safety are our top priorities
                            in every journey
                        </p>
                    </article>

                </div>

            </div>
        </section>

        <section class="fleet-quality-section">
            <div class="about-narrow-container">

                <div class="section-title-row">
                    <div class="section-side-stripe">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div>
                        <h2>FLEET QUALITY</h2>
                    </div>
                </div>

                <div class="fleet-quality-card">

                    <p class="fleet-quality-intro">
                        Every vehicle in our fleet undergoes rigorous inspection and maintenance protocols.
                        We partner with authorized service centers to ensure each car meets manufacturer
                        specifications and our exacting standards.
                    </p>

                    <div class="quality-list">

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Premium fleet maintained to manufacturer standards</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Comprehensive insurance coverage included</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>24/7 customer support and roadside assistance</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Transparent pricing with no hidden fees</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Professional and experienced team</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Regular vehicle maintenance and inspection</span>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <section class="about-cta-section">
            <div class="public-container">

                <div class="about-cta-box">
                    <div class="hero-stripe cta-stripe">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <h2>EXPERIENCE THE DIFFERENCE</h2>

                    <p>
                        Discover why discerning clients choose Leona Trans
                        for their premium car rental needs.
                    </p>
                </div>

            </div>
        </section>

    </main>

    @include('public.partials.footer')

@endsection
