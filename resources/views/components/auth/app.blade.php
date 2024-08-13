<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.auth.header')
</head>

<body class="bg-gradient-primary">
    @include('sweetalert::alert')
    <div class="container">
        {{ $slot }}
    </div>

    @include('components.auth.footer')

</body>

</html>