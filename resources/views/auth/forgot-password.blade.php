<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-white mb-2">Forgot Password? ❄️</h2>
        <p class="text-blue-100 text-sm">{{ __('No problem! Just let us know your email address and we will email you a password reset link.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
            <input id="email" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="your@email.com"
                   required 
                   autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" 
                    class="w-full px-4 py-3 bg-white text-indigo-600 font-bold rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-500 transition transform hover:scale-105 shadow-lg">
                📧 {{ __('Email Password Reset Link') }}
            </button>
        </div>

        <div class="text-center mt-6">
            <a class="text-sm text-blue-100 hover:text-white underline transition" href="{{ route('login') }}">
                {{ __('Back to login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
