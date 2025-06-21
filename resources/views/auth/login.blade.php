{{-- @extends('auth.auth_app') --}}
{{-- @section('content') --}}
<x-auth.auth-layout>
    <div class="my-0 md:my-12 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto h-full md:h-[calc(100dvh-7.5rem)]">
        <div class="flex items-center md:items-start justify-between h-full md:flex-row flex-col">
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto xl:mt-[10%]">
                <h1 class="text-text font-bold text-2xl tracking-wider">Вход</h1>
                <div
                    class="mt-6 login-error rounded-lg hidden bg-input-error/50 text-input-error-text w-full p-4 font-light text-xs tracking-wider">
                    Неправильный email или пароль. Если Вы забыли свой логин или
                    пароль, то воспользуйтесь
                    <a href="{{ route('password.request') }}" class="text-primary">
                        формой восстановление пароля.
                    </a>
                    Если Вы новый пользователь , то сначала
                    <a href="{{ route('register') }}" class="text-primary">зарегистрируйтесь.</a>
                </div>
                <div class="flex flex-col w-full gap-6 mt-6">
                    <form class="flex flex-col gap-y-3 form" id="loginForm" novalidate>
                        <div class="form-item">
                            <label for="registerEmail"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Почта:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <i class="mdi mdi-email" data-input-id="registerEmailIcon"></i>
                                <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                <input type="text"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="info@skazoknet.ru" id="registerEmail" name="email" />
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="password"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Пароль:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                                <img src="{{ asset('icons/lock.svg') }}" alt="" />
                                <div class="h-6 w-px bg-input-divider mx-2"></div>
                                <input type="password"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="Password" id="password" name="password" />
                                <i class="mdi mdi-eye pl-2 cursor-pointer password-toggle" data-input-id="password"
                                    id="passwordIcon"></i>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer mt-4">
                            Войти
                        </button>

                        <div class="mt-4 text-center text-xs tracking-wide">
                            Забыли пароль?
                            <a href="{{ route('password.request') }}" class="text-primary">Восстановление пароля</a>
                        </div>
                    </form>
                    <!--  -->
                </div>
            </div>
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto">
                <img src="{{ asset('registerimage.png') }}"
                    class="w-full h-auto md:max-h-max max-h-[20rem] object-contain" alt="" />
                <div class="pt-8 flex items-center justify-center md:hidden">
                    <img src="{{ asset('registerlogo.png') }}" class="h-10 w-37.5" alt="" />
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="module">
            import FormValidator from "{{ asset('js/formValidation.js') }}";
            import {
                loginEmailValidationRules
            } from "{{ asset('js/formRules.js') }}";
            document.addEventListener("DOMContentLoaded", () => {
                new FormValidator("loginForm", loginEmailValidationRules);
            });
        </script>
    </x-slot>
</x-auth.auth-layout>
