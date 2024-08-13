<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.panel.header')
</head>

<body id="page-top">
    @include('sweetalert::alert')
    {{-- Page Wrapper --}}
    <div id="wrapper">

        {{-- Sidebar --}}
            @include('components.panel.navbar')
        {{-- End of Sidebar --}}

        {{-- Content Wrapper --}}
        <div id="content-wrapper" class="d-flex flex-column">

            {{-- Main Content --}}
            <div id="content">

                {{-- Topbar --}}
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    {{-- Sidebar Toggle (Topbar) --}}
                        <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>


                    {{-- Topbar Navbar --}}
                    <ul class="navbar-nav ml-auto">
                        {{-- Nav Item - User Information --}}
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset(auth()->user()->avatar) }}">
                            </a>
                            {{-- Dropdown - User Information --}}
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                @auth
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <input name="_method" type="hidden" value="POST">
                                    <button type="submit" class="dropdown-item show_confirm"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout</button>
                                </form>
                                @endauth
                            </div>
                        </li>

                    </ul>

                </nav>
                {{-- End of Topbar --}}

                {{-- Begin Page Content --}}
                <div class="container-fluid">

                    {{-- Page Heading --}}
                    @if(isset($title))
                        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
                    @endif

                    @if(isset($desc))
                        <p class="mb-4">{{ $desc }}</p>
                    @endif

                    {{ $slot }}

                </div>
                {{-- /.container-fluid --}}

            </div>
            {{-- End of Main Content --}}

            {{-- Footer --}}
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>SRC Sukarobot {{ now()->year }}</span>
                    </div>
                </div>
            </footer>
            {{-- End of Footer --}}

        </div>
        {{-- End of Content Wrapper --}}

    </div>
    {{-- End of Page Wrapper --}}

    {{-- Scroll to Top Button--}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
