<div class="wrapper wrapper-content">
    @include('backend.dashboard.components.breadcrum', ['title' => $config['seo']['create']['title']])

    <form action="" class="box">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="panel-head">
                        <div class="panel-title">Thông Tin Chung</div>
                        <div class="panel-description">Nhập thông tin chung của người sử dụng</div>
                        <span class="text-danger">
                            <i class="fa fa-asterisk"></i> Là trường bắt buộc nhập
                        </span>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">

                                <div class="col-lg-12 mb10">
                                    <div class="form-row">
                                        <label for="avatar">Ảnh Đại Diện</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="name">Họ Và Tên <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="">Nhóm Thành Viên <span class="text-danger">*</span></label>
                                        <select name="user_catalouge_id" class="form-control">
                                            <option value="">Chọn Nhóm Thành Viên</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="birthday">Ngày Sinh</label>
                                        <input type="date" class="form-control" id="birthday" name="birthday">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="password">Mật Khẩu <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="password_confirmation">Nhập Lại Mật Khẩu <span
                                                class="text-danger">*</span></label>
                                        <input type="password_confirmation" class="form-control"
                                            id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="panel-head">
                        <div class="panel-title">Thông Tin Liên Hệ</div>
                        <div class="panel-description">Nhập thông tin chung của người sử dụng</div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">

                                <div class="col-lg-4 mb20">
                                    <div class="form-row">
                                        <label for="">Tỉnh / Thành Phố </label>
                                        <select name="province_id" class="form-control select2 province">
                                            <option value="">Chọn Tỉnh / Thành Phố</option>
                                            @isset($provinces)
                                                @foreach ($provinces as $item)
                                                    <option value="{{ $item->code }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb20">
                                    <div class="form-row">
                                        <label for="">Quận / Huyện </label>
                                        <select name="district_id" class="form-control select2 district">
                                            <option value="">Chọn Quận / Huyện</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb20">
                                    <div class="form-row">
                                        <label for="">Phường / Xã </label>
                                        <select name="ward_id" class="form-control select2 ward">
                                            <option value="">Chọn Phường / Xã</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb20">
                                    <div class="form-row">
                                        <label for="address">Địa Chỉ Cụ Thể</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="phone">Số Điện Thoại</label>
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb20">
                                    <div class="form-row">
                                        <label for="">Ghi Chú</label>
                                        <input type="text" class="form-control" name="note">
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
