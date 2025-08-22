@extends('admin.layouts.main')

@section('title')Отзывы@endsection

@section('content')
<div class="page-heading">
	<h3>Отзывы</h3>
</div>
<div class="page-content">
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<form class="d-flex gap-2" method="get">
						<select name="is_approved" class="form-select form-select-sm" style="max-width: 180px;">
							<option value="">— Модерация —</option>
							<option value="1" {{ request('is_approved')==='1' ? 'selected' : '' }}>Одобренные</option>
							<option value="0" {{ request('is_approved')==='0' ? 'selected' : '' }}>Не одобренные</option>
						</select>
						<select name="has_additions" class="form-select form-select-sm" style="max-width: 220px;">
							<option value="">— Дополнения —</option>
							<option value="1" {{ request('has_additions')==='1' ? 'selected' : '' }}>С дополнениями</option>
							<option value="0" {{ request('has_additions')==='0' ? 'selected' : '' }}>Без дополнений</option>
						</select>
						<button class="btn btn-primary btn-sm" type="submit">Фильтр</button>
					</form>
					<div class="d-flex align-items-center gap-3">
						<span class="badge bg-danger">Не одобрено: {{ $pendingCount }}</span>
						<span class="badge bg-danger">Дополнения: {{ $pendingAdditionsCount }}</span>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Заголовок</th>
									<th>Оценка</th>
									<th>Комплекс</th>
									<th>Статус</th>
									<th>Дополнения</th>
									<th>Действия</th>
								</tr>
							</thead>
							<tbody>
								@foreach($reviews as $r)
								<tr>
									<td>{{ $r->id }}</td>
									<td>{{ $r->title }}</td>
									<td>{{ $r->rating }}</td>
									<td>{{ $r->complex?->name }}</td>
									<td>
										<span class="badge {{ $r->is_approved ? 'bg-success' : 'bg-warning' }}">{{ $r->is_approved ? 'Одобрен' : 'Ожидает' }}</span>
									</td>
									<td>
										@php($hasAdd = $r->additions->count() > 0)
										<a href="#" class="btn btn-{{ $hasAdd ? 'primary' : 'secondary' }} btn-sm">Дополнения</a>
									</td>
									<td>
										<a href="#" class="btn btn-outline-primary btn-sm">Открыть</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					{{ $reviews->links('admin-pagination') }}
				</div>
			</div>
		</div>
	</section>
</div>
@endsection