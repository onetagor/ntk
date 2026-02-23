@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Site Settings</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Site Settings</li>
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
                    <div class="card-header">
                        <h3 class="card-title">General Settings</h3>
                    </div>
                    <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="site_name" class="form-label">Site Name</label>
                                        <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                               id="site_name" name="site_name" 
                                               value="{{ old('site_name', $setting->site_name ?? '') }}">
                                        @error('site_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="site_logo" class="form-label">Site Logo</label>
                                        <input type="file" class="form-control @error('site_logo') is-invalid @enderror" 
                                               id="site_logo" name="site_logo" accept="image/*">
                                        @if($setting->site_logo)
                                            <img src="{{ Storage::url($setting->site_logo) }}" 
                                                 alt="Logo" class="mt-2" style="max-height: 50px;">
                                        @endif
                                        @error('site_logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" 
                                               id="phone" name="phone" 
                                               value="{{ old('phone', $setting->phone ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" 
                                               value="{{ old('email', $setting->email ?? '') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="working_hours" class="form-label">Working Hours</label>
                                <input type="text" class="form-control" 
                                       id="working_hours" name="working_hours" 
                                       value="{{ old('working_hours', $setting->working_hours ?? '') }}"
                                       placeholder="e.g., 10:00am - 10:00pm Mon - Sun">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="2">{{ old('address', $setting->address ?? '') }}</textarea>
                            </div>

                            <hr>
                            <h5 class="mb-3">Social Media Links</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="facebook_url" class="form-label">Facebook URL</label>
                                        <input type="url" class="form-control" 
                                               id="facebook_url" name="facebook_url" 
                                               value="{{ old('facebook_url', $setting->facebook_url ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="twitter_url" class="form-label">Twitter URL</label>
                                        <input type="url" class="form-control" 
                                               id="twitter_url" name="twitter_url" 
                                               value="{{ old('twitter_url', $setting->twitter_url ?? '') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                        <input type="url" class="form-control" 
                                               id="linkedin_url" name="linkedin_url" 
                                               value="{{ old('linkedin_url', $setting->linkedin_url ?? '') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="youtube_url" class="form-label">YouTube URL</label>
                                        <input type="url" class="form-control" 
                                               id="youtube_url" name="youtube_url" 
                                               value="{{ old('youtube_url', $setting->youtube_url ?? '') }}">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="mb-3">About Section</h5>

                            <div class="mb-3">
                                <label for="about_description" class="form-label">About Description</label>
                                <textarea class="form-control" id="about_description" name="about_description" rows="4">{{ old('about_description', $setting->about_description ?? '') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="about_image" class="form-label">About Image</label>
                                <input type="file" class="form-control" 
                                       id="about_image" name="about_image" accept="image/*">
                                @if($setting->about_image ?? false)
                                    <img src="{{ Storage::url($setting->about_image) }}" 
                                         alt="About" class="mt-2" style="max-height: 100px;">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="footer_text" class="form-label">Footer Text</label>
                                <input type="text" class="form-control" 
                                       id="footer_text" name="footer_text" 
                                       value="{{ old('footer_text', $setting->footer_text ?? '') }}"
                                       placeholder="COPYRIGHT © {{ date('Y') }}. ALL RIGHTS RESERVED">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
