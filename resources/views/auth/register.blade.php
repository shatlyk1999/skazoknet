{{-- @extends('auth.auth_app') --}}
{{-- @section('content') --}}
<x-auth.auth-layout>
    <div class="my-0 md:my-12 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto h-full md:h-[calc(100dvh-7.5rem)]">
        <div class="flex items-center md:items-start justify-between h-full md:flex-row flex-col">
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto">
                <h1 class="text-text font-bold text-2xl tracking-wider">Регистрация</h1>
                <div class="flex flex-col w-full gap-6 mt-6">
                    <form class="flex flex-col gap-y-3 form" action="{{ route('register') }}" method="post"
                        id="registerForm" novalidate>
                        @csrf
                        <div class="form-item">
                            <label for="registerEmail"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Почта:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <i class="mdi mdi-email" data-input-id="registerEmailIcon"></i>
                                <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                <input type="email"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="info@skazoknet.ru" id="registerEmail" name="email" />
                            </div>
                            <div
                                class="server-message hidden mt-2 rounded-lg bg-input-error text-input-error-text w-full p-4 font-light text-xs tracking-wider">
                                <span class="inline-block w-[90%]"></span>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="password"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Пароль:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <i class="mdi mdi-lock"></i>
                                <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                <input type="password"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="Пароль" id="password" name="password" />
                                <i class="mdi mdi-eye pl-2 cursor-pointer password-toggle" data-input-id="password"
                                    id="registerPassword"></i>
                            </div>
                            <div
                                class="server-message hidden mt-2 rounded-lg bg-input-error text-input-error-text w-full p-4 font-light text-xs tracking-wider">
                                <span class="inline-block w-[90%]"></span>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="confirmPassword"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Повторите
                                пароль:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <i class="mdi mdi-lock"></i>
                                <div class="h-6 w-px bg-input-divider mx-2"></div>
                                <input type="password" name="password_confirmation"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="Повторите пароль" id="confirmPassword" />
                                <i class="mdi mdi-eye pl-2 cursor-pointer password-toggle"
                                    data-input-id="confirmPassword" id="registerConfirmPassword"></i>
                            </div>
                            <div
                                class="server-message hidden mt-2 rounded-lg bg-input-error text-input-error-text w-full p-4 font-light text-xs tracking-wider">
                                <span class="inline-block w-[90%]"></span>
                            </div>
                        </div>
                        <div class="form-item">
                            <label for="registerUser"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Имя
                                пользователя:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <i class="mdi mdi-account" data-input-id="registerUserIcon"></i>
                                <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                <input type="text"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="Имя пользователя" id="registerUser" name="name" />
                            </div>
                            <div
                                class="server-message hidden mt-2 rounded-lg bg-input-error text-input-error-text w-full p-4 font-light text-xs tracking-wider">
                                <span class="inline-block w-[90%]"></span>
                            </div>
                        </div>
                        <div class="mt-4 text-xs tracking-wide flex items-center gap-x-2 justify-center">
                            <input type="radio" name="role" value="developer" class="border-primary" />
                            <div>
                                Застройщик
                            </div>
                            <input type="radio" name="role" value="user" class="border-primary" />
                            <div>
                                Пользовател
                            </div>
                        </div>
                        <button type="submit" id="registerButton"
                            class="text-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer mt-4"
                            style="opacity: 0.5; cursor: not-allowed;" disabled>
                            Зарегистрировать
                        </button>


                        <div class="mt-4 text-xs tracking-wide flex items-center gap-x-2 justify-center">
                            <input type="checkbox" id="agreeCheckbox" class="border-primary" />
                            <div>
                                Я принимаю
                                <a href="#" style="color: #3F51B5;">
                                    правила, пользовательское соглашение
                                </a>
                                <br> и
                                <a href="#" style="color: #3F51B5;">
                                    политику конфиденциальности
                                </a>
                                сервиса
                                Сказокнет
                            </div>
                        </div>
                    </form>
                    <!--  -->
                </div>
            </div>
            <div class="w-full sm:w-[80%] md:mx-0 mx-auto md:w-[45%] xl:w-[40%] my-auto">
                <img src="{{ asset('images/registerimage.png') }}" class="w-full h-auto md:inline-block hidden"
                    alt="" />

                <div class="pt-8 flex items-center justify-center md:hidden">
                    <img src="{{ asset('images/registerlogo.png') }}" class="h-10 w-37.5" alt="" />
                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="module">
            import FormValidator from "{{ asset('js/formValidation.js') }}";
            import {
                registerFormValidationRules
            } from "{{ asset('js/formRules.js') }}";
            document.addEventListener("DOMContentLoaded", () => {
                new FormValidator("registerForm", registerFormValidationRules);
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const checkbox = document.getElementById("agreeCheckbox");
                const button = document.getElementById("registerButton");

                function toggleButton() {
                    if (checkbox.checked) {
                        button.disabled = false;
                        button.style.opacity = "1";
                        button.style.cursor = "pointer";
                    } else {
                        button.disabled = true;
                        button.style.opacity = "0.5";
                        button.style.cursor = "not-allowed";
                    }
                }

                checkbox.addEventListener("change", toggleButton);

                // İlk durum kontrolü (sayfa yenilenirse vs)
                toggleButton();
            });
        </script>
    </x-slot>
</x-auth.auth-layout>
{{-- @endsection --}}

{{-- @section('script')
    <script>
    </script>
@endsection --}}


{{-- @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror --}}
{{-- password_confirmation --}}
