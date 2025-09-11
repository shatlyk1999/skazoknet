<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Регистрация | Сказокнет</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.svg') }}">

    <link href="{{ asset('styles/output.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('styles/form.css') }}" />
    <link rel="stylesheet" href="{{ asset('@mdi/font/css/materialdesignicons.min.css') }}" />
</head>

<body class="size-full">
    <div class="bg-white h-dvh">
        <a href="{{ route('home') }}" class="pt-8 pl-6 md:block hidden">
            <img src="{{ asset('images/registerLogo.svg') }}" class="h-10 w-37.5" alt="" />
        </a>

        {{ $slot }}

    </div>
    <script type="module" src="{{ asset('js/component.js') }}" defer></script>
    <script type="module" src="{{ asset('js/formValidation.js') }}"></script>
    <script type="module" src="{{ asset('js/formRules.js') }}"></script>

    {{ $script ?? '' }}

</body>

</html>
