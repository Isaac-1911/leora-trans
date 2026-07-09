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

                <h1>TENTANG LEONI TRANS</h1>

                <p>
                    Melayani kebutuhan sewa mobil dengan kendaraan yang terawat, harga yang transparan, dan pelayanan
                    profesional. Kami siap menjadi partner perjalanan Anda untuk berbagai keperluan.
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
                        <h2>CERITA KAMI</h2>
                    </div>
                </div>

                <div class="about-story-text">
                    <p>
                        Leora Trans hadir sebagai penyedia jasa rental mobil yang berkomitmen memberikan layanan
                        transportasi yang aman, nyaman, dan terpercaya. Kami memahami bahwa setiap perjalanan memiliki
                        tujuan yang penting, sehingga kami selalu berusaha memberikan kendaraan terbaik dengan pelayanan
                        yang maksimal.
                    </p>

                    <p>
                        Sejak berdiri, kami terus mengembangkan armada serta meningkatkan kualitas pelayanan agar dapat
                        memenuhi kebutuhan pelanggan, baik untuk perjalanan pribadi, keluarga, wisata, maupun perjalanan
                        dinas.
                    </p>

                    <p>
                        Dengan mengutamakan kepuasan pelanggan, kami percaya bahwa pelayanan yang jujur, ramah, dan
                        profesional merupakan kunci untuk membangun hubungan jangka panjang dengan setiap pelanggan.
                    </p>
                </div>

            </div>
        </section>

        <section class="vision-mission-section">
            <div class="about-card-container">

                <div class="about-vm-grid">

                    <article class="about-vm-card">
                        <div class="detail-m-stripe"></div>

                        <h3>VISI KAMI</h3>

                        <p>
                            Menjadi perusahaan rental mobil terpercaya di Indonesia yang dikenal melalui pelayanan
                            profesional, armada berkualitas, serta kepuasan pelanggan.
                        </p>
                    </article>

                    <article class="about-vm-card">
                        <div class="detail-m-stripe"></div>

                        <h3>MISI KAMI</h3>

                        <div class="about-item">
                            <i class="fa-solid fa-angle-right"></i>
                            <p>Menyediakan armada aman, dan selalu dalam kondisi prima.</p>
                        </div>

                        <div class="about-item">
                            <i class="fa-solid fa-angle-right"></i>
                            <p>Memberikan pelayanan yang cepat, ramah, dan profesional</p>
                        </div>

                        <div class="about-item">
                            <i class="fa-solid fa-angle-right"></i>
                            <p>Menawarkan harga yang transparan tanpa biaya tersembunyi.</p>
                        </div>

                        <div class="about-item">
                            <i class="fa-solid fa-angle-right"></i>
                            <p>Membangun hubungan jangka panjang dengan pelanggan melalui kepercayaan dan kualitas layanan.
                            </p>
                        </div>


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
                        <h2>NILAI-NILAI KAMI</h2>
                        <p>Prinsip yang kami junjung</p>
                    </div>
                </div>

                <div class="values-grid">

                    <article class="value-card">
                        <div class="why-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>

                        <h3>KEPERCAYAAN & KEANDALAN</h3>

                        <p>
                            Kami selalu mengutamakan kejujuran, ketepatan waktu, dan pelayanan yang dapat diandalkan
                            sehingga pelanggan merasa aman dalam setiap transaksi.
                        </p>
                    </article>

                    <article class="value-card">
                        <div class="why-icon">
                            <i class="fa-solid fa-award"></i>
                        </div>

                        <h3>PELAYANAN TERBAIK</h3>

                        <p>
                            Kami berkomitmen memberikan pelayanan yang cepat, ramah, dan profesional untuk memastikan
                            pengalaman sewa mobil yang nyaman.
                        </p>
                    </article>

                    <article class="value-card">
                        <div class="why-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <h3>KEPUASAN PELANGGAN</h3>

                        <p>

                            Kebutuhan dan kenyamanan pelanggan menjadi prioritas utama kami. Setiap masukan menjadi motivasi
                            untuk terus meningkatkan kualitas layanan.
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
                        <h2>KUALITAS ARMADA</h2>
                    </div>
                </div>

                <div class="fleet-quality-card">

                    <p class="fleet-quality-intro">
                        Seluruh kendaraan di Leora Trans menjalani pemeriksaan dan perawatan secara berkala agar selalu siap digunakan. Kami memastikan setiap armada dalam kondisi bersih, aman, dan nyaman sehingga pelanggan dapat menikmati perjalanan tanpa rasa khawatir.
                    </p>

                    <div class="quality-list">

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span> Kendaraan selalu dirawat secara berkala.
</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Kendaraan bersih dan siap digunakan.</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Harga sewa transparan tanpa biaya tersembunyi.</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Pelayanan pelanggan yang responsif.</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Tim yang profesional dan berpengalaman.</span>
                        </div>

                        <div class="quality-item">
                            <i class="fa-regular fa-circle-check"></i>
                            <span>Keamanan serta kenyamanan pelanggan menjadi prioritas.</span>
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

                    <h2>RASAKAN PERBEDAAN BERSAMA LEONI TRANS</h2>

                    <p>
                        Nikmati pengalaman sewa mobil yang nyaman, aman, dan terpercaya. Temukan armada terbaik kami untuk menemani setiap perjalanan Anda.
                    </p>
                </div>

            </div>
        </section>

    </main>

    @include('public.partials.footer')
@endsection
