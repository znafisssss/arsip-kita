<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-white mb-2">Secure Area 🔒</h2>
        <p class="text-blue-100 text-sm">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-white mb-1">Password</label>
            <input id="password" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition"
                   type="password"
                   name="password"
                   placeholder="••••••••"
                   required 
                   autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" 
                    class="w-full px-4 py-3 bg-white text-indigo-600 font-bold rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-500 transition transform hover:scale-105 shadow-lg">
                🔐 {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
