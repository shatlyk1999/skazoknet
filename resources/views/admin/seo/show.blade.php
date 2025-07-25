@extends('admin.layouts.main')

@section('title', 'Просмотр SEO')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Просмотр SEO данных</h3>
                    <p class="text-subtitle text-muted">Детальная информация о SEO</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            SEO: {{ $seo->seoable->name ?? 'N/A' }}
                        </h4>
                        <div>
                            <a href="{{ route('admin.seo.edit', $seo) }}" class="btn btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('admin.seo.index', ['type' => strtolower(class_basename($seo->seoable_type))]) }}"
                                class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Назад
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Основная информация</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Объект:</strong></td>
                                    <td>{{ $seo->seoable->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Тип:</strong></td>
                                    <td>{{ class_basename($seo->seoable_type) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Создано:</strong></td>
                                    <td>{{ $seo->created_at->format('d.m.Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Обновлено:</strong></td>
                                    <td>{{ $seo->updated_at->format('d.m.Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>SEO Настройки</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Robots:</strong></td>
                                    <td>{{ $seo->robots }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Канонический URL:</strong></td>
                                    <td>
                                        @if ($seo->canonical_url)
                                            <a href="{{ $seo->canonical_url }}" target="_blank">
                                                {{ Str::limit($seo->canonical_url, 50) }}
                                            </a>
                                        @else
                                            <span class="text-muted">Не указан</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>SEO Мета данные</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>SEO Заголовок:</strong></label>
                                        <div class="p-2 bg-light rounded">
                                            {{ $seo->title ?: 'Не указан' }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>SEO Описание:</strong></label>
                                        <div class="p-2 bg-light rounded">
                                            {{ $seo->description ?: 'Не указано' }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Ключевые слова:</strong></label>
                                        <div class="p-2 bg-light rounded">
                                            {{ $seo->keywords ?: 'Не указаны' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>OG Заголовок:</strong></label>
                                        <div class="p-2 bg-light rounded">
                                            {{ $seo->og_title ?: 'Не указан' }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>OG Описание:</strong></label>
                                        <div class="p-2 bg-light rounded">
                                            {{ $seo->og_description ?: 'Не указано' }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>OG Изображение:</strong></label>
                                        <div class="p-2 bg-light rounded">
                                            @if ($seo->og_image)
                                                <a href="{{ $seo->og_image }}" target="_blank">
                                                    {{ Str::limit($seo->og_image, 50) }}
                                                </a>
                                            @else
                                                Не указано
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>Предварительный просмотр в поиске</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="seo-preview">
                                        <div class="seo-title"
                                            style="color: #1a0dab; font-size: 18px; font-weight: 400; margin-bottom: 2px;">
                                            {{ $seo->title ?: $seo->seoable->getSeoTitle() ?? 'SEO Заголовок' }}
                                        </div>
                                        <div class="seo-url" style="color: #006621; font-size: 14px; margin-bottom: 2px;">
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
                </div>
            </div>
        </section>
    </div>
@endsection
