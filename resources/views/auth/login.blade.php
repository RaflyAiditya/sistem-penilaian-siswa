<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @section('title')
    {{ "Login" }}
    @endsection

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h3 class="text-center mb-4">Login</h3>
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

        <div class="flex items-center justify-end mt-3">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-between mt-4">
            <div>
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>
            </div>

            <!-- <x-primary-button class="ms-4">
                {{ __('Log in') }}
            </x-primary-button> -->
            <button type="submit" class="btn btn-dark">Log In</button>
        </div>

        <div class="flex items-center justify-center mt-4">
            <span>Belum punya akun?&nbsp;</span>
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('register') }}">
                <!-- {{ __('Register') }} -->
                Register
            </a>
        </div>

    </form>
</x-guest-layout>