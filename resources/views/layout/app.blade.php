<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDoList</title>
    <link rel="stylesheet" href="{{ asset('css_js/bootstrap.min.css') }}">
    {{-- css select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="bg-body-tertiary d-flex flex-column min-vh-100">

    @include('layout.navbar')
    <main class="flex-grow-1">
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer class="py-3 mt-5">
        <div class="border-top mb-2"></div>
        <p class="text-center text-body-secondary">ToDoList App</p>
    </footer>
    {{-- jquery & select2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#formSelect').select2({
                width: '100%'
            });
        });
    </script>

    {{-- bootstrap --}}
    <script src="{{ asset('css_js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
