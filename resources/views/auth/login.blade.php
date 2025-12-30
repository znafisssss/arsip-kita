<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome Back! ❄️</h2>
        <p class="text-gray-600">Sign in to your frozen archive</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input id="email" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/70 border border-blue-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="your@email.com"
                   required 
                   autofocus 
                   autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input id="password" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/70 border border-blue-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition"
                   type="password"
                   name="password"
                   placeholder="••••••••"
                   required 
                   autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" 
                       type="checkbox" 
                       class="rounded bg-white/70 border-blue-200 text-blue-500 shadow-sm focus:ring-blue-400 focus:ring-offset-0" 
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit" 
                    class="w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-bold rounded-lg hover:from-blue-600 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition transform hover:scale-105 shadow-lg">
                🔐 {{ __('Log in') }}
            </button>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-blue-600 underline transition" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif

            @if (Route::has('register'))
                <a class="text-sm text-gray-600 hover:text-blue-600 underline transition" href="{{ route('register') }}">
                    {{ __('Create account') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
