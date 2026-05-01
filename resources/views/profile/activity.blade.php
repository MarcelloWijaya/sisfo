@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Activity Log</h1>
            <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Profile
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Your Recent Activities</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Activity</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ now()->format('d/m/Y H:i:s') }}</td>
                                <td>Logged in to system</td>
                                <td>{{ request()->ip() }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    <i class="fas fa-info-circle"></i> Activity log feature coming soon...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
