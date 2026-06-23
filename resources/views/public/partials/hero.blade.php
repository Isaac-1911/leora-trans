<section
    class="relative min-h-screen overflow-hidden"
>

    {{-- Background --}}
    <img
        src="{{ asset('images/hero.jpg') }}"
        alt=""
        class="absolute inset-0 h-full w-full object-cover"
    >

    {{-- Overlay --}}
    <div
        class="absolute inset-0 bg-black/65"
    ></div>

    {{-- Content --}}
    <div
        class="relative z-10 min-h-screen flex items-center justify-center text-center px-6"
    >

        <div class="max-w-5xl">

            {{-- BMW Stripe --}}
            <div class="flex justify-center mb-8">

                <div class="w-7 h-1 bg-[#0066b1]"></div>
                <div class="w-7 h-1 bg-[#1c69d4]"></div>
                <div class="w-7 h-1 bg-[#e22718]"></div>

            </div>

            {{-- Heading --}}
            <h1
                class="
                text-6xl
                md:text-7xl
                xl:text-8xl
                font-extrabold
                uppercase
                leading-none
                "
            >
                PREMIUM CAR RENTAL
                <br>
                EXPERIENCE
            </h1>

            {{-- Subtitle --}}
            <p
                class="
                mt-8
                text-lg
                md:text-xl
                text-zinc-300
                max-w-3xl
                mx-auto
                "
            >
                Drive the extraordinary. Our collection of premium vehicles
                delivers comfort, performance, and prestige for every journey.
            </p>

            {{-- Buttons --}}
            <div
                class="flex flex-col sm:flex-row justify-center gap-4 mt-10"
            >

                <a
                    href="#cars"
                    class="
                    bg-white
                    text-black
                    px-10
                    py-4
                    uppercase
                    tracking-[1.5px]
                    font-bold
                    "
                >
                    Explore Cars
                </a>

                <a
                    href="#booking"
                    class="
                    border
                    border-white
                    px-10
                    py-4
                    uppercase
                    tracking-[1.5px]
                    font-bold
                    "
                >
                    Book Now
                </a>

            </div>

        </div>

    </div>

</section>
