<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ArsipKu') }} - Frozen Archive</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        /* Frozen Clean Background */
        .frozen-clean-bg {
            background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 50%, #f8fafc 100%);
            min-height: 100vh;
        }

        /* Glassmorphism Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 2px solid #cbd5e1;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        .glass-card:hover {
            border-color: #94a3b8;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Navbar Glass */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(186, 230, 253, 0.5);
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
        }

        /* Soft Card */
        .soft-card {
            background: #ffffff;
            border: 2px solid #bae6fd;
            box-shadow: 0 2px 12px rgba(186, 230, 253, 0.3);
            transition: all 0.3s ease;
        }
        .soft-card:hover {
            border-color: #7dd3fc;
            box-shadow: 0 6px 20px rgba(186, 230, 253, 0.5);
        }

        /* Stat Card */
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
            border: 2px solid #7dd3fc;
            box-shadow: 0 4px 20px rgba(186, 230, 253, 0.25);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            border-color: #38bdf8;
            box-shadow: 0 8px 28px rgba(56, 189, 248, 0.3);
            transform: translateY(-2px);
        }

        /* Button Primary Frozen */
        .btn-frozen {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
            color: white;
            transition: all 0.2s ease;
        }
        .btn-frozen:hover {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.4);
        }

        /* Snowflake Canvas */
        #snowfall-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        /* Content above snow */
        .content-wrapper {
            position: relative;
            z-index: 10;
        }

        /* Table Styles */
        .frozen-table th {
            background: #f0f9ff;
            color: #0c4a6e;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        .frozen-table td {
            border-bottom: 1px solid #e0f2fe;
        }
        .frozen-table tbody tr:hover {
            background: #f0f9ff;
        }

        /* Icon Button */
        .icon-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .icon-btn:hover {
            background: #e0f2fe;
        }

        /* Upload Zone */
        .upload-zone {
            border: 3px dashed #7dd3fc;
            background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
            transition: all 0.3s ease;
        }
        .upload-zone:hover, .upload-zone.dragover {
            border-color: #0ea5e9;
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%);
            box-shadow: 0 4px 16px rgba(14, 165, 233, 0.15);
        }

        /* Sparkle Animation */
        @keyframes sparkle {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        .sparkle {
            animation: sparkle 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="frozen-clean-bg antialiased">
    <!-- Snowfall Canvas -->
    <canvas id="snowfall-canvas"></canvas>

    <div class="content-wrapper min-h-screen">
        <!-- Navbar -->
        @include('layouts.navigation-frozen')

        <!-- Page Heading -->
        @isset($header)
            <header class="pt-6 pb-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="pb-12">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="py-6 text-center text-gray-500 text-sm">
            <p class="inline-flex items-center justify-center">
                Made with 
                <svg class="w-4 h-4 mx-1 text-sky-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L12 5M12 19L12 22M4.93 4.93L7.05 7.05M16.95 16.95L19.07 19.07M2 12L5 12M19 12L22 12M4.93 19.07L7.05 16.95M16.95 7.05L19.07 4.93M12 8C9.79 8 8 9.79 8 12C8 14.21 9.79 16 12 16C14.21 16 16 14.21 16 12C16 9.79 14.21 8 12 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none"/>
                </svg>
                by ArsipKu • {{ date('Y') }}
            </p>
        </footer>
    </div>

    <!-- Snowfall JavaScript -->
    <script>
        // Snowfall Animation - Pure JavaScript
        (function() {
            const canvas = document.getElementById('snowfall-canvas');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            let snowflakes = [];
            let animationId;

            // Resize canvas
            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            // Create snowflake
            function createSnowflake() {
                return {
                    x: Math.random() * canvas.width,
                    y: Math.random() * -100,
                    radius: Math.random() * 3 + 1,
                    speed: Math.random() * 1 + 0.5,
                    wind: Math.random() * 0.5 - 0.25,
                    opacity: Math.random() * 0.5 + 0.3
                };
            }

            // Initialize snowflakes
            function initSnowflakes() {
                const count = Math.floor(window.innerWidth / 20); // Responsive count
                snowflakes = [];
                for (let i = 0; i < count; i++) {
                    const flake = createSnowflake();
                    flake.y = Math.random() * canvas.height; // Spread initially
                    snowflakes.push(flake);
                }
            }

            // Draw snowflakes
            function drawSnowflakes() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                snowflakes.forEach((flake, index) => {
                    ctx.beginPath();
                    ctx.arc(flake.x, flake.y, flake.radius, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(186, 230, 253, ${flake.opacity})`;
                    ctx.fill();

                    // Update position
                    flake.y += flake.speed;
                    flake.x += flake.wind;

                    // Reset if out of bounds
                    if (flake.y > canvas.height) {
                        snowflakes[index] = createSnowflake();
                    }
                    if (flake.x > canvas.width) {
                        flake.x = 0;
                    } else if (flake.x < 0) {
                        flake.x = canvas.width;
                    }
                });

                animationId = requestAnimationFrame(drawSnowflakes);
            }

            // Initialize
            resizeCanvas();
            initSnowflakes();
            drawSnowflakes();

            // Handle resize
            window.addEventListener('resize', () => {
                resizeCanvas();
                initSnowflakes();
            });

            // Pause when tab not visible (performance)
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    cancelAnimationFrame(animationId);
                } else {
                    drawSnowflakes();
                }
            });
        })();
    </script>
</body>
</html>
