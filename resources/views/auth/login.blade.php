<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Dominion</title>
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

        .login-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-image {
            background: url('https://img.freepik.com/free-photo/athlete-standing-all-weather-running-track_53876-23896.jpg') center/cover;
            min-height: 100%;
            position: relative;
        }

        .login-image::before {
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

        .btn-login {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
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
    </style>
</head>

<body class="d-flex align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card login-card">
                    <div class="row g-0">
                        <!-- Left Side - Form -->
                        <div class="col-md-6">
                            <div class="card-body p-4 p-lg-5">
                                <!-- Brand -->
                                <div class="mb-4">
                                    <div class="brand-logo mb-3">
                                        <span>Dominion</span>
                                    </div>
                                    <h4 class="fw-bold mb-2">Welcome Back!</h4>
                                    <p class="text-muted small mb-0">Please sign in to your account</p>
                                </div>

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

                                <!-- Login Form -->
                                <form method="POST" action="{{ route('login.post') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold small" for="username">
                                            <i class="bi bi-person me-1"></i>Username
                                        </label>
                                        <input type="text" id="username" name="username"
                                            class="form-control form-control-sm @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" required
                                            placeholder="Enter your username">
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold small" for="password">
                                            <i class="bi bi-lock me-1"></i>Password
                                        </label>
                                        <div class="position-relative">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                required placeholder="Enter your password">
                                            <button type="button"
                                                class="btn btn-sm position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                                onclick="togglePassword()">
                                                <i class="bi bi-eye" id="toggleIcon"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember">
                                            <label class="form-check-label small" for="remember">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-login btn-primary w-100 mb-3">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>Sign In
                                    </button>
                                </form>

                                <!-- Divider -->
                                <div class="text-center mb-3">
                                    <hr class="my-3">
                                    <span class="text-muted small bg-white px-3">or</span>
                                </div>

                                <!-- Register Link -->
                                <div class="text-center">
                                    <p class="mb-0 small">Don't have an account?
                                        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                            Create one here
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
                            <div class="login-image">
                                <div class="image-content">
                                    <h2 class="fw-bold mb-3">Start Your Journey</h2>
                                    <p class="lead mb-4">Join thousands of athletes who trust Dominion for their
                                        equipment needs.</p>
                                    equipment needs.</p>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Premium Quality
                                            Products</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Fast & Secure
                                            Delivery</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Expert Customer
                                            Support</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill me-2"></i>Best Price
                                            Guarantee</li>
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
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'bi bi-eye';
            }
        }
    </script>
</body>

</html>
