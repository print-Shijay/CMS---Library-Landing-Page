@extends('layout.app')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4">My Profile</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        {{-- LEFT COLUMN: Profile Info --}}
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-bold">Personal Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        {{-- Read-Only Fields --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted">Full Name</label>
                                <input type="text" class="form-control bg-light" value="{{ $user->name }}" readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted">Email Address</label>
                                <input type="email" class="form-control bg-light" value="{{ $user->email }}" readonly disabled>
                            </div>
                        </div>

                        {{-- Editable Fields --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" value="{{ old('age', $user->age) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sex</label>
                                <select name="sex" class="form-select" required>
                                    <option value="Male" {{ old('sex', $user->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex', $user->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('sex', $user->sex) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" required>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="fw-bold mb-3 text-primary">Social Media Links</h6>
                        
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-facebook me-2"></i>Facebook</label>
                            <input type="url" name="social_media[facebook]" class="form-control" value="{{ old('social_media.facebook', $socials['facebook'] ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-twitter me-2"></i>Twitter</label>
                            <input type="url" name="social_media[twitter]" class="form-control" value="{{ old('social_media.twitter', $socials['twitter'] ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-instagram me-2"></i>Instagram</label>
                            <input type="url" name="social_media[instagram]" class="form-control" value="{{ old('social_media.instagram', $socials['instagram'] ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-github me-2"></i>GitHub</label>
                            <input type="url" name="social_media[github]" class="form-control" value="{{ old('social_media.github', $socials['github'] ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-linkedin me-2"></i>LinkedIn</label>
                            <input type="url" name="social_media[linkedin]" class="form-control" value="{{ old('social_media.linkedin', $socials['linkedin'] ?? '') }}">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Security & Danger Zone --}}
        <div class="col-lg-4">
            {{-- Change Password --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-bold">Change Password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="card border-0 shadow-sm border-danger">
                <div class="card-body">
                    <h5 class="text-danger fw-bold">Delete Account</h5>
                    <p class="small text-muted">Once you delete your account, there is no going back. Please be certain.</p>
                    <button class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        Delete My Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Account Confirmation Modal --}}
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.profile.destroy') }}" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Delete Account</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="fw-bold">Are you absolutely sure you want to delete your account?</p>
                <p class="text-muted small">All your data will be permanently removed. This action cannot be undone.</p>
                
                <div class="mt-3">
                    <label class="form-label">Please enter your password to confirm:</label>
                    <input type="password" name="delete_password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Permanently Delete</button>
            </div>
        </form>
    </div>
</div>
@endsection