<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.svg') }}">
    <link href="{{ asset('styles/output.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('styles/form.css') }}" />
    <link rel="stylesheet" href="{{ asset('styles/sidebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('styles/menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('@mdi/font/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/simple-editor.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('styles/custom.css') }}" /> --}}
    @yield('css')
    <style>
        #deleteProfileImage {
            display: none;
        }

        [data-image-uploaded="true"] #deleteProfileImage {
            display: flex;
        }

        .bg-green-500 {
            background-color: rgba(25, 135, 85, 1);
        }
    </style>
    <script>
        const user_id = `{{ auth()->user()->id }}`
        console.log(user_id);
    </script>
    <script src="{{ asset('js/component.js') }}"></script>
    <script src="{{ asset('js/downloadFile.js') }}"></script>
    {{-- <script type="module" src="{{ asset('js/formValidation.js') }}"></script> --}}
    {{-- <script type="module" src="{{ asset('js/formRules.js') }}"></script> --}}
    <script src="{{ asset('swiper/swiper-bundle.min.js') }}" defer></script>
    <script type="module" src="{{ asset('js/swiper.js') }}"></script>

    <!-- Simple Editor -->
    <script src="{{ asset('js/simple-editor.js') }}"></script>
    <script type="module">
        // FormValidator temporarily disabled for file upload testing
        /*
        import FormValidator from "{{ asset('js/formValidation.js') }}";
        import {
            editUserFormValidationRules
        } from "{{ asset('js/formRules.js') }}";
        document.addEventListener("DOMContentLoaded", () => {
            new FormValidator("editUserForm", editUserFormValidationRules);
        });
        */
    </script>
</head>

<body class="size-full relative">
    <header class="h-[4.375rem] bg-primary w-full md:hidden block">
        <div class="xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto h-full relative">
            <div class="flex h-full w-fit items-center z-10 relative">
                <div class="cursor-pointer flex items-center justify-center pt-4 leading-10" id="adminToggle"
                    onclick="toggleSidebar('adminToggle', 'adminSidebar', 'adminOverlay', 'closeAdminSidebar')"
                    aria-label="Toggle menu">
                    <img src="{{ asset('icons/menu.svg') }}" alt="" />
                </div>
            </div>
            <a href="{{ route('home') }}" class="absolute top-0 left-0 h-full w-full flex items-center justify-center">
                <img src="{{ asset('images/logo.svg') }}" alt="" />
            </a>
        </div>
    </header>
    <div class="bg-white h-[calc(100dvh-4.375rem)] md:h-dvh flex justify-end relative">
        <!-- Overlay for mobile sidebar -->
        <div id="adminOverlay"
            class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out z-20">
        </div>

        @include('cabinet.pc_sidebar')
        @yield('content')

    </div>
    @include('cabinet.mb_sidebar')

    @yield('script')
</body>

</html>
