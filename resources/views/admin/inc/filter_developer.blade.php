<form action="{{ route('developer.index.post') }}" method="post">
    @csrf
    <div class="collapse {{ !empty($filter) ? 'show' : '' }}" id="collapseExample">
        <div class="filter d-flex justify-content-between align-items-end">
            <div>
                <label for="name_year">Название или Год основания</label>
                <input type="text" name="name_year" class="form-control" placeholder=""
                    value="{{ isset($filter['name_year']) ? $filter['name_year'] : '' }}">
            </div>
            <div>
                <label for="user_id">Пользователь</label>
                <select name="user_id" id="user_id" class="form-control">
                    <option value="">--</option>
                    @foreach ($developer_users as $user)
                        <option value="{{ $user->id }}" @if (isset($filter['user_id']) && $filter['user_id'] == $user->id) selected @endif>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="city_id">Город</label>
                <select name="city_id" id="city_id" class="form-control">
                    <option value="">--</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" @if (isset($filter['city_id']) && $filter['city_id'] == $city->id) selected @endif>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="image">Логотип</label>
                <select name="image" id="image" class="form-control">
                    <option value="">--</option>
                    <option value="1" @if (isset($filter['image']) && $filter['image'] == '1') selected @endif>
                        Есть
                        логотип</option>
                    <option value="0" @if (isset($filter['image']) && $filter['image'] == '0') selected @endif>Нет
                        логотип</option>
                </select>
            </div>
            <div>
                <label for="popular">Популярный</label>
                <select name="popular" id="popular" class="form-control">
                    <option value="">--</option>
                    <option value="1" @if (isset($filter['popular']) && $filter['popular'] == '1') selected @endif>
                        Популярные</option>
                    <option value="0" @if (isset($filter['popular']) && $filter['popular'] == '0') selected @endif>
                        Непопулярные</option>
                </select>
            </div>
            <div>
                <label for="status">Статус</label>
                <select name="status" id="status" class="form-control">
                    <option value="">--</option>
                    <option value="1" @if (isset($filter['status']) && $filter['status'] == '1') selected @endif>
                        Активный</option>
                    <option value="0" @if (isset($filter['status']) && $filter['status'] == '0') selected @endif>
                        Пассивный</option>
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-end gap-1">
                <div>
                    <button type="submit" class="btn btn-outline-primary">
                        Фильтр
                    </button>
                </div>
                <div>
                    <a href="{{ route('developer.index') }}" class="btn btn-outline-danger">Очистить</a>
                </div>
            </div>
        </div>
    </div>
</form>
