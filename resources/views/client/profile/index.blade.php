@extends('layouts.main')

@section('title', 'My Profile - Dominion Sports Store')

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landingpage') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active">My Profile</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Profile Sidebar -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <!-- Avatar Section -->
                        <div class="position-relative d-inline-block mb-3">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/images/avatar/' . $user->avatar) }}" alt="{{ $user->name }}"
                                    class="rounded-circle border border-3 border-primary" width="120" height="120"
                                    id="avatarPreview" style="object-fit: cover;">
                            @else
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center border border-3 border-primary mx-auto"
                                    style="width: 120px; height: 120px;" id="avatarPreview">
                                    <i class="bi bi-person text-white" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                        </div>

                        <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-2">{{ '@' . $user->username }}</p>
                        <span class="badge bg-success mb-3">
                            <i class="bi bi-check-circle me-1"></i>Active Member
                        </span>

                        <div class="row text-center">
                            <div class="col-6">
                                <div class="border-end">
                                    <h5 class="fw-bold text-primary mb-0">{{ $user->orders()->count() }}</h5>
                                    <small class="text-muted">Orders</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 class="fw-bold text-success mb-0">{{ $user->created_at->diffForHumans() }}</h5>
                                <small class="text-muted">Member Since</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-lightning-charge me-2"></i>Quick Actions
                        </h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('history') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-clock-history me-2"></i>Order History
                            </a>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-success btn-sm">
                                <i class="bi bi-cart3 me-2"></i>View Cart
                            </a>
                            <a href="{{ route('landingpage') }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-house me-2"></i>Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-person-gear me-2"></i>Edit Profile
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Avatar Upload -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-camera me-2"></i>Profile Picture
                                    </label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            @if ($user->avatar)
                                                <img src="{{ asset('storage/images/avatar/' . $user->avatar) }}"
                                                    alt="{{ $user->name }}" class="rounded-circle" width="60"
                                                    height="60" id="avatarThumb" style="object-fit: cover;">
                                            @else
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;" id="avatarThumb">
                                                    <i class="bi bi-person text-white" style="font-size: 1.5rem;"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <input type="file" name="avatar" id="avatar"
                                                class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                                            <small class="text-muted">JPG, PNG, or GIF. Max 2MB.</small>
                                            @error('avatar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-bold">
                                        <i class="bi bi-person me-2"></i>Full Name
                                    </label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label fw-bold">
                                        <i class="bi bi-at me-2"></i>Username
                                    </label>
                                    <input type="text" name="username" id="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username', $user->username) }}" required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-bold">
                                        <i class="bi bi-envelope me-2"></i>Email Address
                                    </label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-bold">
                                        <i class="bi bi-telephone me-2"></i>Phone Number
                                    </label>
                                    <input type="text" name="phone" id="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $user->phone) }}" placeholder="+62 812 3456 7890">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold">
                                    <i class="bi bi-geo-alt me-2"></i>Address
                                </label>
                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3"
                                    placeholder="Enter your complete address">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-gender-ambiguous me-2"></i>Gender
                                    </label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male"
                                                value="M" {{ old('gender', $user->gender) == 'M' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="male">
                                                <i class="bi bi-person me-1"></i>Male
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female"
                                                value="F" {{ old('gender', $user->gender) == 'F' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="female">
                                                <i class="bi bi-person-dress me-1"></i>Female
                                            </label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label fw-bold">
                                        <i class="bi bi-calendar-date me-2"></i>Date of Birth
                                    </label>
                                    <input type="date" name="dob" id="dob"
                                        class="form-control @error('dob') is-invalid @enderror"
                                        value="{{ old('dob', $user->dob?->format('Y-m-d')) }}">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Section -->
                            <hr class="my-4">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-shield-lock me-2"></i>Change Password (Optional)
                            </h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-bold">New Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Leave blank to keep current password">
                                        <button type="button"
                                            class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                            onclick="togglePasswordVisibility('password', 'togglePassword1')">
                                            <i class="bi bi-eye" id="togglePassword1"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" placeholder="Confirm your new password">
                                        <button type="button"
                                            class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                            onclick="togglePasswordVisibility('password_confirmation', 'togglePassword2')">
                                            <i class="bi bi-eye" id="togglePassword2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('landingpage') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-save me-2"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card {
                border-radius: 15px;
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
            }

            .form-check-input:checked {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Avatar preview
            document.getElementById('avatar').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const avatarPreview = document.getElementById('avatarPreview');
                        const avatarThumb = document.getElementById('avatarThumb');

                        if (avatarPreview.tagName === 'IMG') {
                            avatarPreview.src = e.target.result;
                        } else {
                            avatarPreview.innerHTML =
                                `<img src="${e.target.result}" class="rounded-circle border border-3 border-primary" width="120" height="120" style="object-fit: cover;">`;
                        }

                        if (avatarThumb.tagName === 'IMG') {
                            avatarThumb.src = e.target.result;
                        } else {
                            avatarThumb.innerHTML =
                                `<img src="${e.target.result}" class="rounded-circle" width="60" height="60" style="object-fit: cover;">`;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Password visibility toggle
            function togglePasswordVisibility(inputId, iconId) {
                const passwordInput = document.getElementById(inputId);
                const toggleIcon = document.getElementById(iconId);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.className = 'bi bi-eye-slash';
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.className = 'bi bi-eye';
                }
            }
        </script>
    @endpush
@endsection
