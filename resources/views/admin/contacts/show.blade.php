@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Contact Message Details</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contacts</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <!-- Message Details -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Message Information</h3>
                        <div class="card-tools">
                            <span class="badge 
                                @if($contact->status == 'pending') bg-warning
                                @elseif($contact->status == 'replied') bg-success
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($contact->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Name:</th>
                                <td>{{ $contact->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>
                                    @if($contact->phone)
                                        <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Received At:</th>
                                <td>{{ $contact->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </table>

                        <h5 class="mt-4">Message:</h5>
                        <div class="alert alert-light">
                            {{ $contact->message }}
                        </div>

                        @if($contact->admin_reply)
                            <h5 class="mt-4">Admin Reply:</h5>
                            <div class="alert alert-success">
                                {{ $contact->admin_reply }}
                            </div>
                            <p class="text-muted">
                                <small>
                                    Replied by {{ $contact->repliedBy->name ?? 'N/A' }} 
                                    on {{ $contact->replied_at->format('d M Y, h:i A') }}
                                </small>
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Reply Form -->
                @if($contact->status != 'replied')
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Send Reply</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="admin_reply" class="form-label">Reply Message</label>
                                <textarea name="admin_reply" id="admin_reply" rows="5" 
                                          class="form-control @error('admin_reply') is-invalid @enderror" 
                                          required>{{ old('admin_reply') }}</textarea>
                                @error('admin_reply')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-send"></i> Send Reply
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-4">
                <!-- Actions -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Actions</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.contacts.update-status', $contact) }}" method="POST" class="mb-3">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="status" class="form-label">Update Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending" {{ $contact->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="replied" {{ $contact->status == 'replied' ? 'selected' : '' }}>Replied</option>
                                    <option value="archived" {{ $contact->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-check-circle"></i> Update Status
                            </button>
                        </form>

                        <hr>

                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary w-100 mb-2">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>

                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" 
                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                <i class="bi bi-trash"></i> Delete Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
