<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.panel.header')
    @includeIf('components.panel.navbar')
</head>

<body class="bg-[#F2F5FA]">




    @include('sweetalert::alert')
    {{-- Page Wrapper --}}
    <div>
        {{-- Content Wrapper --}}
        <div id="content-wrapper" class="d-flex flex-column">
            {{-- Main Content --}}
            <div id="content">


                {{-- Begin Page Content --}}
                <div class="container">

                    {{-- Page Heading --}}
                    @if (isset($title))
                        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
                    @endif

                    @if (isset($desc))
                        <p class="mb-4">{{ $desc }}</p>
                    @endif

                    {{ $slot }}

                </div>
                {{-- /.container-fluid --}}

            </div>
            {{-- End of Main Content --}}


        </div>
        {{-- End of Content Wrapper --}}

    </div>
    {{-- End of Page Wrapper --}}

    {{-- Scroll to Top Button --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('components.panel.footer')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
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
