<table class="table ">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll">
            </th>
            <th>Tên Nhóm Thành Viên</th>
            <th>Mô Tả</th>
            <th>Số Thành Viên</th>
            <th>Trạng Thái</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($userCatalogues as $user)
            <tr>
                <td>
                    <input type="checkbox" class="checkBoxItem" value="{{ $user->id }}">
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->description }}</td>
                <td>
                    {{ $user->users->count() }}
                </td>
                <td class="js-switch-{{ $user->id }}">
                    <input type="checkbox" value="{{ $user->publish }}" class="js-switch status"
                        data-model="UserCatalogue" data-field="publish" data-modelId="{{ $user->id }}"
                        {{ $user->publish == 1 ? 'checked' : '' }} />
                </td>
                <td>
                    <a href="{{ route('user.catalogue.edit', $user->id) }}" class="btn btn-success">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{ route('user.catalogue.delete', $user->id) }}" class="btn btn-danger delete-item">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $userCatalogues->links('pagination::bootstrap-4') }}
