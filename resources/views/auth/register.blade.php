<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Dominion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f8f9fa;
            min-height: 100vh;
        }

        .register-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .register-image {
            background: url('https://img.freepik.com/free-photo/athlete-standing-all-weather-running-track_53876-23896.jpg') center/cover;
            min-height: 100%;
            position: relative;
        }

        .register-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 31, 63, 0.9) 0%, rgba(0, 51, 102, 0.95) 100%);
        }

        .image-content {
            position: relative;
            z-index: 1;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #001f3f;
            box-shadow: 0 0 0 0.2rem rgba(0, 31, 63, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 31, 63, 0.3);
        }

        .brand-logo {
            color: #001f3f;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .brand-icon {
            font-size: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
            font-size: 0.875rem;
        }

        .password-strength {
            height: 3px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card register-card">
                    <div class="row g-0">
                        <!-- Left Side - Form -->
                        <div class="col-md-6">
                            <div class="card-body p-4 p-lg-5">
                                <!-- Brand -->
                                <div class="mb-4">
                                    <div class="brand-logo mb-3">
                                        <span>Dominion</span>
                                    </div>
                                    <h4 class="fw-bold mb-2">Create Your Account</h4>
                                    <p class="text-muted small mb-0">Join the Dominion community today</p>
                                </div>

                                <!-- Success Messages -->
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <!-- Error Messages -->
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-circle me-2"></i>
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <!-- Register Form -->
                                <form method="POST" action="{{ route('register.post') }}" id="registerForm">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="name">
                                                <i class="bi bi-person me-1"></i>Full Name
                                            </label>
                                            <input type="text" id="name" name="name"
                                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" required placeholder="Enter your full name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="username">
                                                <i class="bi bi-at me-1"></i>Username
                                            </label>
                                            <input type="text" id="username" name="username"
                                                class="form-control form-control-sm @error('username') is-invalid @enderror"
                                                value="{{ old('username') }}" required placeholder="Choose a username">
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="email">
                                            <i class="bi bi-envelope me-1"></i>Email Address
                                        </label>
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required placeholder="Enter your email address">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password">
                                            <i class="bi bi-lock me-1"></i>Password
                                        </label>
                                        <div class="position-relative">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                required placeholder="Create a strong password"
                                                onkeyup="checkPasswordStrength()">
                                            <button type="button"
                                                class="btn btn-sm position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                                onclick="togglePassword('password', 'toggleIcon1')">
                                                <i class="bi bi-eye" id="toggleIcon1"></i>
                                            </button>
                                        </div>
                                        <div class="password-strength bg-light mt-1" id="passwordStrength"></div>
                                        <small class="text-muted" style="font-size: 0.75rem;">Password should be at
                                            least 8 characters long</small>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirmation">
                                            <i class="bi bi-lock-fill me-1"></i>Confirm Password
                                        </label>
                                        <div class="position-relative">
                                            <input type="password" id="password_confirmation"
                                                name="password_confirmation" class="form-control form-control-sm"
                                                required placeholder="Confirm your password">
                                            <button type="button"
                                                class="btn btn-sm position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                                onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                                                <i class="bi bi-eye" id="toggleIcon2"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="terms"
                                                id="terms" required>
                                            <label class="form-check-label small" for="terms">
                                                I agree to the <a href="#" class="text-decoration-none">Terms of
                                                    Service</a>
                                                and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-register btn-primary w-100 mb-3">
                                        <i class="bi bi-person-plus me-1"></i>Create Account
                                    </button>
                                </form>

                                <!-- Divider -->
                                <div class="text-center mb-3">
                                    <hr class="my-3">
                                    <span class="text-muted small bg-white px-3">or</span>
                                </div>

                                <!-- Login Link -->
                                <div class="text-center">
                                    <p class="mb-0 small">Already have an account?
                                        <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">
                                            Sign in here
                                        </a>
                                    </p>
                                </div>

                                <!-- Back to Home -->
                                <div class="text-center mt-3">
                                    <a href="{{ route('landingpage') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-arrow-left me-1"></i>Back to Home
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Image -->
                        <div class="col-md-6 d-none d-md-block">
                            <div class="register-image">
                                <div class="image-content">
                                    <h2 class="fw-bold mb-3">Join Our Community</h2>
                                    <p class="lead mb-4">Create an account and get access to exclusive deals and
                                        products.</p>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Exclusive
                                            Member Deals</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Order Tracking
                                            & History</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Personalized
                                            Recommendations</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Priority
                                            Customer Support</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword(fieldId, iconId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('passwordStrength');

            let strength = 0;

            // Check password criteria
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            // Update strength bar
            const strengthLevel = Math.min(strength, 5);
            const colors = ['#dc3545', '#fd7e14', '#ffc107', '#20c997', '#28a745'];
            const widths = ['20%', '40%', '60%', '80%', '100%'];

            if (password.length > 0) {
                strengthBar.style.background = colors[strengthLevel - 1] || colors[0];
                strengthBar.style.width = widths[strengthLevel - 1] || widths[0];
            } else {
                strengthBar.style.background = '#e9ecef';
                strengthBar.style.width = '0%';
            }
        }

        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long!');
                return false;
            }
        });
    </script>
</body>

</html>
