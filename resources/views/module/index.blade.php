@extends('layouts.app')

@section('title', 'Module Management')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Module Management</h1>
            <a href="{{ route('module.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Module
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Modules</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Module Name</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr>
                                    <td>{{ $module->id }}</td>
                                    <td>{{ $module->name }}</td>
                                    <td>{{ $module->created_by ?? '-' }}</td>
                                    <td>{{ $module->created_at ? $module->created_at->format('d/m/Y H:i') : '-' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteModuleModal{{ $module->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Module Modal -->
                                <div class="modal fade" id="deleteModuleModal{{ $module->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete module
                                                    <strong>{{ $module->name }}</strong>?</p>
                                                <p class="text-danger">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="deleteModule({{ $module->id }})">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteModule(moduleId) {
            $.ajax({
                url: '{{ url('module/delete') }}/' + moduleId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error deleting module');
                }
            });
        }
    </script>
@endsection
