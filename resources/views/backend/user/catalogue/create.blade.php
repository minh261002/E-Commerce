<div class="wrapper wrapper-content">
    @include('backend.dashboard.components.breadcrum', ['title' => $config['seo']['create']['title']])

    @php
        $url =
            $config['method'] == 'create'
                ? route('user.catalogue.store')
                : route('user.catalogue.update', $userCatalogue->id);
    @endphp

    <form action="{{ $url }}" class="box" method="POST">
        @csrf
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
                        <div class="panel-description">Nhập thông tin của nhóm thành viên</div>
                        <span class="text-danger">
                            <i class="fa fa-asterisk"></i> Là trường bắt buộc nhập
                        </span>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="name">Tên Nhóm Thành Viên<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $userCatalogue->name ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-30">
                                    <div class="form-row">
                                        <label for="description">Ghi Chú</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                            value="{{ old('description', $userCatalogue->description ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row uk-flex uk-flex-end mr10">
                <button type="submit" class="btn btn-primary">Lưu Thông Tin</button>
            </div>
        </div>
    </form>
</div>

<script>
    var province_id = '{{ isset($user->province_id) ? $user->province_id : old('province_id') }}';
    var district_id = '{{ isset($user->district_id) ? $user->district_id : old('district_id') }}';
    var ward_id = '{{ isset($user->ward_id) ? $user->ward_id : old('ward_id') }}';
</script>
