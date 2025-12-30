<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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

            /* Glassmorphism background */
            .frozen-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #a8c0ff 50%, #3f2b96 75%, #a8edea 100%);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
            }
            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            }

            .glass-header {
                background: rgba(255, 255, 255, 0.25);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            }
        </style>
    </head>
    <body class="font-sans antialiased frozen-bg">
        <!-- Snowflakes -->
        @if(!isset($hideSnowflakes) || !$hideSnowflakes)
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
        @endif

        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="glass-header shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-2xl text-white leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
