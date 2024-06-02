<table class="table table-striped">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll">
            </th>
            <th>Họ Và Tên</th>
            <th>Email</th>
            <th>Số Điện Thoại</th>
            <th>Địa Chỉ</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    <input type="checkbox" value="">
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>
                    <input type="checkbox" class="js-switch" checked />
                </td>
                <td>
                    <a href="" class="btn btn-success">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links('pagination::bootstrap-4') }}
