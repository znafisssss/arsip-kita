<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-white mb-2">Verify Your Email ❄️</h2>
        <p class="text-blue-100 text-sm">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 rounded-lg bg-green-500/20 border border-green-400/30 text-green-100 text-sm">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex flex-col gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" 
                    class="w-full px-4 py-3 bg-white text-indigo-600 font-bold rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-500 transition transform hover:scale-105 shadow-lg">
                📧 {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm text-blue-100 hover:text-white underline transition">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
