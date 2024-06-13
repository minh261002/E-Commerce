<table class="table ">
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
                    <input type="checkbox" class="checkBoxItem" value="{{ $user->id }}">
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td class="js-switch-{{ $user->id }}">
                    <input type="checkbox" value="{{ $user->publish }}" class="js-switch status" data-model="User"
                        data-field="publish" data-modelId="{{ $user->id }}"
                        {{ $user->publish == 1 ? 'checked' : '' }} />
                </td>
                <td>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger delete-item">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links('pagination::bootstrap-4') }}
