<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title', 'Genesis Indonesia Education Centre | Pusat Olimpiade Pendidikan Nasional')</title>
    <meta name="description" content="@yield('meta_description', 'Genesis Indonesia Education Centre. Organisasi pelatihan dan penyelenggara olimpiade pendidikan nasional unggulan.')">
    <link rel="icon" type="image/png" href="https://lh3.googleusercontent.com/a/ACg8ocJW-BsErSCxATtNF1sjxdywseKWWUd7D0z6SkFU-DKGrIA_mqo=s432-c-no">
    
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        html { scroll-behavior: smooth; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Smooth transitions */
        .transition-all-300 { transition: all 0.3s ease; }
        .logo-container img { transition: transform 0.3s ease; }
        .logo-container:hover img { transform: scale(1.05); }
    </style>

    <!-- Script to prevent dark mode flash -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="font-sans antialiased text-gray-800 dark:text-gray-100 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

    <!-- Topbar -->
    <div class="bg-genesis-blue text-white text-[10px] md:text-xs py-2 border-b border-white/10">
        <div class="container mx-auto px-4 max-w-6xl flex justify-between items-center">
            <div class="flex space-x-4">
                <span class="flex items-center"><i class="fa-solid fa-phone mr-1"></i> <span class="hidden sm:inline">(+62) 851-7963-7420</span></span>
                <span class="flex items-center"><i class="fa-solid fa-envelope mr-1"></i> <span class="hidden sm:inline">info@genesisindonesia.or.id</span></span>
            </div>
            <div class="flex space-x-3">
                <a href="#" class="hover:text-genesis-pink transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="hover:text-genesis-pink transition-colors"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://wa.me/6285179637420" class="hover:text-genesis-pink transition-colors"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50 transition-colors duration-300">
        <div class="container mx-auto px-4 py-3 max-w-6xl">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="logo-container">
                        <img src="https://lh3.googleusercontent.com/a/ACg8ocJW-BsErSCxATtNF1sjxdywseKWWUd7D0z6SkFU-DKGrIA_mqo=s432-c-no" 
                             alt="Logo Genesis" 
                             class="w-12 h-12 md:w-16 md:h-16 object-contain bg-white rounded-full p-1 shadow-sm border border-gray-100">
                    </a>
                    <a href="{{ route('home') }}">
                        <div class="font-bold text-genesis-blue dark:text-blue-400 text-lg md:text-xl leading-tight tracking-tight">GENESIS INDONESIA</div>
                        <p class="text-[8px] md:text-[10px] text-gray-500 dark:text-gray-400 font-bold tracking-widest uppercase">Education Centre</p>
                    </a>
                </div>

                <div class="hidden lg:flex space-x-8 items-center font-semibold text-sm">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-genesis-pink border-b-2 border-genesis-pink pb-1' : 'text-gray-600 dark:text-gray-300 hover:text-genesis-pink transition-colors' }}">
                        {{ app()->getLocale() == 'id' ? 'Beranda' : 'Home' }}
                    </a>
                    <a href="{{ route('home') }}#profil" class="text-gray-600 dark:text-gray-300 hover:text-genesis-pink transition-colors">
                        {{ app()->getLocale() == 'id' ? 'Tentang Kami' : 'About Us' }}
                    </a>
                    <a href="{{ route('home') }}#akademik" class="text-gray-600 dark:text-gray-300 hover:text-genesis-pink transition-colors">
                        {{ app()->getLocale() == 'id' ? 'Program' : 'Programs' }}
                    </a>
                    <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'text-genesis-pink border-b-2 border-genesis-pink pb-1' : 'text-gray-600 dark:text-gray-300 hover:text-genesis-pink transition-colors' }}">
                        {{ app()->getLocale() == 'id' ? 'Berita' : 'News' }}
                    </a>
                    
                    <div class="flex items-center space-x-3 border-l border-gray-200 dark:border-gray-750 pl-6">
                        <!-- Language Toggle Dropdown -->
                        <div class="relative inline-block text-left" id="language-dropdown">
                            <button id="language-dropdown-btn" class="flex items-center text-sm font-semibold text-gray-600 dark:text-gray-300 hover:text-genesis-pink dark:hover:text-genesis-pink transition-colors focus:outline-none cursor-pointer">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                <span>{{ app()->getLocale() == 'id' ? 'ID' : 'EN' }}</span>
                                <svg class="w-3.5 h-3.5 text-gray-400 dark:text-gray-500 ml-1 transition-transform duration-200" id="language-dropdown-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div id="language-dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 rounded-2xl shadow-xl py-2 z-50 transition-all duration-300">
                                <a href="{{ route('lang.switch', 'id') }}" class="flex items-center justify-between px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ app()->getLocale() == 'id' ? 'font-bold text-genesis-blue dark:text-blue-400 bg-blue-50/30 dark:bg-blue-900/10' : '' }}">
                                    <span class="flex items-center"><span class="mr-2.5 text-base">🇮🇩</span> Bahasa Indonesia</span>
                                    @if(app()->getLocale() == 'id')
                                        <svg class="w-4 h-4 text-genesis-pink" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @endif
                                </a>
                                <a href="{{ route('lang.switch', 'en') }}" class="flex items-center justify-between px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ app()->getLocale() == 'en' ? 'font-bold text-genesis-blue dark:text-blue-400 bg-blue-50/30 dark:bg-blue-900/10' : '' }}">
                                    <span class="flex items-center"><span class="mr-2.5 text-base">🇬🇧</span> English (EN)</span>
                                    @if(app()->getLocale() == 'en')
                                        <svg class="w-4 h-4 text-genesis-pink" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @endif
                                </a>
                            </div>
                        </div>
                        
                        <!-- Theme Toggle -->
                        <button id="theme-toggle" class="text-gray-500 dark:text-gray-400 hover:text-genesis-pink dark:hover:text-genesis-pink transition-colors p-2 focus:outline-none cursor-pointer">
                            <!-- Moon Icon -->
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <!-- Sun Icon -->
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-yellow-500 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.364 17.636l-.707.707M18.364 17.636l-.707-.707M6.364 6.364l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>

                    <a href="/admin" class="bg-genesis-pink hover:bg-genesis-pinkDark text-white px-6 py-2.5 rounded-full transition shadow-lg transform hover:-translate-y-1">
                        Login
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center space-x-3">
                    <a href="{{ route('lang.switch', app()->getLocale() == 'id' ? 'en' : 'id') }}" class="flex items-center space-x-1 text-xs font-bold text-gray-600 dark:text-gray-300 hover:text-genesis-pink dark:hover:text-genesis-pink transition-colors">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        <span>{{ app()->getLocale() == 'id' ? 'ID' : 'EN' }}</span>
                    </a>
                    
                    <button id="theme-toggle-mobile" class="text-gray-500 dark:text-gray-400 hover:text-genesis-pink dark:hover:text-genesis-pink p-2 focus:outline-none cursor-pointer">
                        <!-- Moon Icon -->
                        <svg id="theme-toggle-dark-icon-mobile" class="hidden w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <!-- Sun Icon -->
                        <svg id="theme-toggle-light-icon-mobile" class="hidden w-5 h-5 text-yellow-500 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.364 17.636l-.707.707M18.364 17.636l-.707-.707M6.364 6.364l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                    
                    <button id="mobile-menu-btn" class="text-genesis-blue dark:text-blue-400 text-2xl p-2"><i class="fa-solid fa-bars"></i></button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 shadow-xl absolute w-full">
            <div class="flex flex-col px-6 py-4 space-y-4">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-genesis-pink font-bold py-2 border-b border-gray-50 dark:border-gray-700' : 'text-gray-600 dark:text-gray-300 font-semibold py-2 border-b border-gray-50 dark:border-gray-700' }}">{{ app()->getLocale() == 'id' ? 'Beranda' : 'Home' }}</a>
                <a href="{{ route('home') }}#profil" class="text-gray-600 dark:text-gray-300 font-semibold py-2 border-b border-gray-50 dark:border-gray-700">{{ app()->getLocale() == 'id' ? 'Tentang Kami' : 'About Us' }}</a>
                <a href="{{ route('home') }}#akademik" class="text-gray-600 dark:text-gray-300 font-semibold py-2 border-b border-gray-50 dark:border-gray-700">{{ app()->getLocale() == 'id' ? 'Program' : 'Programs' }}</a>
                <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'text-genesis-pink font-bold py-2 border-b border-gray-50 dark:border-gray-700' : 'text-gray-600 dark:text-gray-300 font-semibold py-2 border-b border-gray-50 dark:border-gray-700' }}">{{ app()->getLocale() == 'id' ? 'Berita' : 'News' }}</a>
                <a href="/admin" class="bg-genesis-pink text-white text-center font-bold py-3 rounded-xl shadow-lg mt-2">Login</a>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-genesis-blue text-white pt-24 pb-12 mt-auto">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16 mb-20">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-4 mb-8">
                        <img src="https://lh3.googleusercontent.com/a/ACg8ocJW-BsErSCxATtNF1sjxdywseKWWUd7D0z6SkFU-DKGrIA_mqo=s432-c-no" alt="Genesis Logo" class="w-20 h-20 bg-white rounded-full p-1 shadow-xl">
                        <div>
                            <h3 class="text-2xl font-bold">Genesis Indonesia</h3>
                            <p class="text-genesis-pink text-xs font-bold tracking-widest uppercase">Education Centre</p>
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed max-w-md italic">
                        "Excellence through Integrity and Competition. Kami percaya setiap pelajar memiliki potensi untuk menjadi juara di bidangnya masing-masing."
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-genesis-pink mb-8 uppercase tracking-widest text-sm">Navigasi Cepat</h4>
                    <ul class="space-y-4 text-sm text-gray-300">
                        <li><a href="{{ route('home') }}#profil" class="hover:text-genesis-pink transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('home') }}#akademik" class="hover:text-genesis-pink transition-colors">Program Utama</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-genesis-pink transition-colors">Berita Terkini</a></li>
                        <li><a href="/admin" class="hover:text-genesis-pink transition-colors">Portal Login</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-genesis-pink mb-8 uppercase tracking-widest text-sm">Hubungi Kami</h4>
                    <ul class="space-y-4 text-sm text-gray-300">
                        <li class="flex items-start"><i class="fa-solid fa-location-dot mt-1 mr-3 text-genesis-pink"></i> Jl. Jaja Abdullah, Kelurahan Karawang Kulon. Cluster Kertabumi Blok A No. 2</li>
                        <li class="flex items-start"><i class="fa-solid fa-phone mt-1 mr-3 text-genesis-pink"></i> <span>Admin 1: 0895414277027<br/>Admin 2: 087724191623</span></li>
                        <li class="flex items-center"><i class="fa-solid fa-envelope mr-3 text-genesis-pink"></i> genesisindonesia98@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 pt-12 text-center text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} Genesis Indonesia Education Centre. All Rights Reserved. | Developed by Epilog Society</p>
            </div>
        </div>
    </footer>

    <script>
        // Theme Toggle Logic
        const toggleTheme = () => {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcons();
        };

        const updateThemeIcons = () => {
            const isDark = document.documentElement.classList.contains('dark');
            
            // Desktop icons
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');
            if(darkIcon && lightIcon) {
                darkIcon.classList.toggle('hidden', isDark);
                lightIcon.classList.toggle('hidden', !isDark);
            }

            // Mobile icons
            const darkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
            const lightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');
            if(darkIconMobile && lightIconMobile) {
                darkIconMobile.classList.toggle('hidden', isDark);
                lightIconMobile.classList.toggle('hidden', !isDark);
            }
        };

        const themeBtn = document.getElementById('theme-toggle');
        if(themeBtn) themeBtn.addEventListener('click', toggleTheme);
        
        const themeBtnMobile = document.getElementById('theme-toggle-mobile');
        if(themeBtnMobile) themeBtnMobile.addEventListener('click', toggleTheme);

        updateThemeIcons();

        // Language Dropdown Logic
        const langDropdown = document.getElementById('language-dropdown');
        const langBtn = document.getElementById('language-dropdown-btn');
        const langMenu = document.getElementById('language-dropdown-menu');
        const langChevron = document.getElementById('language-dropdown-chevron');

        if (langBtn && langMenu) {
            langBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isHidden = langMenu.classList.toggle('hidden');
                if (langChevron) {
                    langChevron.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            });

            // Close language dropdown on click outside
            window.addEventListener('click', (e) => {
                if (!langDropdown.contains(e.target)) {
                    langMenu.classList.add('hidden');
                    if (langChevron) {
                        langChevron.style.transform = 'rotate(0deg)';
                    }
                }
            });
        }

        // Mobile Menu Toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        
        if(menuBtn && menu) {
            menuBtn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });

            // Close mobile menu on click outside or links
            window.addEventListener('click', (e) => {
                if (!menu.contains(e.target) && !menuBtn.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>
