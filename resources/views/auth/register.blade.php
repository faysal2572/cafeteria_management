<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with UrbanTable landing page.">
    <meta name="author" content="Devcrud">
    <title>Urban Table | Registration</title>
   
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">

    <link rel="stylesheet" href="assets/vendors/animate/animate.css">

    <!-- Bootstrap + UrbanTable main styles -->
	<link rel="stylesheet" href="assets/css/urbantable.css">
</head>

<body id="registration-page"></body>


<x-guest-layout>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <!-- Navbar -->
        <nav class="custom-navbar navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="index.html">
            <img src="assets/imgs/logo2.png" class="brand-img" alt="UrbanTable Logo">
            <span class="brand-txt">UrbanTable</span>
        </a>
        </nav>   
    <!-- Registration Section -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 450px;">
            <h3 class="text-center mb-4">Register for UrbanTable</h3> 


        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="form-control custom-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="form-group mt-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="form-control custom-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="form-group mt-3">
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="phone" class="form-control custom-input" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            </div>

            <div class="form-group mt-3">
                <x-label for="address" value="{{ __('Address') }}" />
                <x-input id="address" class="form-control custom-input" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
            </div>


            <div class="form-group mt-3">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="form-control custom-input" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="form-group mt-3">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="form-control custom-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="form-group mt-3 text center ">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="btn btn-primary btn-block">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        </div>
    </div>        

</x-guest-layout>

<!-- Scripts -->
<script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
<script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

</body>
</html>