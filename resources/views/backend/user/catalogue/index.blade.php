<div class="wrapper wrapper-content">

    @include('backend.dashboard.components.breadcrum', ['title' => $config['seo']['index']['title']])

    <div class="row mt20">
        <div class="col-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $config['seo']['index']['table'] }}</h5>
                    @include('backend.dashboard.components.toolbox', ['model' => 'UserCatalogue'])
                </div>

                <div class="ibox-content">
                    @include('backend.user.catalogue.components.filter')
                    @include('backend.user.catalogue.components.table')
                </div>
            </div>
        </div>
    </div>
</div>
</div>
