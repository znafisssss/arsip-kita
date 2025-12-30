<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-white mb-2">Reset Password ❄️</h2>
        <p class="text-blue-100">Create your new password</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
            <input id="email" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition" 
                   type="email" 
                   name="email" 
                   value="{{ old('email', $request->email) }}" 
                   required 
                   autofocus 
                   autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-white mb-1">New Password</label>
            <input id="password" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition"
                   type="password"
                   name="password"
                   placeholder="••••••••"
                   required 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-white mb-1">Confirm New Password</label>
            <input id="password_confirmation" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition"
                   type="password"
                   name="password_confirmation" 
                   placeholder="••••••••"
                   required 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" 
                    class="w-full px-4 py-3 bg-white text-indigo-600 font-bold rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-500 transition transform hover:scale-105 shadow-lg">
                🔐 {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
