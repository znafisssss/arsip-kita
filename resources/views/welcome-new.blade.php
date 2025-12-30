<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ArsipKu') }} - Arsip Pribadi</title>

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
        .frozen-welcome-bg {
            background: linear-gradient(180deg, #f0f9ff 0%, #e0f2fe 30%, #bae6fd 70%, #e0f2fe 100%);
            min-height: 100vh;
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

        /* Glass Card */
        .welcome-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 2px solid #cbd5e1;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .welcome-card:hover {
            border-color: #94a3b8;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        /* Feature Card */
        .feature-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 2px solid #bae6fd;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            background: rgba(255, 255, 255, 0.95);
            border-color: #38bdf8;
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(56, 189, 248, 0.2);
        }

        /* Sparkle Animation */
        @keyframes sparkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.3); }
        }
        .sparkle {
            animation: sparkle 2s ease-in-out infinite;
        }
        .sparkle-delay-1 { animation-delay: 0.5s; }
        .sparkle-delay-2 { animation-delay: 1s; }

        /* Float Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        /* Button */
        .btn-primary {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
            color: white;
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.8);
            color: #0369a1;
            border: 2px solid #7dd3fc;
            transition: all 0.2s ease;
        }
        .btn-secondary:hover {
            background: white;
            border-color: #38bdf8;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.2);
        }
    </style>
</head>
<body class="frozen-welcome-bg antialiased">
    <!-- Snowfall Canvas -->
    <canvas id="snowfall-canvas"></canvas>

    <div class="content-wrapper min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="py-6">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-sky-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L12 5M12 19L12 22M4.93 4.93L7.05 7.05M16.95 16.95L19.07 19.07M2 12L5 12M19 12L22 12M4.93 19.07L7.05 16.95M16.95 7.05L19.07 4.93M12 8C9.79 8 8 9.79 8 12C8 14.21 9.79 16 12 16C14.21 16 16 14.21 16 12C16 9.79 14.21 8 12 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none"/>
                        </svg>
                        <span class="text-2xl font-bold text-sky-700">ArsipKu</span>
                    </div>

                    <!-- Auth Links -->
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary px-6 py-2.5 rounded-xl font-medium">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-secondary px-5 py-2.5 rounded-xl font-medium">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary px-5 py-2.5 rounded-xl font-medium">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 flex items-center py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left: Text Content -->
                    <div>
                        <div class="flex items-center space-x-2 mb-6">
                            <svg class="w-4 h-4 text-sky-400 sparkle" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 3L13.4 8.6L19 10L13.4 11.4L12 17L10.6 11.4L5 10L10.6 8.6L12 3Z"/>
                            </svg>
                            <span class="text-sm font-medium text-sky-600 uppercase tracking-wide">Arsip Pribadi Digital</span>
                            <svg class="w-4 h-4 text-sky-400 sparkle sparkle-delay-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 3L13.4 8.6L19 10L13.4 11.4L12 17L10.6 11.4L5 10L10.6 8.6L12 3Z"/>
                            </svg>
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                            Simpan Arsipmu<br>
                            <span class="text-sky-600">Aman & Rapi</span>
                        </h1>
                        
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            Kelola dokumen, foto, dan file pentingmu dalam satu tempat yang aman. 
                            Akses kapan saja, dari mana saja.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary px-8 py-4 rounded-xl font-semibold text-center inline-flex items-center justify-center">
                                    Ke Dashboard
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="btn-primary px-8 py-4 rounded-xl font-semibold text-center inline-flex items-center justify-center">
                                    Mulai Gratis
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('login') }}" class="btn-secondary px-8 py-4 rounded-xl font-semibold text-center">
                                    Sudah punya akun?
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Right: Feature Cards -->
                    <div class="space-y-4">
                        <div class="feature-card rounded-2xl p-6 flex items-start space-x-4">
                            <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center flex-shrink-0 float-animation">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-1">Aman & Pribadi</h3>
                                <p class="text-gray-600 text-sm">Arsipmu hanya bisa diakses oleh kamu sendiri</p>
                            </div>
                        </div>

                        <div class="feature-card rounded-2xl p-6 flex items-start space-x-4">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0 float-animation" style="animation-delay: 0.5s">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-1">Terorganisir</h3>
                                <p class="text-gray-600 text-sm">Kategori otomatis untuk dokumen, foto, dan file lainnya</p>
                            </div>
                        </div>

                        <div class="feature-card rounded-2xl p-6 flex items-start space-x-4">
                            <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center flex-shrink-0 float-animation" style="animation-delay: 1s">
                                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-1">Cepat & Mudah</h3>
                                <p class="text-gray-600 text-sm">Upload, preview, dan download dalam hitungan detik</p>
                            </div>
                        </div>

                        <div class="feature-card rounded-2xl p-6 flex items-start space-x-4">
                            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0 float-animation" style="animation-delay: 1.5s">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-1">Multi Format</h3>
                                <p class="text-gray-600 text-sm">Mendukung PDF, DOC, gambar, video, dan banyak lagi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-8 text-center">
            <p class="text-gray-500 text-sm inline-flex items-center justify-center">
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
        (function() {
            const canvas = document.getElementById('snowfall-canvas');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            let snowflakes = [];
            let animationId;

            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            function createSnowflake() {
                return {
                    x: Math.random() * canvas.width,
                    y: Math.random() * -100,
                    radius: Math.random() * 3 + 1,
                    speed: Math.random() * 0.8 + 0.3,
                    wind: Math.random() * 0.4 - 0.2,
                    opacity: Math.random() * 0.4 + 0.2
                };
            }

            function initSnowflakes() {
                const count = Math.floor(window.innerWidth / 25);
                snowflakes = [];
                for (let i = 0; i < count; i++) {
                    const flake = createSnowflake();
                    flake.y = Math.random() * canvas.height;
                    snowflakes.push(flake);
                }
            }

            function drawSnowflakes() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                snowflakes.forEach((flake, index) => {
                    ctx.beginPath();
                    ctx.arc(flake.x, flake.y, flake.radius, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(186, 230, 253, ${flake.opacity})`;
                    ctx.fill();

                    flake.y += flake.speed;
                    flake.x += flake.wind;

                    if (flake.y > canvas.height) {
                        snowflakes[index] = createSnowflake();
                    }
                    if (flake.x > canvas.width) flake.x = 0;
                    else if (flake.x < 0) flake.x = canvas.width;
                });

                animationId = requestAnimationFrame(drawSnowflakes);
            }

            resizeCanvas();
            initSnowflakes();
            drawSnowflakes();

            window.addEventListener('resize', () => {
                resizeCanvas();
                initSnowflakes();
            });

            document.addEventListener('visibilitychange', () => {
                if (document.hidden) cancelAnimationFrame(animationId);
                else drawSnowflakes();
            });
        })();
    </script>
</body>
</html>
