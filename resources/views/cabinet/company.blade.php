@extends('cabinet.app')

@section('content')
    <div class="max-w-full md:max-w-[calc(100%-15.625rem)] xl:max-w-[calc(100%-21.875rem)] w-full h-full">
        <div class="py-12 px-6 h-full flex flex-col gap-6">
            <h1 class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                О компании
            </h1>

            @if ($developer)
                <form class="flex flex-wrap gap-6 form" id="editCompanyForm"
                    action="{{ route('updateCompany', auth()->user()->id) }}" method="POST" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Company Logo -->
                    <div class="flex items-center gap-x-6 relative" id="companyImageContainer">
                        <img id="companyImage"
                            src="{{ $developer->image ? asset('developer/' . $developer->image) : asset('images/company-placeholder.png') }}"
                            alt="company logo" class="w-24 h-24 object-cover rounded-lg border" />
                        <button id="deleteCompanyImage" type="button"
                            class="absolute -top-[5px] left-[4.375rem] bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center cursor-pointer"
                            onclick="handleImageDelete('#companyImage', '{{ asset('images/company-placeholder.png') }}', '#companyImageContainer')"
                            aria-label="delete company logo">
                            <i class="mdi mdi-delete"></i>
                        </button>
                        <div class="flex flex-col gap-1">
                            <span
                                class="text-base font-bold text-text2 tracking-wide">{{ $developer->name ?? 'Название компании' }}</span>
                            <span id="uploadCompanyLogoText"
                                class="text-input-divider text-xs tracking-wide cursor-pointer hover:underline"
                                onclick="document.getElementById('companyFileInput').click();">Загрузить
                                логотип</span>
                        </div>
                    </div>
                    <input type="file" class="hidden" id="companyFileInput" name="image" accept="image/*" />

                    <div class="w-full xl:w-[80%] mt-6 sm:mt-12">
                        <div class="flex flex-wrap gap-6">
                            <!-- Company Name -->
                            <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                                <label for="companyName"
                                    class="text-input-divider text-xs font-medium tracking-wide pl-2">Название
                                    компании:</label>
                                <div
                                    class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                    <i class="mdi mdi-domain" data-input-id="companyNameIcon"></i>
                                    <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                    <input type="text" required
                                        class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                        placeholder="Название компании" value="{{ $developer->name ?? '' }}"
                                        id="companyName" name="name" />
                                </div>
                            </div>

                            <!-- Year of Establishment -->
                            <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                                <label for="yearEstablishment"
                                    class="text-input-divider text-xs font-medium tracking-wide pl-2">Год основания:</label>
                                <div
                                    class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                    <i class="mdi mdi-calendar" data-input-id="yearIcon"></i>
                                    <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                    <input type="number"
                                        class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                        placeholder="2020" value="{{ $developer->year_establishment ?? '' }}"
                                        id="yearEstablishment" name="year_establishment" min="1900"
                                        max="{{ date('Y') }}" />
                                </div>
                            </div>

                            <!-- Sort Order -->
                            {{-- <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                                <label for="companySort"
                                    class="text-input-divider text-xs font-medium tracking-wide pl-2">Порядок
                                    сортировки:</label>
                                <div
                                    class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                    <i class="mdi mdi-sort-numeric-ascending" data-input-id="sortIcon"></i>
                                    <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                    <input type="number"
                                        class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                        placeholder="0" value="{{ $developer->sort ?? 0 }}" id="companySort" name="sort"
                                        min="0" />
                                </div>
                            </div> --}}

                            <!-- Status -->
                            <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                                <label for="companyStatus"
                                    class="text-input-divider text-xs font-medium tracking-wide pl-2">Статус:</label>
                                <div
                                    class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                    <i class="mdi mdi-check-circle" data-input-id="statusIcon"></i>
                                    <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                    <select
                                        class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none bg-transparent"
                                        id="companyStatus" name="status">
                                        <option value="1" {{ ($developer->status ?? 1) == 1 ? 'selected' : '' }}>
                                            Активный</option>
                                        <option value="0" {{ ($developer->status ?? 1) == 0 ? 'selected' : '' }}>
                                            Неактивный</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Popular -->
                            {{-- <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                                <label for="companyPopular"
                                    class="text-input-divider text-xs font-medium tracking-wide pl-2">Популярность:</label>
                                <div
                                    class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                    <i class="mdi mdi-star" data-input-id="popularIcon"></i>
                                    <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                    <select
                                        class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none bg-transparent"
                                        id="companyPopular" name="popular">
                                        <option value="0" {{ ($developer->popular ?? 0) == 0 ? 'selected' : '' }}>
                                            Обычный</option>
                                        <option value="1" {{ ($developer->popular ?? 0) == 1 ? 'selected' : '' }}>
                                            Популярный</option>
                                    </select>
                                </div>
                            </div> --}}

                            <!-- Content/Description -->
                            <div class="form-item w-full">
                                <label for="companyContent"
                                    class="text-input-divider text-xs font-medium tracking-wide pl-2">Описание
                                    компании:</label>
                                <div class="mt-1">
                                    <textarea id="companyContent" name="content" data-simple-editor data-height="200px"
                                        data-placeholder="Расскажите о вашей компании...">{{ $developer->content ?? '' }}</textarea>
                                </div>
                            </div>

                            <!-- Mobile responsive button -->
                            <div class="w-full flex justify-center lg:justify-start">
                                <button type="submit"
                                    class="w-full lg:w-auto text-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer mt-6.5 mb-8">
                                    Сохранить изменения
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="w-full xl:w-[80%] mt-6 sm:mt-12">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center">
                            <i class="mdi mdi-alert-circle text-yellow-600 text-2xl mr-0 sm:mr-3 mb-2 sm:mb-0"></i>
                            <div>
                                <h3 class="text-lg font-semibold text-yellow-800">Информация о компании не найдена</h3>
                                <p class="text-yellow-700 mt-1">Обратитесь к администратору для создания профиля компании.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('companyFileInput');
            const companyImage = document.getElementById('companyImage');
            const companyContainer = document.getElementById('companyImageContainer');

            if (fileInput && companyImage && companyContainer) {
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];

                    if (file) {
                        // File type validation
                        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                        if (!allowedTypes.includes(file.type)) {
                            alert('Поддерживаются только форматы JPG, PNG и WEBP!');
                            fileInput.value = '';
                            return;
                        }

                        // File size validation (10MB - same as admin)
                        if (file.size > 10 * 1024 * 1024) {
                            alert('Размер файла должен быть менее 10MB!');
                            fileInput.value = '';
                            return;
                        }

                        // Show preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            companyImage.src = e.target.result;
                            companyContainer.setAttribute('data-image-uploaded', 'true');
                        };
                        reader.readAsDataURL(file);

                        console.log('Selected file:', file.name, 'Size:', (file.size / 1024).toFixed(2) +
                            'KB');
                    }
                });

                // Delete button functionality
                const deleteBtn = document.getElementById('deleteCompanyImage');
                if (deleteBtn) {
                    deleteBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        companyImage.src = '{{ asset('images/company-placeholder.png') }}';
                        companyContainer.removeAttribute('data-image-uploaded');
                        fileInput.value = '';
                        console.log('Company logo deleted, file input cleared');
                    });
                }
            }

            // Form submit debug
            const form = document.getElementById('editCompanyForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    console.log('=== COMPANY FORM SUBMIT DEBUG ===');
                    console.log('Form action:', form.action);
                    console.log('Form method:', form.method);
                    console.log('Form enctype:', form.enctype);

                    // File input debug
                    const files = fileInput ? fileInput.files : [];
                    console.log('File input files count:', files.length);

                    if (files.length > 0) {
                        const file = files[0];
                        console.log('File details:', {
                            name: file.name,
                            size: file.size,
                            type: file.type,
                            lastModified: file.lastModified
                        });
                    } else {
                        console.log('No file selected');
                    }

                    // Form data debug
                    const formData = new FormData(form);
                    console.log('FormData entries:');
                    for (let [key, value] of formData.entries()) {
                        if (value instanceof File) {
                            console.log(key + ':', {
                                name: value.name,
                                size: value.size,
                                type: value.type
                            });
                        } else {
                            console.log(key + ':', value);
                        }
                    }

                    console.log('=== COMPANY FORM SUBMIT END ===');
                });
            }
        });

        // Global function for image deletion (if needed)
        function handleImageDelete(imageSelector, defaultSrc, containerSelector) {
            const image = document.querySelector(imageSelector);
            const container = document.querySelector(containerSelector);
            const fileInput = document.getElementById('companyFileInput');

            if (image) image.src = defaultSrc;
            if (container) container.removeAttribute('data-image-uploaded');
            if (fileInput) fileInput.value = '';
        }
    </script>
@endsection
