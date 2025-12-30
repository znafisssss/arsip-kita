<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }} - Frozen Archive</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* Frozen Theme - Snowflake Animation */
            .snowflake {
                position: fixed;
                top: -10px;
                z-index: 9999;
                user-select: none;
                cursor: default;
                animation-name: snowflakes-fall, snowflakes-shake;
                animation-duration: 10s, 3s;
                animation-timing-function: linear, ease-in-out;
                animation-iteration-count: infinite, infinite;
                animation-play-state: running, running;
                color: #E0F2FE;
                font-size: 1em;
                opacity: 0.6;
            }
            @keyframes snowflakes-fall {
                0% { top: -10%; }
                100% { top: 100%; }
            }
            @keyframes snowflakes-shake {
                0%, 100% { transform: translateX(0); }
                50% { transform: translateX(80px); }
            }
            .snowflake:nth-of-type(0) { left: 1%; animation-delay: 0s, 0s; }
            .snowflake:nth-of-type(1) { left: 10%; animation-delay: 1s, 1s; }
            .snowflake:nth-of-type(2) { left: 20%; animation-delay: 6s, 0.5s; }
            .snowflake:nth-of-type(3) { left: 30%; animation-delay: 4s, 2s; }
            .snowflake:nth-of-type(4) { left: 40%; animation-delay: 2s, 2s; }
            .snowflake:nth-of-type(5) { left: 50%; animation-delay: 8s, 3s; }
            .snowflake:nth-of-type(6) { left: 60%; animation-delay: 6s, 2s; }
            .snowflake:nth-of-type(7) { left: 70%; animation-delay: 2.5s, 1s; }
            .snowflake:nth-of-type(8) { left: 80%; animation-delay: 1s, 0s; }
            .snowflake:nth-of-type(9) { left: 90%; animation-delay: 3s, 1.5s; }
            .snowflake:nth-of-type(10) { left: 95%; animation-delay: 5s, 1s; }

            /* Lighter Glassmorphism background */
            .frozen-bg {
                background: linear-gradient(135deg, #a8c0ff 0%, #c2d9ff 25%, #e0f2fe 50%, #bfdbfe 75%, #dbeafe 100%);
                background-size: 400% 400%;
                animation: gradient 20s ease infinite;
            }
            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.4);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.5);
                box-shadow: 0 4px 16px 0 rgba(31, 38, 135, 0.15);
            }
            
            .glass-card-light {
                background: rgba(255, 255, 255, 0.6);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.7);
                box-shadow: 0 4px 16px 0 rgba(31, 38, 135, 0.1);
            }
        </style>
    </head>
    <body class="font-sans antialiased frozen-bg">
        <!-- Snowflakes -->
        <div class="snowflake" aria-hidden="true">❄</div>
        <div class="snowflake" aria-hidden="true">❅</div>
        <div class="snowflake" aria-hidden="true">❆</div>
        <div class="snowflake" aria-hidden="true">❄</div>
        <div class="snowflake" aria-hidden="true">❅</div>
        <div class="snowflake" aria-hidden="true">❆</div>
        <div class="snowflake" aria-hidden="true">❄</div>
        <div class="snowflake" aria-hidden="true">❅</div>
        <div class="snowflake" aria-hidden="true">❆</div>
        <div class="snowflake" aria-hidden="true">❄</div>
        <div class="snowflake" aria-hidden="true">❅</div>

        <div class="min-h-screen flex items-center justify-center px-4 py-12">
            <div class="max-w-5xl w-full">
                <!-- Auth Links -->
                @if (Route::has('login'))
                    <div class="text-right mb-12">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-3 glass-card-light rounded-lg text-gray-700 font-medium hover:bg-white/80 transition inline-block">
                                Go to Dashboard →
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-3 glass-card-light rounded-lg text-gray-700 font-medium hover:bg-white/80 transition inline-block mr-3">
                                Sign in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 rounded-lg text-white font-medium transition inline-block shadow-lg">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif

                <!-- Welcome Section + First Feature -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Welcome -->
                    <div class="glass-card-light rounded-2xl p-8 flex flex-col justify-center">
                        <div class="text-5xl mb-4">❄️</div>
                        <h1 class="text-4xl font-bold text-gray-800 mb-3">Welcome to Arsipku Frozen</h1>
                        <p class="text-lg text-gray-600">Keep your important files safe and organized in one beautiful place</p>
                    </div>

                    <!-- Private & Secure -->
                    <div class="glass-card-light rounded-xl p-8 flex flex-col justify-center hover:scale-105 hover:shadow-xl transition-all">
                        <div class="text-4xl mb-4">🔒</div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Private & Secure</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Your files stay yours. Everything you upload is completely private and secure.</p>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <div class="glass-card-light rounded-xl p-8 hover:scale-105 hover:shadow-xl transition-all">
                        <div class="text-4xl mb-4">📂</div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Stay Organized</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Sort everything into categories. Find what you need when you need it.</p>
                    </div>

                    <div class="glass-card-light rounded-xl p-8 hover:scale-105 hover:shadow-xl transition-all">
                        <div class="text-4xl mb-4">⚡</div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Quick & Easy</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">Upload, preview, and download in seconds. No complicated steps.</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center">
                    <p class="text-gray-600 text-sm">
                        Made with care using Laravel & Tailwind CSS ❄️
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
