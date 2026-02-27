@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Contact Messages</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Contact Messages</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Filter and Search -->
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{ route('admin.contacts.index') }}" method="GET" class="row g-3">
                            <div class="col-md-4">
                                <select name="status" class="form-select">
                                    <option value="all">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied</option>
                                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control" placeholder="Search by name, email, phone..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Pending Messages</h5>
                                <h2>{{ $pendingCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Messages Table -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Message List</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.contacts.export', request()->all()) }}" class="btn btn-success btn-sm">
                                <i class="bi bi-download"></i> Export CSV
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message Preview</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                <tr class="{{ $contact->status == 'pending' ? 'table-warning' : '' }}">
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($contact->message, 50) }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($contact->status == 'pending') bg-warning
                                            @elseif($contact->status == 'replied') bg-success
                                            @else bg-secondary
                                            @endif">
                                            {{ ucfirst($contact->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $contact->created_at->format('d M Y, h:i A') }}</td>
                                    <td>
                                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No contact messages found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
