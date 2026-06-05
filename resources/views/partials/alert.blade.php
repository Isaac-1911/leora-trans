@if (session('success'))
    <div class="toast toast-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="toast toast-error">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())

    <div class="toast toast-error">

        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif

<script>
    setTimeout(() => {

        document
            .querySelectorAll('.toast')
            .forEach(toast => {

                toast.style.opacity = '0';

                toast.style.transform =
                    'translateX(40px)';

                setTimeout(() => {

                    toast.remove();

                }, 300);

            });

    }, 3000);
</script>
