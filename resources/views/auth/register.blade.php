<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Join the Frozen Archive! ❄️</h2>
        <p class="text-gray-600">Create your account to get started</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input id="name" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/70 border border-blue-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   placeholder="Your name"
                   required 
                   autofocus 
                   autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input id="email" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/70 border border-blue-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="your@email.com"
                   required 
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
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input id="password_confirmation" 
                   class="block w-full px-4 py-3 rounded-lg bg-white/70 border border-blue-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent transition"
                   type="password"
                   name="password_confirmation" 
                   placeholder="••••••••"
                   required 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" 
                    class="w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-bold rounded-lg hover:from-blue-600 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition transform hover:scale-105 shadow-lg">
                ❄️ {{ __('Register') }}
            </button>
        </div>

        <div class="text-center mt-6">
            <a class="text-sm text-gray-600 hover:text-blue-600 underline transition" href="{{ route('login') }}">
                {{ __('Already have an account? Sign in') }}
            </a>
        </div>
    </form>
</x-guest-layout>
