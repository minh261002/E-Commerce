<div class="wrapper wrapper-content">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ config('app.user.title') }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard.index') }}">Trang Chủ</a>
                </li>
                <li class="active">
                    <strong>{{ config('app.user.title') }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row mt20">
        <div class="col-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Danh Sách Thành Viên</h5>
                    @include('backend.user.components.toolbox')
                </div>

                <div class="ibox-content">
                    @include('backend.user.components.filter')
                    @include('backend.user.components.table')
                </div>
            </div>
        </div>
    </div>
</div>
</div>
