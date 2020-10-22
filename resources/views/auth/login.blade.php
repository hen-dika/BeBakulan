<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Store - Your Best Marketplace</title>

    @include('includes.style')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo.svg" alt="" />
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rewards</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="page-content page-auth">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="col-lg-6 text-center">
                        <img src="/images/login-placeholder.png" alt="" class="w-50 mb-4 mb-lg-none"/>
                    </div>
                    <div class="col-lg-5">
                        <h2>
                            Belanja kebutuhan utama, <br />
                            menjadi lebih mudah
                        </h2>
               
                        <form method="POST" action="{{ route('login') }}" class="mt-3">
                        @csrf
                            <div class="form-group">
                                <label>Email address</label>
                                <input id="email" type="email" class="form-control w-75 @error('email') is-invalid @enderror" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control w-75 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success btn-block w-75 mt-4" type="submit" >
                                    Sign In to My Account
                                </button>
                            </div>
                                
                            @if (Route::has('password.request'))
                                <div class="form-group row">
                                    <a class="btn btn-link btn-block w-75" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password ?') }}
                                    </a>
                                </div>
                            @endif

                            <div class="form-group w-75 mt-n4">
                                <p class="text-center">Or</p>
                            </div>
                                
                            <div class="form-group row mt-n3">
                                <a class="btn btn-outline-secondary btn-block" style="width: 70%; margin-left:15px" href="{{ route('register') }}">
                                   Don't have an account ?
                                </a>
                            </div>

                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @include('includes.script')
</body>
</html>
