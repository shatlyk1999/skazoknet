{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<x-auth.auth-layout>
    <div class="my-0 md:my-12 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto h-full md:h-[calc(100dvh-7.5rem)]">
        <div class="flex items-center md:items-start justify-between h-full md:flex-row flex-col">
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto xl:mt-[10%]">
                <h1 class="text-text font-bold text-2xl tracking-wider">
                    Восстановления пароля
                </h1>

                <div class="flex flex-col w-full gap-6 mt-6">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="flex flex-col gap-y-3 form" novalidate method="POST" {{-- id="recoveryPasswordForm" --}}
                        action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-item">
                            <label for="recoveryPasswordEmailIcon"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Почта:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <i class="mdi mdi-email" data-input-id="recoveryPasswordEmailIcon"></i>
                                <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                <input type="text"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="info@skazoknet.ru" id="recoveryPasswordEmailIcon" name="email" />
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div
                                class="server-message hidden mt-2 rounded-lg bg-input-error text-input-error-text w-full p-4 font-light text-xs tracking-wider">
                                <span class="inline-block w-[90%]"></span>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer mt-4">
                            Отправить
                        </button>
                    </form>
                </div>
            </div>
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto">
                <img src="{{ asset('registerimage.png') }}" class="w-full h-auto" alt="Изображение регистрации" />
                <div class="pt-8 flex items-center justify-center md:hidden">
                    <img src="{{ asset('registerlogo.png') }}" class="h-10 w-37.5" alt="Логотип" />
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="module">
            import FormValidator from "{{ asset('js/formValidation.js') }}";
            import {
                recoveryPasswordFormValidationRules
            } from "{{ asset('js/formRules.js') }}";

            document.addEventListener("DOMContentLoaded", () => {
                new FormValidator(
                    "recoveryPasswordForm",
                    recoveryPasswordFormValidationRules
                );
            });
        </script>
    </x-slot>
</x-auth.auth-layout>
