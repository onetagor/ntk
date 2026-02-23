@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Create Role</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Role Name *</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" 
                                       value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Permissions *</label>
                                @error('permissions')
                                    <div class="text-danger mb-2">{{ $message }}</div>
                                @enderror
                                
                                @foreach($groupedPermissions as $module => $modulePermissions)
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="bi bi-folder"></i> {{ ucfirst($module) }}
                                            <div class="form-check form-check-inline float-end">
                                                <input class="form-check-input select-all-module" 
                                                       type="checkbox" 
                                                       data-module="{{ $module }}">
                                                <label class="form-check-label">Select All</label>
                                            </div>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($modulePermissions as $permission)
                                            <div class="col-md-3 col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input permission-checkbox module-{{ $module }}" 
                                                           type="checkbox" 
                                                           name="permissions[]" 
                                                           value="{{ $permission->name }}" 
                                                           id="permission_{{ $permission->id }}"
                                                           {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                        {{ ucwords(str_replace(['-', '_'], ' ', $permission->name)) }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Create Role
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle "Select All" checkboxes
    document.querySelectorAll('.select-all-module').forEach(function(selectAll) {
        selectAll.addEventListener('change', function() {
            const module = this.dataset.module;
            const checkboxes = document.querySelectorAll('.module-' + module);
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAll.checked;
            });
        });
    });

    // Update "Select All" state when individual checkboxes change
    document.querySelectorAll('.permission-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const moduleClass = Array.from(this.classList).find(c => c.startsWith('module-'));
            if (moduleClass) {
                const module = moduleClass.replace('module-', '');
                const allCheckboxes = document.querySelectorAll('.module-' + module);
                const checkedCheckboxes = document.querySelectorAll('.module-' + module + ':checked');
                const selectAll = document.querySelector('.select-all-module[data-module="' + module + '"]');
                selectAll.checked = allCheckboxes.length === checkedCheckboxes.length;
            }
        });
    });
});
</script>
@endpush
@endsection
