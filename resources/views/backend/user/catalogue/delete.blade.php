<div class="wrapper wrapper-content">
    @include('backend.dashboard.components.breadcrum', ['title' => $config['seo']['delete']['title']])

    <form action="{{ route('user.catalogue.destroy', $user->id) }}" class="box" method="POST">
        @csrf
        @method('DELETE')
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-12">
                    @if ($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-lg-3">
                    <div class="panel-head">
                        <div class="panel-title">Thông Tin Chung</div>
                        <div class="panel-description">
                            Bạn đang xoá nhóm <strong>{{ $user->name }}</strong>
                        </div>
                        <span class="text-danger">
                            Lưu Ý: Nhóm thành viên sẽ bị xoá vĩnh viễn khỏi hệ thống, không thể khôi phục.
                        </span>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="name">Tên Nhóm Thành Viên</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $user->name ?? '') }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="name">Mô tả </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $user->description ?? '') }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row uk-flex uk-flex-end mr10">
                <button type="submit" class="btn btn-danger">Xoá Nhóm Thành Viên</button>
            </div>
        </div>
    </form>
</div>
