@extends('layouts.app')

@section('title', 'Manage Permissions for ' . ucfirst($role->name))

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Manage Permissions for <span class="text-primary">{{ ucfirst($role->name) }}</span>
            </h1>
            <a href="{{ route('role.permission.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Assign Permissions to {{ ucfirst($role->name) }}</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('role.permission.sync', $role->id) }}" method="POST">
                            @csrf

                            @foreach ($menus as $menu)
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <strong>
                                            <i class="fas {{ $menu->icon ?? 'fa-folder' }}"></i>
                                            {{ $menu->name }}
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($permissions as $permission)
                                                @php
                                                    $checked =
                                                        isset($assignedPermissions[$menu->id]) &&
                                                        in_array(
                                                            $permission->id,
                                                            $assignedPermissions[$menu->id]
                                                                ->pluck('permission_id')
                                                                ->toArray(),
                                                        );
                                                @endphp
                                                <div class="col-md-3 mb-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            name="permissions[{{ $menu->id }}][]"
                                                            value="{{ $permission->id }}"
                                                            id="perm_{{ $menu->id }}_{{ $permission->id }}"
                                                            {{ $checked ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="perm_{{ $menu->id }}_{{ $permission->id }}">
                                                            {{ ucfirst($permission->name) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save"></i> Save Permissions
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Select All functionality
        $(document).ready(function() {
            $('.select-all').on('click', function() {
                var cardBody = $(this).closest('.card').find('.card-body');
                cardBody.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
            });
        });
    </script>
@endsection
