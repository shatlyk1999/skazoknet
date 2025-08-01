@extends('cabinet.app')

@section('content')
    <div class="max-w-full md:max-w-[calc(100%-15.625rem)] xl:max-w-[calc(100%-21.875rem)] w-full h-full">
        <div class="py-12 px-6 h-full flex flex-col gap-6">
            <h1 class="tracking-widest text-2xl lg:text-3xl xl:text-4xl font-bold w-full xl:w-[80%] mr-0 xl:mr-auto">
                Редактировать комплекс
            </h1>

            <!-- Complex Preview -->
            <div class="flex items-center gap-x-6 mt-4">
                <div class="border rounded-xl h-20 w-[6.25rem] overflow-hidden" id="previewContainer">
                    <img src="{{ $complex->image ? asset('complex/' . $complex->image) : asset('images/complex-placeholder.jpg') }}"
                        class="w-full h-full object-cover" alt="" id="previewImage" />
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-base font-bold text-text2 tracking-wide" id="previewName">
                        @if ($complex->type == 'residential')
                            ЖК "{{ $complex->name }}"
                        @elseif ($complex->type == 'hotel')
                            ГК "{{ $complex->name }}"
                        @else
                            "{{ $complex->name }}"
                        @endif
                    </span>
                    <span class="text-input-divider text-xs tracking-wide cursor-pointer hover:underline"
                        onclick="document.getElementById('mainImageInput').click();">
                        Изменить главное фото
                    </span>
                </div>
            </div>

            <form class="flex flex-wrap gap-6 form" id="editComplexForm"
                action="{{ route('updateComplex', [auth()->user()->id, $complex->id]) }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <!-- Main Image Input (Hidden) -->
                <input type="file" class="hidden" id="mainImageInput" name="image" accept="image/*" />

                <!-- Complex Name -->
                <div class="form-item w-full">
                    <label for="complexName" class="text-input-divider text-xs font-medium tracking-wide pl-2">Название
                        комплекса:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <input type="text" name="name" id="complexName" required value="{{ $complex->name }}"
                            class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none"
                            placeholder="ЖК Губернский" />
                    </div>
                </div>

                <!-- Complex Address -->
                <div class="form-item w-full">
                    <label for="complexAddress" class="text-input-divider text-xs font-medium tracking-wide pl-2">Адрес
                        комплекса:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <input type="text" name="address" id="complexAddress" value="{{ $complex->address }}"
                            class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none"
                            placeholder="г. Краснодар, ул.Западный обход,33" />
                    </div>
                </div>

                <!-- Type and Sort -->
                <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                    <label for="complexType" class="text-input-divider text-xs font-medium tracking-wide pl-2">Тип
                        комплекса:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <select name="type" id="complexType"
                            class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none bg-transparent">
                            <option value="residential" {{ $complex->type == 'residential' ? 'selected' : '' }}>ЖК
                            </option>
                            <option value="hotel" {{ $complex->type == 'hotel' ? 'selected' : '' }}>ГК
                            </option>
                        </select>
                    </div>
                </div>

                {{-- <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                    <label for="complexSort" class="text-input-divider text-xs font-medium tracking-wide pl-2">Порядок
                        сортировки:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <input type="number" name="sort" id="complexSort" value="{{ $complex->sort ?? 0 }}"
                            min="0"
                            class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none"
                            placeholder="0" />
                    </div>
                </div> --}}

                <!-- Status and Popular -->
                <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                    <label for="complexStatus"
                        class="text-input-divider text-xs font-medium tracking-wide pl-2">Статус:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <select name="status" id="complexStatus"
                            class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none bg-transparent">
                            <option value="1" {{ $complex->status == 1 ? 'selected' : '' }}>Активный</option>
                            <option value="0" {{ $complex->status == 0 ? 'selected' : '' }}>Неактивный</option>
                        </select>
                    </div>
                </div>

                {{-- <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                    <label for="complexPopular"
                        class="text-input-divider text-xs font-medium tracking-wide pl-2">Популярность:</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <select name="popular" id="complexPopular"
                            class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none bg-transparent">
                            <option value="0" {{ $complex->popular == 0 ? 'selected' : '' }}>Обычный</option>
                            <option value="1" {{ $complex->popular == 1 ? 'selected' : '' }}>Популярный</option>
                        </select>
                    </div>
                </div> --}}

                <!-- Map Coordinates -->
                <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                    <label for="complexMapX" class="text-input-divider text-xs font-medium tracking-wide pl-2">Координата X
                        (широта):</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <input type="text" name="map_x" id="complexMapX" value="{{ $complex->map_x }}"
                            class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none"
                            placeholder="45.035470" />
                    </div>
                </div>

                <div class="form-item w-full lg:w-[calc(50%-1.5rem)]">
                    <label for="complexMapY" class="text-input-divider text-xs font-medium tracking-wide pl-2">Координата Y
                        (долгота):</label>
                    <div class="rounded-3xl border-auth-input-border-color border px-4 h-12.5 flex items-center mt-1">
                        <input type="text" name="map_y" id="complexMapY" value="{{ $complex->map_y }}"
                            class="h-12.5 text-input-divider text-sm font-semibold tracking-wide w-full outline-none border-none"
                            placeholder="38.975313" />
                    </div>
                </div>

                <!-- Content/Description -->
                <div class="form-item w-full">
                    <label for="complexContent" class="text-input-divider text-xs font-medium tracking-wide pl-2">Описание
                        комплекса:</label>
                    <div class="mt-1">
                        <textarea name="content" id="complexContent" data-simple-editor data-height="200px"
                            data-placeholder="Описание комплекса...">{{ $complex->content }}</textarea>
                    </div>
                </div>

                <!-- Existing Additional Images -->
                @if ($complex->images && $complex->images->count() > 0)
                    <div class="w-full">
                        <label class="text-input-divider text-xs font-medium tracking-wide pl-2">Существующие
                            изображения:</label>
                        <div class="flex flex-wrap gap-4 mt-2" id="existingImagesContainer">
                            @foreach ($complex->images as $image)
                                <div class="relative border rounded-xl p-2 h-20 w-20 flex items-center justify-center">
                                    <img src="{{ asset('complex/' . $image->image) }}"
                                        class="w-full h-full object-cover rounded" alt="Complex image" />
                                    <button type="button" onclick="removeExistingImage({{ $image->id }}, this)"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                        ×
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Additional Images Container -->
                <div class="h-auto w-full flex items-center justify-end flex-wrap gap-4" id="additionalImagesContainer">
                </div>

                <!-- Upload Additional Images Button -->
                <div class="flex items-center w-full justify-end">
                    <input type="file" class="hidden" id="additionalImagesInput" name="additional_images[]" multiple
                        accept="image/*" />
                    <button type="button" onclick="document.getElementById('additionalImagesInput').click();"
                        class="mt-6 border-primary text-sm xl:text-base border rounded-3xl px-4 py-2 text-primary hover:text-white hover:border-white hover:bg-primary transition-colors cursor-pointer">
                        <i class="mdi mdi-plus"></i>
                        Загрузить дополнительные изображения
                    </button>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full text-center h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer mt-6.5">
                    Сохранить изменения
                </button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const complexNameInput = document.getElementById('complexName');
            const complexTypeSelect = document.getElementById('complexType');
            const previewName = document.getElementById('previewName');
            const mainImageInput = document.getElementById('mainImageInput');
            const previewImage = document.getElementById('previewImage');
            const additionalImagesInput = document.getElementById('additionalImagesInput');
            const additionalImagesContainer = document.getElementById('additionalImagesContainer');

            // Update preview name when typing
            complexNameInput.addEventListener('input', function() {
                const name = this.value.trim();
                const type = complexTypeSelect.value;
                const prefix = type === 'residential' ? 'ЖК' : 'ГК';
                previewName.textContent = name ? `${prefix} "${name}"` : 'Комплекс';
            });

            // Update preview name when type changes
            complexTypeSelect.addEventListener('change', function() {
                const name = complexNameInput.value.trim();
                const type = this.value;
                const prefix = type === 'residential' ? 'ЖК' : 'ГК';
                previewName.textContent = name ? `${prefix} "${name}"` : 'Комплекс';
            });

            // Handle main image upload
            mainImageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (!file.type.startsWith('image/')) {
                        alert('Пожалуйста, выберите изображение');
                        return;
                    }

                    if (file.size > 10 * 1024 * 1024) {
                        alert('Размер файла должен быть менее 10MB');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle additional images upload
            additionalImagesInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                additionalImagesContainer.innerHTML = '';

                files.forEach((file, index) => {
                    if (!file.type.startsWith('image/')) {
                        alert(`Файл ${file.name} не является изображением`);
                        return;
                    }

                    if (file.size > 10 * 1024 * 1024) {
                        alert(`Файл ${file.name} слишком большой (более 10MB)`);
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageContainer = document.createElement('div');
                        imageContainer.className =
                            'relative border rounded-xl p-2 h-20 w-20 flex items-center justify-center';
                        imageContainer.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover rounded" alt="Additional image ${index + 1}" />
                            <button type="button" onclick="this.parentElement.remove()" 
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                ×
                            </button>
                        `;
                        additionalImagesContainer.appendChild(imageContainer);
                    };
                    reader.readAsDataURL(file);
                });
            });

            // Form submission
            document.getElementById('editComplexForm').addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;

                submitBtn.textContent = 'Сохранение...';
                submitBtn.disabled = true;

                // Form will submit normally, re-enable button after a delay in case of errors
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });
        });

        // Remove existing image function
        function removeExistingImage(imageId, button) {
            if (confirm('Вы уверены, что хотите удалить это изображение?')) {
                fetch(`/complex-image/${imageId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            button.parentElement.remove();
                        } else {
                            alert('Ошибка при удалении изображения');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ошибка при удалении изображения');
                    });
            }
        }
    </script>
@endsection
