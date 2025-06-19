<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Регистрация | Сказокнет</title>
    <link href="{{ asset('styles/output.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('styles//form.css') }}" />
    <link rel="stylesheet" href="{{ asset('@mdi/font/css/materialdesignicons.min.css') }}" />

</head>

<body class="size-full">
    <div class="bg-white h-dvh">
        <div class="pt-8 pl-6 md:block hidden">
            <img src="{{ asset('registerlogo.png') }}" class="h-10 w-37.5" alt="" />
        </div>
        @yield('content')
    </div>
    <script src="{{ asset('js/component.js') }}" defer></script>
    <script src="{{ asset('js/formValidation.js') }}"></script>
    <script src="{{ asset('js/formRules.js') }}"></script>
    @yield('script')
</body>

</html>
