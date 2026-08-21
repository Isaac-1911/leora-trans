@extends('public.layouts.public')

@section('content')
    @include('public.partials.navbar')

    <main class="contact-page">

        <section class="contact-section">
            <div class="public-container">

                <div class="contact-layout">

                    {{-- LEFT --}}
                    <div class="contact-left">

                        <div class="contact-form-card">
                            <h2>APA YANG BISA KAMI BANTU?</h2>

                            <form id="contactForm">

                                <div class="contact-form-grid">

                                    <div class="form-group">
                                        <label>NAMA LENGKAP</label>

                                        <input type="text" id="name" name="name" placeholder="Nama anda" required>
                                    </div>

                                    <div class="form-group">
                                        <label>ALAMAT EMAIL</label>

                                        <input type="email" id="email" name="email" placeholder="anda@email.com"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label>NOMOR HP</label>

                                        <input type="text" id="phone" name="phone" placeholder="+62 81234567890"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label>SUBJEK</label>

                                        <input type="text" id="subject" name="subject"
                                            placeholder="Apa yang bisa kami bantu?" required>
                                    </div>

                                </div>

                                <div class="form-group" style="padding-top: 20px">
                                    <label>PESAN</label>

                                    <textarea id="message" name="message" placeholder="Beri tahu kami tentang kebutuhan anda..." required></textarea>
                                </div>

                                <button type="submit" class="contact-submit-btn">
                                    <i class="fa-regular fa-paper-plane"></i>
                                    KIRIM PESAN
                                </button>

                            </form>
                        </div>

                        <div class="location-card">
                            <h2>OUR LOCATION</h2>

                            <div class="map-container">

                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2673.213388282019!2d113.71868670282804!3d-8.175978831858822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695d36a97d3d3%3A0x9e61351069cb89d0!2sUniversitas%20Muhammadiyah%20Jember!5e0!3m2!1sid!2sid!4v1783179523958!5m2!1sid!2sid"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="strict-origin-when-cross-origin"></iframe>

                            </div>
                        </div>

                    </div>

                    {{-- RIGHT --}}
                    <aside class="contact-right">

                        <div class="quick-contact-card">
                            <div class="quick-stripe">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                            <h2>KONTAK CEPAT</h2>

                            <p>
                                Butuh bantuan secepatnya? Hubungi kami melalui whatsapp untuk respon yang lebih cepat.
                            </p>

                            <a href="https://wa.me/6281337522373" target="_blank" class="quick-wa-btn">
                                WHATSAPP KAMI
                            </a>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-phone"></i>
                            </div>

                            <div>
                                <h3>NOMOR HP</h3>
                                <p>+62 812-3456-7890</p>
                                <p>+62 812-9876-5432</p>
                            </div>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <i class="fa-regular fa-envelope"></i>
                            </div>

                            <div>
                                <h3>EMAIL</h3>
                                <p>leonytranss@gmail.com</p>
                                <p>booking@leonytrans.com</p>
                            </div>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>

                            <div>
                                <h3>ALAMAT</h3>
                                <p>Jl. Sudirman No. 123</p>
                                <p>Jakarta Selatan, 12190</p>
                            </div>
                        </div>

                        <div class="contact-info-card">
                            <div class="contact-info-icon">
                                <i class="fa-regular fa-clock"></i>
                            </div>

                            <div>
                                <h3>JAM KERJA</h3>
                                <p>Senin - Jumat: 08:00 - 20:00</p>
                                <p>Sabtu - Minggu: 09:00 - 18:00</p>
                            </div>
                        </div>

                    </aside>

                </div>

            </div>
        </section>

    </main>

    @include('public.partials.footer')

    <script>
        const whatsappNumber = "6281234567890"; // Ganti dengan nomor admin

        document
            .getElementById("contactForm")
            .addEventListener("submit", function(e) {

                e.preventDefault();

                const name = document.getElementById("name").value.trim();
                const email = document.getElementById("email").value.trim();
                const phone = document.getElementById("phone").value.trim();
                const subject = document.getElementById("subject").value.trim();
                const message = document.getElementById("message").value.trim();

                if (!name || !email || !phone || !subject || !message) {
                    alert("Please complete all fields.");
                    return;
                }

                const text =
                    `Halo Admin Leony Bintang Trans,

Saya ingin menghubungi Leony Bintang Trans.

━━━━━━━━━━━━━━━━━━━━

Nama:
${name}

Email:
${email}

Nomor HP:
${phone}

Subject:
${subject}

Pesan:
${message}

━━━━━━━━━━━━━━━━━━━━

Mohon informasi lebih lanjut.

Terima kasih.`;

                const url =
                    `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(text)}`;

                window.open(url, "_blank");

            });
    </script>
@endsection
