@extends('admin.layouts.main')

@section('title', 'Редактировать SEO')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Редактировать SEO данные</h3>
                    <p class="text-subtitle text-muted">Изменение SEO мета данных</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Редактировать SEO: {{ $seo->seoable->name ?? 'N/A' }}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.seo.update', $seo) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <strong>Объект:</strong> {{ $seo->seoable->name ?? 'N/A' }}
                                    <br>
                                    <strong>Тип:</strong> {{ class_basename($seo->seoable_type) }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">SEO Заголовок</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ old('title', $seo->title) }}" maxlength="255">
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
                                        value="{{ old('og_title', $seo->og_title) }}" maxlength="255">
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
                                    <textarea name="description" id="description" class="form-control" rows="4" maxlength="500">{{ old('description', $seo->description) }}</textarea>
                                    <small class="text-muted">Максимум 500 символов</small>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="og_description">OG Описание</label>
                                    <textarea name="og_description" id="og_description" class="form-control" rows="4" maxlength="500">{{ old('og_description', $seo->og_description) }}</textarea>
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
                                        value="{{ old('keywords', $seo->keywords) }}">
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
                                        value="{{ old('og_image', $seo->og_image) }}"
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
                                        value="{{ old('canonical_url', $seo->canonical_url) }}">
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
                                            {{ old('robots', $seo->robots) == 'index,follow' ? 'selected' : '' }}>
                                            index,follow</option>
                                        <option value="noindex,nofollow"
                                            {{ old('robots', $seo->robots) == 'noindex,nofollow' ? 'selected' : '' }}>
                                            noindex,nofollow</option>
                                        <option value="index,nofollow"
                                            {{ old('robots', $seo->robots) == 'index,nofollow' ? 'selected' : '' }}>
                                            index,nofollow</option>
                                        <option value="noindex,follow"
                                            {{ old('robots', $seo->robots) == 'noindex,follow' ? 'selected' : '' }}>
                                            noindex,follow</option>
                                    </select>
                                    @error('robots')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Предварительный просмотр</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="seo-preview">
                                            <div class="seo-title"
                                                style="color: #1a0dab; font-size: 18px; font-weight: 400;">
                                                {{ $seo->title ?: $seo->seoable->getSeoTitle() ?? 'SEO Заголовок' }}
                                            </div>
                                            <div class="seo-url" style="color: #006621; font-size: 14px;">
                                                {{ $seo->canonical_url ?: $seo->seoable->getCanonicalUrl() ?? url()->current() }}
                                            </div>
                                            <div class="seo-description"
                                                style="color: #545454; font-size: 13px; line-height: 1.4;">
                                                {{ $seo->description ?: $seo->seoable->getSeoDescription() ?? 'SEO описание страницы' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Обновить</button>
                            <a href="{{ route('admin.seo.index', ['type' => strtolower(class_basename($seo->seoable_type))]) }}"
                                class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
