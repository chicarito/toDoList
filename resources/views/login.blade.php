<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css_js/bootstrap.min.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-body-tertiary">
    <div class="card p-4 shadow-sm justify-content-center" style="width: 350px; height: 350px;">
        <form action="/postlogin" method="post" autocomplete="off">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text"
                    class="form-control rounded-bottom-0 @error('username')
                    is-invalid rounded-bottom-2
                @enderror"
                    id="floatingInput" name="username" required placeholder="your username">
                <label for="floatingInput">Username</label>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control rounded-top-0" id="floatingPassword" name="password" required
                    placeholder="******">
                <label for="floatingPassword">Password</label>
            </div>


            <button class="btn btn-dark w-100 mt-4" type="submit">Sign in</button>
        </form>
    </div>
    <script src="{{ asset('css_js/bootstrap.bundle.min.js') }}"></script>



</body>

</html>
