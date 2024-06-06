<form action="{{ route('user.index') }}" method="GET">

    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="perpage">
                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <select name="perpage" class="form-control input-sm perpage filter mr10">
                        @for ($i = 10; $i <= 200; $i += 10)
                            <option value="{{ $i }}" {{ $i == request()->get('perpage') ? 'selected' : '' }}>
                                {{ $i }} Bản Ghi
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    <select name="user_catalouge_id" class="form-control mr10">
                        <option value="0" selected>Chọn Nhóm Thành Viên</option>
                        <option value="1">Quản Trị Viên</option>
                    </select>

                    <div class="uk-search uk-flex uk-flex-middle mr10">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm Kiếm "
                                value="{{ request('keyword') ?: old('keyword') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>

                    <a href="{{ route('user.create') }}" class="btn btn-danger">Thêm Thành Viên Mới
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</form>
