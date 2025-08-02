@extends('admin.layouts.main')

@section('title', 'SEO Управление')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>SEO Управление</h3>
                    <p class="text-subtitle text-muted">Управление SEO мета данными</p>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            SEO Мета данные -
                            @if ($type == 'complex')
                                Комплексы
                            @elseif($type == 'developer')
                                Застройщики
                            @elseif($type == 'city')
                                Города
                            @endif
                        </h4>
                        <div>
                            <div class="btn-group me-2">
                                <a href="{{ route('admin.seo.index', ['type' => 'complex']) }}"
                                    class="btn btn-sm {{ $type == 'complex' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Комплексы
                                </a>
                                <a href="{{ route('admin.seo.index', ['type' => 'developer']) }}"
                                    class="btn btn-sm {{ $type == 'developer' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Застройщики
                                </a>
                                <a href="{{ route('admin.seo.index', ['type' => 'city']) }}"
                                    class="btn btn-sm {{ $type == 'city' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Города
                                </a>
                            </div>
                            <a href="{{ route('admin.seo.create', ['type' => $type]) }}" class="btn btn-primary">
                                <i class="bi bi-plus"></i> Добавить SEO
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Объект</th>
                                    <th>SEO Заголовок</th>
                                    <th>Описание</th>
                                    <th>Ключевые слова</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($seoMetas as $seoMeta)
                                    <tr>
                                        <td>
                                            <strong>{{ $seoMeta->seoable->name ?? 'N/A' }}</strong>
                                        </td>
                                        <td>
                                            {{ Str::limit($seoMeta->title, 50) }}
                                        </td>
                                        <td>
                                            {{ Str::limit($seoMeta->description, 80) }}
                                        </td>
                                        <td>
                                            {{ Str::limit($seoMeta->keywords, 40) }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.seo.edit', $seoMeta) }}"
                                                class="btn btn-outline-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.seo.destroy', $seoMeta) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Удалить SEO данные?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Нет SEO данных</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $seoMetas->appends(request()->query())->links('admin-pagination') }}
                </div>
            </div>
        </section>
    </div>
@endsection
