<header class="h-16 border-b border-[#3c3c3c] flex items-center justify-between px-6">

    <div class="w-[400px]">

        {{-- <input
            type="text"
            placeholder="Search..."
            class="w-full bg-[#1a1a1a]
                   border border-[#3c3c3c]
                   px-4 py-2
                   text-sm
                   outline-none
                   focus:border-white"> --}}
    </div>

    <div class="header-actions">

    <button>
        Notification
    </button>

    <div class="profile-dropdown">

        <button
            id="profileDropdownBtn"
            class="profile-avatar">

            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

        </button>

        <div
            id="profileDropdownMenu"
            class="dropdown-menu">

            <button
                id="openLogoutModal">

                Logout

            </button>

        </div>

    </div>

</div>

</header>
