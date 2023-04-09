{{-- <x-admin-guest-layout>
    <!-- Session Status -->
    <h3>Admin Login</h3>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('admin.password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-admin-guest-layout> --}}



<html>

<head>
    <meta http-equiv="Refresh" content=“6; url=https://pawsthedogsplanet.com/“ />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <style>
        body {
            margin: 0;
            padding: 0;

        }

        #zoom-In:hover {
            transform: scale(1.3);
            cursor: pointer;
        }

        .image {
            display: block;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        #zoom-In {
            transform: scale(1);
            transition: 0.8s ease-in-out;
        }

        .container img {
            height: 15%;
            width: 60%;
        }

        @keyframes example {
            from {
                top: 320px;
            }

            to {
                top: 0px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="container">
            <div class="card card-container">
                <h5 class="text-center mb-3">Admin Login</h5>
                <div id="zoom-In" class="image">

                    <img style="margin-bottom: 30px;"; src="{{asset('assets/images/police/head-png.png')}}"
                        class="rounded mx-auto d-block "alt="...">
                </div>

                <form method="POST" action="{{ route('admin.login') }}" >
                    @csrf
                    <fieldset class="clearfix">

                        <p>
                            <span class="fontawesome-user"></span>
                            <input class="form-control" type="email" name="email" placeholder="Enter Email">
                        </p>
                        <p>
                            <span class="fontawesome-lock"></span>
                            <input class="form-control" type="password" name="password" placeholder="Enter Password">
                        </p>
                        <p>
                            <input class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login"
                                value="LogIn">
                        </p>

                    </fieldset>

                </form>
            </div>
        </div>
    </div>
</body>

</html>
