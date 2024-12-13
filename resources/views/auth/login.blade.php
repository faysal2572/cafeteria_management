<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with UrbanTable landing page.">
    <meta name="author" content="Devcrud">
    <title>Urban Table | Login</title>
   
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">

    <link rel="stylesheet" href="assets/vendors/animate/animate.css">

    <!-- Bootstrap + UrbanTable main styles -->
	<link rel="stylesheet" href="assets/css/urbantable.css">
</head>


<body id="login-page">   
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession     
    <!-- Navbar -->
    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="assets/imgs/logo2.png" class="brand-img" alt="">
            <span class="brand-txt">Food Hut</span>
        </a>
    </nav>

    <!-- Login Section -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <h3 class="text-center mb-4">Login to UrbanTable</h3>
            
        <form method="POST" action="{{ route('login') }}">
        @csrf
            
            <!-- Email -->
            <div class="form-group">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            
            <!-- Password -->
            <div class="form-group">
            <x-label for="password" value="{{ __('Password') }}" />
            <x-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!--remember me button -->
            <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <x-checkbox id="remember_me" name="remember" />
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
            
            <!-- Submit Button -->
            <div class="form-group">
            <x-button class="btn btn-primary btn-block">
                {{ __('Log in') }}
            </x-button>
            </div>
            
            

            <!-- Additional Links -->
            <p class="text-center">
                <a href="{{ route('register') }}" class="text-primary">Don't have an account? Register</a>
            </p>

            <p class="text-center">
                <a href="/forgot-password" class="text-primary">Forgot your password?</a>
            </p>
        </form>
            </x-authentication-card>
            </x-guest-layout>
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>
</body>
</html>
