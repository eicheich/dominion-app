<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: rgb(255, 255, 255);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text">
                                        <img src="https://i.ibb.co/VN43vPz/Dominion.png" style="width: 120px;"
                                            alt="logo">
                                        <br>
                                        <h4 class="mt-5 text-center">Welcome Back! </h4>
                                        <h5 class="text-center mb-5 pb-5" style="color: grey">Please login to your
                                            account</h5>
                                    </div>

                                    <form method="POST" action="{{ route('login.post') }}">
                                        @csrf
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" id="username" name="username" class="form-control"
                                                required placeholder="Username or email address" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                required placeholder="Password" />
                                        </div>

                                        <div class="text-center pt-1 pb-1 ">
                                            <button type="submit"
                                                class="btn btn-primary w-50 btn-block fa-lg gradient-custom-2 mb-3"
                                                type="button">Log
                                                in</button>
                                        </div>
                                        <div class="text-center mb-5 pb-5">
                                            <a class="text-muted" href="#!">Forgot password?</a>

                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <a class="text-muted" style="color: " href="{{ route('register') }}">Sign
                                                Up</a>

                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Body and Mind in perfect balance</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                        do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>

</body>

</html>
