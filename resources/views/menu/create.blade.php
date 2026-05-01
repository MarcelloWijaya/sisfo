@extends('layouts.app')

@section('title', 'Create New Menu')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create New Menu</h1>
            <a href="{{ route('menu.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Menu Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('menu.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Menu Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="path">Path / URL</label>
                        <input type="text" name="path" id="path"
                            class="form-control @error('path') is-invalid @enderror" value="{{ old('path', '#') }}"
                            placeholder="Example: /menu or #">
                        <small class="form-text text-muted">Use "#" for parent menu without link</small>
                        @error('path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="parent_id">Parent Menu</label>
                        <select name="parent_id" id="parent_id"
                            class="form-control @error('parent_id') is-invalid @enderror">
                            <option value="">-- As Parent Menu (No Parent) --</option>
                            @foreach ($parentMenus as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Select if this is a sub-menu</small>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="icon">Icon (Font Awesome)</label>
                        <input type="text" name="icon" id="icon" class="form-control"
                            value="{{ old('icon', 'fas fa-circle') }}" placeholder="fas fa-dashboard">
                        <small class="form-text text-muted">
                            Example: fas fa-user, fas fa-cog, fas fa-home.
                            <a href="https://fontawesome.com/v5/icons" target="_blank">FontAwesome Icons</a>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="order">Order / Sort Number</label>
                        <input type="number" name="order" id="order" class="form-control"
                            value="{{ old('order', 0) }}">
                        <small class="form-text text-muted">Lower number appears first</small>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="is_active" value="1" class="custom-control-input"
                                id="is_active" checked>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Menu
                    </button>
                    <a href="{{ route('menu.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
