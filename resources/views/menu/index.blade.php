@extends('layouts.app')

@section('title', 'Menu Management')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Menu Management</h1>
            <a href="{{ route('menu.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Menu
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Menus</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Path</th>
                                <th>Parent</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parentMenus as $menu)
                                <tr style="background-color: #f8f9fc; font-weight: bold;">
                                    <td>{{ $menu->id }}</td>
                                    <td>
                                        <i class="fas fa-folder-open"></i>
                                        {{ $menu->name }}
                                    </td>
                                    <td>{{ $menu->path }}</td>
                                    <td>-</td>
                                    <td>
                                        @if ($menu->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteMenu({{ $menu->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <a href="{{ route('menu.sub.create', $menu->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-plus"></i> Add Sub Menu
                                        </a>
                                    </td>
                                </tr>
                                @foreach ($childMenus->where('parent_id', $menu->id) as $child)
                                    <tr>
                                        <td>{{ $child->id }}</td>
                                        <td style="padding-left: 30px;">
                                            <i class="fas fa-file-alt"></i>
                                            {{ $child->name }}
                                        </td>
                                        <td>{{ $child->path }}</td>
                                        <td>{{ $menu->name }}</td>
                                        <td>
                                            @if ($child->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('menu.edit', $child->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="deleteMenu({{ $child->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteMenu(id) {
            if (confirm('Are you sure you want to delete this menu?')) {
                $.ajax({
                    url: '/menu/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        location.reload();
                    }
                });
            }
        }
    </script>
@endsection
