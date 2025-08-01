<?php
$user_count = \App\Models\User::where('role', '!=', 'superadmin')->count() ?? 0;
$city_count = \App\Models\City::get()->count() ?? 0;
$developer_count = \App\Models\Developer::get()->count() ?? 0;
$complex_count = \App\Models\Complex::get()->count() ?? 0;
?>
<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-end">
                <div class="logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/registerlogo.png') }}" style="height: 35px; width: 135px;"
                            alt="" />
                    </a>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                        height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer" />
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Меню</li>

                <li class="sidebar-item @if (Request::segment('3') == '') active @endif">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Панель управления</span>
                    </a>
                </li>

                <li class="sidebar-item @if (Request::segment('3') == 'users') active @endif">
                    <a href="{{ route('users.index') }}" class="sidebar-link d-flex justify-content-between">
                        <span class="m-0">
                            <i class="bi bi-file-earmark-person-fill"></i>
                            <span>Пользователи</span>
                        </span>
                        <span class="badge bg-secondary" style="margin-left: 0;">{{ $user_count }}</span>
                    </a>
                </li>

                <li class="sidebar-item @if (Request::segment('3') == 'city') active @endif">
                    <a href="{{ route('city.index') }}" class="sidebar-link d-flex justify-content-between">
                        <span class="m-0">
                            <i class="bi bi-buildings"></i>
                            <span>Города</span>
                        </span>
                        <span class="badge bg-secondary" style="margin-left: 0;">{{ $city_count }}</span>
                    </a>
                </li>

                <li class="sidebar-item @if (Request::segment('3') == 'developer') active @endif">
                    <a href="{{ route('developer.index') }}" class="sidebar-link d-flex justify-content-between">
                        <span class="m-0">
                            <i class="bi bi-diagram-3-fill"></i>
                            <span>Застройщики</span>
                        </span>
                        <span class="badge bg-secondary" style="margin-left: 0;">{{ $developer_count }}</span>
                    </a>
                </li>

                <li class="sidebar-item @if (Request::segment('3') == 'complex') active @endif">
                    <a href="{{ route('complex.index') }}" class="sidebar-link d-flex justify-content-between">
                        <span class="m-0">
                            <i class="bi bi-building"></i>
                            <span style="font-size: 14px;">Жилые комплексы</span>
                        </span>
                        <span class="badge bg-secondary" style="margin-left: 0;">{{ $complex_count }}</span>
                    </a>
                </li>

                <li class="sidebar-item @if (Request::segment('3') == 'access') active @endif">
                    <a href="{{ route('admin.access.index') }}" class="sidebar-link d-flex justify-content-between">
                        <span class="m-0 position-relative">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Заявки</span>
                            @php
                                $pending_count = \App\Models\Access::where('status', 'pending')->count();
                            @endphp
                            @if ($pending_count > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 10px; padding: 2px 6px;">
                                    {{ $pending_count }}
                                </span>
                            @endif
                        </span>
                        <span class="badge bg-secondary"
                            style="margin-left: 0;">{{ \App\Models\Access::where('status', 'pending')->count() }}</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub @if (Request::segment('3') == 'seo') active @endif">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-search"></i>
                        <span>SEO Управление</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item @if (Request::segment('3') == 'seo' && Request::get('type') == 'complex') active @endif">
                            <a href="{{ route('admin.seo.index', ['type' => 'complex']) }}" class="submenu-link">
                                SEO Комплексов
                            </a>
                        </li>
                        <li class="submenu-item @if (Request::segment('3') == 'seo' && Request::get('type') == 'developer') active @endif">
                            <a href="{{ route('admin.seo.index', ['type' => 'developer']) }}" class="submenu-link">
                                SEO Застройщиков
                            </a>
                        </li>
                        <li class="submenu-item @if (Request::segment('3') == 'seo' && Request::get('type') == 'city') active @endif">
                            <a href="{{ route('admin.seo.index', ['type' => 'city']) }}" class="submenu-link">
                                SEO Городов
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="/sitemap.xml" target="_blank" class="submenu-link">
                                <i class="bi bi-box-arrow-up-right"></i> Sitemap.xml
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub @if (Request::segment('3') == 'settings') active @endif">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-gear-fill"></i>
                        <span>Настройки</span>
                    </a>

                    <ul class="submenu">
                        <li class="submenu-item  @if (Request::segment('4') == 'about-us') active @endif">
                            <a href="{{ route('settings.about_us') }}" class="submenu-link">
                                О проекте
                            </a>
                        </li>
                        {{-- <li class="submenu-item">
                            <a href="{{ route('key.index', ['type' => 'premium']) }}" class="submenu-link">
                                Premium
                            </a>
                        </li> --}}
                    </ul>
                </li>

                <li class="sidebar-item">
                    <form action="{{ route('logout') }}" class="sidebar-link" method="post">
                        @csrf
                        <i class="bi bi-arrow-left-circle-fill"></i>
                        <button type="submit" style="background: inherit;border:none;">
                            <span>
                                Выйти
                            </span>
                        </button>
                    </form>
                </li>
                {{-- <li class="sidebar-title">Forms &amp; Tables</li> --}}

            </ul>
        </div>
    </div>
</div>
