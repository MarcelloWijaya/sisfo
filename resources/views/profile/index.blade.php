@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
            <a href="{{ route('profile.settings') }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Picture</h6>
                    </div>
                    <div class="card-body text-center">
                        <img class="img-profile rounded-circle mb-3" src="{{ asset('template/img/undraw_profile.svg') }}"
                            width="150">
                        <h5>{{ $user->name }}</h5>
                        <p class="text-muted">{{ $user->role->name ?? 'No Role' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Full Name</th>
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
                                        class="badge badge-{{ $user->role->name == 'super_admin' ? 'danger' : ($user->role->name == 'admin' ? 'primary' : 'info') }}">
                                        {{ $user->role->name ?? 'No Role' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Branch</th>
                                <td>{{ $user->branch->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Account Status</th>
                                <td>
                                    @if ($user->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Member Since</th>
                                <td>{{ $user->created_at->format('d F Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
