@extends('layouts.app')

@section('title', 'Role Management')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Role Management</h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addRoleModal">
                <i class="fas fa-plus"></i> Add New Role
            </button>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Users Count</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>

                                    <td>
                                        <span
                                            class="badge badge-{{ $role->name == 'super_admin' ? 'danger' : ($role->name == 'admin' ? 'primary' : 'info') }}">
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        </span>
                                    </td>

                                    <td>{{ $role->users_count ?? $role->users->count() }} users</td>
                                    <td>{{ $role->created_at ? $role->created_at->format('d/m/Y H:i') : '-' }}</td>
                                    <td>{{ $role->created_by ?? '-' }}</td>

                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal"
                                            data-target="#editRoleModal{{ $role->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        @if ($role->name != 'super_admin')
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#deleteRoleModal{{ $role->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Role Modal (DI LUAR LOOP, setelah tag penutup tbody/table) -->
    <div class="modal fade" id="addRoleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addRoleForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Role</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Role Name</label>
                            <input type="text" name="name" id="new_role_name" class="form-control" required
                                placeholder="e.g: staff, finance, etc">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="confirmAdd()">
                            <i class="fas fa-save"></i> Save Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Confirmation Modal -->
    <div class="modal fade" id="confirmAddModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Create</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to create new role <strong id="confirm_role_name"></strong>?</p>
                    <p class="text-warning">Please double-check before confirming.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="submitAdd()">
                        <i class="fas fa-check"></i> Confirm Create
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ===========================
MODALS DI LUAR TABLE
=========================== --}}
    @foreach ($roles as $role)
        {{-- EDIT ROLE MODAL --}}
        <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <form id="editRoleForm{{ $role->id }}">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title">Edit Role</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" class="form-control" name="name"
                                    id="role_name_{{ $role->id }}" value="{{ $role->name }}">
                            </div>

                            <hr>

                            {{-- MODULE HANYA DI SINI --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <strong>Modules Assigned</strong>

                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#addModuleModal{{ $role->id }}">
                                    <i class="fas fa-plus"></i> Add Module
                                </button>
                            </div>

                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Module Name</th>
                                        <th width="80">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $roleModules = \App\Models\RoleModule::where('role_id', $role->id)
                                            ->with('module')
                                            ->get();
                                    @endphp

                                    @forelse($roleModules as $row)
                                        <tr>
                                            <td>{{ $row->module->name ?? '-' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeModule({{ $role->id }},{{ $row->module_id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">
                                                No modules assigned
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <button type="button" class="btn btn-primary" onclick="confirmEdit({{ $role->id }})">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>


        {{-- ADD MODULE MODAL --}}
        <div class="modal fade" id="addModuleModal{{ $role->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Add Module to {{ ucfirst($role->name) }}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">

                        <!-- Search Box -->
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <input type="text" id="searchModule{{ $role->id }}" class="form-control"
                                    placeholder="Search module name...">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button"
                                        onclick="resetSearch({{ $role->id }})">
                                        <i class="fas fa-undo-alt"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Table Modules -->
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered table-hover" id="moduleTable{{ $role->id }}">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px">
                                            <input type="checkbox" id="selectAll{{ $role->id }}"
                                                onclick="selectAll({{ $role->id }})">
                                        </th>
                                        <th>Module Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $hasModule = false;
                                    @endphp

                                    @foreach ($modules as $module)
                                        @php
                                            $exists = \App\Models\RoleModule::where('role_id', $role->id)
                                                ->where('module_id', $module->id)
                                                ->exists();
                                        @endphp

                                        @if (!$exists)
                                            @php $hasModule = true; @endphp
                                            <tr class="module-row-{{ $role->id }}">
                                                <td class="text-center">
                                                    <input type="checkbox" class="module-checkbox-{{ $role->id }}"
                                                        id="module_{{ $role->id }}_{{ $module->id }}"
                                                        value="{{ $module->id }}">
                                                </td>
                                                <td>
                                                    <label for="module_{{ $role->id }}_{{ $module->id }}"
                                                        style="cursor: pointer; margin: 0; width: 100%; display: block;">
                                                        {{ $module->name }}
                                                    </label>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @if (!$hasModule)
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">
                                                All modules already assigned to this role
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                        </button>
                        <button class="btn btn-primary" onclick="addModule({{ $role->id }})">
                            <i class="fas fa-plus"></i> Add Selected
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- DELETE MODAL --}}
        <div class="modal fade" id="deleteRoleModal{{ $role->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>Delete Role</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        Delete role <strong>{{ $role->name }}</strong> ?
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        <button class="btn btn-danger" onclick="deleteRole({{ $role->id }})">
                            Delete
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    <script>
        // ADD ROLE CONFIRMATION
        function confirmAdd() {
            var roleName = document.getElementById('new_role_name').value;
            if (!roleName) {
                alert('Please enter role name');
                return;
            }
            document.getElementById('confirm_role_name').innerText = roleName;
            $('#addRoleModal').modal('hide');
            $('#confirmAddModal').modal('show');
        }

        function submitAdd() {
            var form = document.getElementById('addRoleForm');
            var formData = new FormData(form);

            $.ajax({
                url: '{{ route('role.store') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#confirmAddModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
                }
            });
        }

        // EDIT ROLE CONFIRMATION
        function confirmEdit(roleId) {
            var newName = document.getElementById('role_name_' + roleId).value;
            var oldName = document.getElementById('old_role_name_' + roleId).innerText;

            if (!newName) {
                alert('Please enter role name');
                return;
            }

            if (newName === oldName) {
                alert('No changes made to role name');
                $('#editRoleModal' + roleId).modal('hide');
                return;
            }

            document.getElementById('new_role_name_' + roleId).innerText = newName;
            $('#editRoleModal' + roleId).modal('hide');
            $('#confirmEditModal' + roleId).modal('show');
        }

        function submitEdit(roleId) {
            var form = document.getElementById('editRoleForm' + roleId);
            var formData = new FormData(form);

            $.ajax({
                url: '{{ url('role/update') }}/' + roleId,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#confirmEditModal' + roleId).modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
                }
            });
        }

        // DELETE ROLE FUNCTION
        function deleteRole(roleId) {
            $.ajax({
                url: '{{ url('role/delete') }}/' + roleId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#deleteRoleModal' + roleId).modal('hide');
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error deleting role');
                }
            });
        }

        // Search function
        function searchModule(roleId) {
            var input = document.getElementById('searchModule' + roleId);
            var filter = input.value.toLowerCase();
            var rows = document.querySelectorAll('.module-row-' + roleId);

            rows.forEach(function(row) {
                var moduleName = row.querySelector('td:last-child').innerText.toLowerCase();
                if (moduleName.indexOf(filter) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Reset search
        function resetSearch(roleId) {
            var input = document.getElementById('searchModule' + roleId);
            input.value = '';
            searchModule(roleId);
        }

        // Select All function
        function selectAll(roleId) {
            var selectAllCheckbox = document.getElementById('selectAll' + roleId);
            var checkboxes = document.querySelectorAll('.module-checkbox-' + roleId);

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }

        // Add Module function
        function addModule(roleId) {
            var selectedModules = [];
            var checkboxes = document.querySelectorAll('.module-checkbox-' + roleId + ':checked');

            checkboxes.forEach(function(checkbox) {
                selectedModules.push(checkbox.value);
            });

            if (selectedModules.length === 0) {
                alert('Please select at least one module');
                return;
            }

            console.log('Selected modules:', selectedModules); // Debug

            $.ajax({
                url: '/role/add-module/' + roleId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    module_ids: selectedModules
                },
                success: function(response) {
                    console.log('Response:', response);
                    if (response.success) {
                        $('#addModuleModal' + roleId).modal('hide');
                        location.reload();
                    } else {
                        alert(response.message || 'Error adding module');
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                    var errorMsg = xhr.responseJSON?.message || 'Error adding module';
                    alert(errorMsg);
                }
            });
        }

        // Attach search event listener
        document.getElementById('searchModule{{ $role->id }}')?.addEventListener('keyup', function() {
            searchModule({{ $role->id }});
        });
    </script>
@endsection
