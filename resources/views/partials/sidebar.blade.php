<aside class="w-64 bg-black border-r border-[#3c3c3c] sidebar">

    <div class="p-6 border-b border-[#3c3c3c]">

        <h1 class="text-2xl font-bold uppercase">
            Leora Trans
        </h1>

        <div class="flex mt-3 h-1">

            <div class="w-1/3 bg-[#0066b1]"></div>

            <div class="w-1/3 bg-[#1c69d4]"></div>

            <div class="w-1/3 bg-[#e22718]"></div>

        </div>

    </div>

    <nav class="py-6">

        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link flex items-center gap-3 px-6 py-4 text-sm uppercase tracking-wider hover:bg-[#1a1a1a]
        {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

            <i class="fa-solid fa-table-columns"></i>

            <span>DASHBOARD</span>

        </a>

        <a href="{{ route('admin.cars.index') }}"
            class="sidebar-link flex items-center gap-3 px-6 py-4 text-sm uppercase tracking-wider hover:bg-[#1a1a1a]
        {{ request()->routeIs('admin.cars.*') ? 'active' : '' }}">

            <i class="fa-solid fa-car-side"></i>

            <span>CARS</span>

        </a>

        <a href="{{ route('admin.bookings.index') }}"
            class="sidebar-link flex items-center gap-3 px-6 py-4 text-sm uppercase tracking-wider hover:bg-[#1a1a1a]
        {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">

            <i class="fa-regular fa-calendar-check"></i>

            <span>BOOKINGS</span>

        </a>

        <a href="{{ route('admin.payments.index') }}"
            class="sidebar-link flex items-center gap-3 px-6 py-4 text-sm uppercase tracking-wider hover:bg-[#1a1a1a]
        {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">

            <i class="fa-regular fa-credit-card"></i>

            <span>PAYMENTS</span>

        </a>

        <a href="{{ route('admin.reports.index') }}"
            class="sidebar-link flex items-center gap-3 px-6 py-4 text-sm uppercase tracking-wider hover:bg-[#1a1a1a]
        {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">

            <i class="fa-solid fa-chart-column"></i>

            <span>REPORTS</span>

        </a>

        {{-- <a href="#"
            class="sidebar-link flex items-center gap-3 px-6 py-4 text-sm uppercase tracking-wider hover:bg-[#1a1a1a]">

            <i class="fa-solid fa-gear"></i>

            <span>SETTINGS</span>

        </a> --}}

    </nav>

</aside>
