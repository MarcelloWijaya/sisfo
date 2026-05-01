@extends('layouts.app')

@section('title', 'Center Management')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Center / Branch Management</h1>
            <a href="{{ route('center.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Center
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Centers</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($centers as $center)
                                <tr>
                                    <td>{{ $center->id }}</td>
                                    <td>{{ $center->name }}</td>
                                    <td>{{ $center->owner_name }}</td>
                                    <td>{{ $center->email }}</td>
                                    <td>{{ $center->phone }}</td>
                                    <td>
                                        @if ($center->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('center.detail', $center->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('center.edit', $center->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteCenter({{ $center->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteCenter(id) {
            if (confirm('Delete this center?')) {
                $.ajax({
                    url: '{{ url('center/delete') }}/' + id,
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
