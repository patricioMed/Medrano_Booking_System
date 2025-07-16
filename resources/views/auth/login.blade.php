<x-guest-layout>
    <style>
        body {
            background: #000;
            background-image: linear-gradient(145deg, #0f0f0f, #1a1a1a);
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        label {
            color: #fff;
        }

        input[type="email"],
        input[type="password"] {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            margin-top: 8px;
        }

        input::placeholder {
            color: #ccc;
        }

        .checkbox-label {
            color: #ccc;
        }

        .forgot-link,
        .register-link {
            color: #fff;
            text-decoration: underline;
        }

        .forgot-link:hover,
        .register-link:hover {
            color: #bbb;
        }

        .primary-button {
            background: #6366f1;
            color: white;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .primary-button:hover {
            background: #4f46e5;
        }

        .register-button {
            background: white;
            color: black;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .register-button:hover {
            background: #f3f3f3;
        }
    </style>

    <div class="login-container">
        <div class="glass-card">
            <h2>Login to Your Account</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center checkbox-label">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm forgot-link" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="primary-button">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Register Button -->
            <div class="text-center mt-6">
                <a href="{{ route('register') }}" class="register-button inline-block">
                    {{ __('Register') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
