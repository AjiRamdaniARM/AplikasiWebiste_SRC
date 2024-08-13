<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.panel.header')
</head>
<body>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('favicon/android-chrome-192x192.png') }}" height="50" alt="logo src">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ url('/') }}">Beranda</a>
                </li>
                @if(request()->is('/'))
                    @if(count($races) > 0)
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#competition">Perlombaan</a>
                        </li>
                    @endif
                    @if(count($directives) > 0)
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#directive">Petunjuk Teknis</a>
                        </li>
                    @endif
                    @if(count($faqs) > 0)
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#faq">FAQ</a>
                        </li>
                    @endif
                    @if(!is_null($loc) || count($organizeds) > 0)
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#about">Tentang</a>
                        </li>
                    @endif
                @endif
            </ul>
            <div class="my-2 my-lg-0">
                @auth
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Hello, {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <input name="_method" type="hidden" value="POST">
                                <button type="submit" class="dropdown-item show_confirm"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout</button>
                            </form>
                        </div>
                    </li>
                </ul>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    {{-- end navbar --}}

    {{ $slot }}

    {{-- footer --}}
    <footer class="text-center py-5 bg-dark text-white">
        <span>{{ now()->format('Y') . ' - ' . config('app.name') }}</span>
    </footer>
    {{-- end footer --}}
    
    @include('components.panel.footer')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
    $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: "Are you sure to logout ???",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes !!',
                confirmButtonColor: '#dc3545',
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    form.submit();
                    }
                });
        });   
    </script>
</body>
</html>