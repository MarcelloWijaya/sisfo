@extends('layouts.app')

@section('title', 'Add New Permission')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Permission</h1>
            <a href="{{ route('permission.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Permission Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Permission Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required
                            placeholder="e.g: view, create, edit, delete">
                        <small class="form-text text-muted">Example: view, create, edit, delete, export, import</small>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Permission
                    </button>
                    <a href="{{ route('permission.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
