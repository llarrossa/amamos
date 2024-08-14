<!doctype html>
<html lang="pt-br" data-bs-theme="auto">
<head><script src="/docs/5.3/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Lucca Larrossa">
    <title>Login - Amamos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ URL::to('css/sign-in.css') }}" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4">

<main class="form-signin w-100 m-auto">
    <form method="post" action="{{ route('login.store') }}">
        @csrf
        <img class="center" src="img/Logotipo03.png" alt="" width="340" height="240" style="margin: 0 10px 0px -17px;">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger messageBox" role="alert">
                    {{$error}}
                </div>
            @endforeach
        @endif

        <div class="form-floating">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   placeholder="name@example.com" value="{{ old('email') }}">
            <label for="floatingInput">Email</label>
            <div class="invalid-feedback">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <label for="password">Senha</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
        <p class="mt-2 mb-3 text-body-secondary"><center>&copy; 2024</center></p>
    </form>
</main>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
