@extends('layouts.app')

@section('title', 'Give User Access')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Give User Access</h1>
            <a href="{{ route('role') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Role Management
            </a>
        </div>

        <!-- User Info Card -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-user-circle fa-4x text-gray-300"></i>
                        </div>
                        <table class="table table-borderless">
                            <tr>
                                <th width="35%">Name:</th>
                                <td><strong>{{ $user->name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if ($user->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Created At:</th>
                                <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Assign Role & Access</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updateuser', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Role Selection -->
                            <div class="form-group">
                                <label for="role_id">Select Role <span class="text-danger">*</span></label>
                                <select name="role_id" id="role_id"
                                    class="form-control @error('role_id') is-invalid @enderror" required>
                                    <option value="">-- Select Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Branch/Center Selection -->
                            <div class="form-group">
                                <label for="branch_id">Assign Branch / Center</label>
                                <select name="branch_id" id="branch_id"
                                    class="form-control @error('branch_id') is-invalid @enderror">
                                    <option value="">-- Select Branch (Optional) --</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ old('branch_id', $user->branch_id) == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Assign which branch this user belongs to (if
                                    applicable).</small>
                                @error('branch_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Selection -->
                            <div class="form-group">
                                <label for="is_active">Account Status</label>
                                <select name="is_active" id="is_active"
                                    class="form-control @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role Description / Info -->
                            <div class="alert alert-info mt-3" id="roleInfo">
                                <i class="fas fa-info-circle"></i>
                                <strong>Role Information:</strong>
                                <ul class="mb-0 mt-2">
                                    <li><strong>Super Admin:</strong> Full access to all features including user management,
                                        settings, and system configuration.</li>
                                    <li><strong>Admin:</strong> Can manage students, teachers, classes, payments, and
                                        attendance.</li>
                                    <li><strong>Director:</strong> Can view reports and analytics, monitoring only (no
                                        edit/delete).</li>
                                </ul>
                            </div>

                            <hr>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save & Give Access
                                </button>
                                <a href="{{ route('role') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Access History (Optional) -->
        @if ($user->role_id)
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Access History</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Action</th>
                                            <th>Previous Role</th>
                                            <th>New Role</th>
                                            <th>By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($accessHistory ?? [] as $history)
                                            <tr>
                                                <td>{{ $history->created_at->format('d M Y H:i') }}</td>
                                                <td>{{ ucfirst($history->action) }}</td>
                                                <td>{{ $history->old_role ?? '-' }}</td>
                                                <td>{{ $history->new_role ?? '-' }}</td>
                                                <td>{{ $history->updated_by ?? '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No access history available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Update role info when role selection changes
                $('#role_id').on('change', function() {
                    var roleName = $(this).find('option:selected').text().toLowerCase();
                    var infoHtml =
                        '<i class="fas fa-info-circle"></i> <strong>Role Information:</strong><ul class="mb-0 mt-2">';

                    if (roleName === 'super_admin') {
                        infoHtml +=
                            '<li><strong>Super Admin:</strong> Full access to all features including user management, settings, and system configuration.</li>';
                        infoHtml += '<li>✅ Can create/edit/delete users</li>';
                        infoHtml += '<li>✅ Can manage roles and permissions</li>';
                        infoHtml += '<li>✅ Can view all reports</li>';
                        infoHtml += '<li>✅ Can manage system settings</li>';
                    } else if (roleName === 'admin') {
                        infoHtml +=
                            '<li><strong>Admin:</strong> Can manage students, teachers, classes, payments, and attendance.</li>';
                        infoHtml += '<li>✅ Can manage students and teachers</li>';
                        infoHtml += '<li>✅ Can manage classes and schedules</li>';
                        infoHtml += '<li>✅ Can process payments</li>';
                        infoHtml += '<li>✅ Can record attendance</li>';
                        infoHtml += '<li>❌ Cannot manage users or roles</li>';
                        infoHtml += '<li>❌ Cannot change system settings</li>';
                    } else if (roleName === 'director') {
                        infoHtml +=
                            '<li><strong>Director:</strong> Can view reports and analytics, monitoring only (no edit/delete).</li>';
                        infoHtml += '<li>✅ Can view dashboard</li>';
                        infoHtml += '<li>✅ Can view financial reports</li>';
                        infoHtml += '<li>✅ Can view student reports</li>';
                        infoHtml += '<li>✅ Can view attendance reports</li>';
                        infoHtml += '<li>❌ Cannot edit or delete data</li>';
                        infoHtml += '<li>❌ Cannot process payments</li>';
                    } else {
                        infoHtml +=
                            '<li class="text-warning">No specific permissions for this role. Please assign appropriate permissions.</li>';
                    }

                    infoHtml += '</ul>';
                    $('#roleInfo').html(infoHtml);
                });

                // Trigger change on page load
                $('#role_id').trigger('change');
            });
        </script>
    @endpush
@endsection
