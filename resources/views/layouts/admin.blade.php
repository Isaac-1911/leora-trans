<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    @include('partials.sidebar')

    <div class="main-wrapper">

        @include('partials.topbar')

        <main class="content">
            @yield('content')
        </main>

    </div>

    <div id="logoutModal" class="modal-overlay">

        <div class="modal-container modal-sm">

            <div class="modal-header">

                <h2>
                    LOGOUT
                </h2>

                <button id="closeLogoutModal">

                    ×

                </button>

            </div>

            <div class="delete-content">

                <p>
                    Are you sure you want to logout?
                </p>

            </div>

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <div class="modal-footer">

                    <button type="button" id="closeLogoutModal2" class="btn-cancel">

                        CANCEL

                    </button>

                    <button type="submit" class="btn-danger">

                        LOGOUT

                    </button>

                </div>

            </form>

        </div>

    </div>

    @include('partials.alert')

    <script>
        const profileBtn =
            document.getElementById(
                'profileDropdownBtn'
            );

        const dropdownMenu =
            document.getElementById(
                'profileDropdownMenu'
            );

        profileBtn.addEventListener(
            'click',
            () => {

                dropdownMenu.classList.toggle(
                    'show'
                );

            }
        );

        const logoutModal =
            document.getElementById(
                'logoutModal'
            );

        document
            .getElementById(
                'openLogoutModal'
            )
            .addEventListener(
                'click',
                () => {

                    logoutModal.classList.add(
                        'show'
                    );

                    dropdownMenu.classList.remove(
                        'show'
                    );

                }
            );

        document
            .getElementById(
                'closeLogoutModal'
            )
            .addEventListener(
                'click',
                () => {

                    logoutModal.classList.remove(
                        'show'
                    );

                }
            );

        document
            .getElementById(
                'closeLogoutModal2'
            )
            .addEventListener(
                'click',
                () => {

                    logoutModal.classList.remove(
                        'show'
                    );

                }
            );
    </script>

    @stack('scripts')

</body>

</html>
