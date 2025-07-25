@extends('admin.layouts.main')

@section('title', 'Добавить SEO')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Добавить SEO данные</h3>
                    <p class="text-subtitle text-muted">Создание SEO мета данных</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Новые SEO данные -
                        @if ($type == 'complex')
                            Комплекс
                        @elseif($type == 'developer')
                            Застройщик
                        @elseif($type == 'city')
                            Город
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.seo.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="seoable_type" value="App\Models\{{ ucfirst($type) }}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="seoable_id">Выберите
                                        {{ $type == 'complex' ? 'комплекс' : ($type == 'developer' ? 'застройщика' : 'город') }}</label>
                                    <select name="seoable_id" id="seoable_id" class="form-select" required>
                                        <option value="">-- Выберите --</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('seoable_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">SEO Заголовок</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ old('title') }}" maxlength="255">
                                    <small class="text-muted">Максимум 255 символов</small>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="og_title">OG Заголовок</label>
                                    <input type="text" name="og_title" id="og_title" class="form-control"
                                        value="{{ old('og_title') }}" maxlength="255">
                                    <small class="text-muted">Для социальных сетей</small>
                                    @error('og_title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">SEO Описание</label>
                                    <textarea name="description" id="description" class="form-control" rows="4" maxlength="500">{{ old('description') }}</textarea>
                                    <small class="text-muted">Максимум 500 символов</small>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="og_description">OG Описание</label>
                                    <textarea name="og_description" id="og_description" class="form-control" rows="4" maxlength="500">{{ old('og_description') }}</textarea>
                                    <small class="text-muted">Для социальных сетей</small>
                                    @error('og_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keywords">Ключевые слова</label>
                                    <input type="text" name="keywords" id="keywords" class="form-control"
                                        value="{{ old('keywords') }}">
                                    <small class="text-muted">Разделяйте запятыми</small>
                                    @error('keywords')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="og_image">OG Изображение (URL)</label>
                                    <input type="url" name="og_image" id="og_image" class="form-control"
                                        value="{{ old('og_image') }}"
                                        placeholder="Оставьте пустым для автоматического выбора изображения">
                                    <small class="text-muted">Если не указано, будет использовано изображение выбранного
                                        объекта</small>
                                    @error('og_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="canonical_url">Канонический URL</label>
                                    <input type="url" name="canonical_url" id="canonical_url" class="form-control"
                                        value="{{ old('canonical_url') }}">
                                    <small class="text-muted">Основной URL страницы</small>
                                    @error('canonical_url')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="robots">Robots</label>
                                    <select name="robots" id="robots" class="form-select">
                                        <option value="index,follow"
                                            {{ old('robots') == 'index,follow' ? 'selected' : '' }}>index,follow</option>
                                        <option value="noindex,nofollow"
                                            {{ old('robots') == 'noindex,nofollow' ? 'selected' : '' }}>noindex,nofollow
                                        </option>
                                        <option value="index,nofollow"
                                            {{ old('robots') == 'index,nofollow' ? 'selected' : '' }}>index,nofollow
                                        </option>
                                        <option value="noindex,follow"
                                            {{ old('robots') == 'noindex,follow' ? 'selected' : '' }}>noindex,follow
                                        </option>
                                    </select>
                                    @error('robots')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('admin.seo.index', ['type' => $type]) }}"
                                class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
