@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User Details</h1>
            <div>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Picture</h6>
                    </div>
                    <div class="card-body text-center">
                        <i class="fas fa-user-circle fa-5x text-gray-300 mb-3"></i>
                        <h5>{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->role->name ?? 'No Role' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">ID</th>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>
                                    <span
                                        class="badge badge-{{ $user->role->name == 'super_admin' ? 'danger' : 'primary' }}">
                                        {{ ucfirst($user->role->name ?? '-') }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Branch / Center</th>
                                <td>{{ $user->branch->name ?? '-' }}</td>
                            </tr>
                            </tr>
                            <th>Status</th>
                            <td>
                                @if ($user->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i:s') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Created By</th>
                                <td>{{ $user->created_by ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i:s') : '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
