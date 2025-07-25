@extends('cabinet.app')

@section('content')
    <div class="max-w-full md:max-w-[calc(100%-15.625rem)] xl:max-w-[calc(100%-21.875rem)] w-full h-full">
        <div class="py-12 px-6 h-full flex flex-col gap-6">
            <h1 class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                Мой профиль
            </h1>
            <form class="flex flex-wrap gap-6 form" id="editUserForm" action="{{ route('userUpdate', auth()->user()->id) }}"
                method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="flex items-center gap-x-6 relative" id="profileImageContainer">
                    <img id="userProfileImage"
                        src="{{ auth()->user()->avatar ? asset('avatar/' . auth()->user()->avatar) : asset('images/user2.png') }}"
                        alt="avatar" class="w-24 h-24 object-cover rounded-full" />
                    <button id="deleteProfileImage"
                        class="absolute -top-[5px] left-[4.375rem] bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center cursor-pointer"
                        onclick="handleImageDelete('#userProfileImage', '{{ asset('images/user2.png') }}', '#profileImageContainer')"
                        aria-label="delete avatar">
                        <i class="mdi mdi-delete"></i>
                    </button>
                    <div class="flex flex-col gap-1">
                        <span class="text-base font-bold text-text2 tracking-wide">{{ auth()->user()->name }}</span>
                        <span id="uploadPhotoText"
                            class="text-input-divider text-xs tracking-wide cursor-pointer hover:underline"
                            onclick="document.getElementById('redaktFileInput').click();">Загрузить
                            фото</span>
                    </div>
                </div>
                <input type="file" class="hidden" id="redaktFileInput" name="avatar" />
                <div class="w-full xl:w-[80%] mt-6 sm:mt-12">
                    <div class="flex flex-wrap gap-6">
                        <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                            <label for="registerEmail"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Почта:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <i class="mdi mdi-email" data-input-id="registerEmailIcon"></i>
                                <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                <input type="email"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="info@skazoknet.ru" value="{{ auth()->user()->email }}" id="registerEmail"
                                    name="email" />
                            </div>
                        </div>
                        <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                            <label for="password"
                                class="text-input-divider text-xs font-medium tracking-wide pl-2">Пароль:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                                <i class="mdi mdi-lock"></i>
                                <div class="h-6 w-px bg-input-divider mx-2"></div>
                                <input type="password"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="Password" name="password" id="password" />
                                <i class="mdi mdi-eye pl-2 cursor-pointer password-toggle" data-input-id="password"
                                    id="registerPassword"></i>
                            </div>
                        </div>
                        <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                            <label for="editUser" class="text-input-divider text-xs font-medium tracking-wide pl-2">Имя
                                пользователя:</label>
                            <div
                                class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1 input-container">
                                <i class="mdi mdi-account" data-input-id="registerUserIcon"></i>
                                <div class="h-6 w-px bg-input-divider mx-2 input-divider"></div>
                                <input type="text" value="{{ auth()->user()->name }}"
                                    class="h-12.5 text-input-divider text-xs font-normal tracking-wide w-full outline-none border-none"
                                    placeholder="Имя пользователя" id="editUser" name="name" />
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full lg:w-[calc(50%-1.5rem)] text-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer mt-6.5 mb-8">
                            Сохранить изменения
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('redaktFileInput');
            const profileImage = document.getElementById('userProfileImage');
            const profileContainer = document.getElementById('profileImageContainer');

            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];

                if (file) {
                    // Dosya türü kontrolü
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Sadece JPG, PNG ve WEBP formatları desteklenir!');
                        fileInput.value = '';
                        return;
                    }

                    // // Dosya boyutu kontrolü (5MB)
                    // if (file.size > 5 * 1024 * 1024) {
                    //     alert('Dosya boyutu 5MB\'dan küçük olmalıdır!');
                    //     fileInput.value = '';
                    //     return;
                    // }

                    // Resmi önizleme olarak göster
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                        profileContainer.setAttribute('data-image-uploaded', 'true');
                    };
                    reader.readAsDataURL(file);

                    console.log('Seçilen dosya:', file.name, 'Boyut:', (file.size / 1024).toFixed(2) +
                        'KB');
                }
            });

            // Delete button functionality
            document.getElementById('deleteProfileImage').addEventListener('click', function(e) {
                e.preventDefault();
                profileImage.src = '{{ asset('images/user2.png') }}';
                profileContainer.removeAttribute('data-image-uploaded');
                fileInput.value = '';
                console.log('Avatar deleted, file input cleared');
            });

            // Form submit debug
            const form = document.getElementById('editUserForm');
            form.addEventListener('submit', function(e) {
                console.log('=== FORM SUBMIT DEBUG ===');
                console.log('Form action:', form.action);
                console.log('Form method:', form.method);
                console.log('Form enctype:', form.enctype);

                // File input debug
                const files = fileInput.files;
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

                console.log('=== FORM SUBMIT END ===');

                // IMPORTANT: Let form submit normally, don't prevent default
                // Form will submit as multipart/form-data automatically
            });
        });
    </script>
@endsection
