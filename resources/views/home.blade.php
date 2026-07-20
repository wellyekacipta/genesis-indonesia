@extends('layouts.app')

@section('title', 'Genesis Indonesia Education Centre | Beranda')

@section('content')
<!-- Hero Section -->
<header class="min-h-[85vh] flex items-center relative overflow-hidden pt-20 pb-32">
    <div class="absolute inset-0 z-0 bg-genesis-blue">
        <!-- Slide 1 -->
        <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-100 hero-slide" style="background-image: linear-gradient(rgba(30, 64, 175, 0.8), rgba(236, 72, 153, 0.2)), url('{{ asset('images/slide1.jpg') }}')"></div>
        <!-- Slide 2 -->
        <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0 hero-slide" style="background-image: linear-gradient(rgba(30, 64, 175, 0.8), rgba(236, 72, 153, 0.2)), url('{{ asset('images/slide2.jpg') }}')"></div>
        <!-- Slide 3 -->
        <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0 hero-slide" style="background-image: linear-gradient(rgba(30, 64, 175, 0.8), rgba(236, 72, 153, 0.2)), url('{{ asset('images/slide3.jpg') }}')"></div>
        <!-- Shadow overlay to create depth and contrast, blending beautifully with dark mode -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-transparent to-gray-50/90 dark:to-gray-900 pointer-events-none transition-colors duration-300"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center max-w-6xl">
        <span class="inline-block py-1.5 px-4 rounded-full bg-genesis-pink/20 text-genesis-pink border border-genesis-pink/40 backdrop-blur-md text-xs font-bold mb-6">
            {{ app()->getLocale() == 'id' ? 'Pendaftaran Olimpiade Nasional 2026 Dibuka!' : 'National Olympiad 2026 Registration is Now Open!' }}
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6">
            Genesis Indonesia <br/> <span class="text-genesis-pink">Education Centre</span>
        </h1>
        <p class="text-gray-200 text-sm md:text-lg mb-10 max-w-3xl mx-auto leading-relaxed">
            {{ app()->getLocale() == 'id' 
                ? 'Pusat Pengembangan Potensi Akademik Melalui Kompetisi Olimpiade Berkualitas dan Pelatihan Intensif Berstandar Nasional untuk Pelajar Indonesia.' 
                : 'Center for Academic Potential Development through Quality Olympiad Competitions and National Standard Intensive Training for Indonesian Students.' 
            }}
        </p>
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
            <a href="{{ route('competitions.index') }}" class="bg-genesis-pink hover:bg-genesis-pinkDark text-white font-bold px-10 py-4 rounded-full transition shadow-2xl active:scale-95">
                {{ app()->getLocale() == 'id' ? 'Ikuti Kompetisi' : 'Join Competition' }}
            </a>
            <a href="#" class="bg-white/10 hover:bg-white/20 border border-white/30 text-white font-bold px-10 py-4 rounded-full transition backdrop-blur-sm active:scale-95">
                {{ app()->getLocale() == 'id' ? 'Program Pelatihan' : 'Training Program' }}
            </a>
        </div>
    </div>
</header>

<!-- Stats Grid -->
<div class="px-4 -mt-12 relative z-20">
    <div class="container mx-auto max-w-6xl bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-700">
        <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-100 dark:divide-gray-700">
            <div class="p-8 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="fa-solid fa-user-graduate text-2xl text-genesis-pink mb-3"></i>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">5000+</h3>
                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">
                    {{ app()->getLocale() == 'id' ? 'Peserta Didik' : 'Total Students' }}
                </p>
            </div>
            <div class="p-8 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="fa-solid fa-medal text-2xl text-genesis-pink mb-3"></i>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">250+</h3>
                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">
                    {{ app()->getLocale() == 'id' ? 'Event Olimpiade' : 'Olympiad Events' }}
                </p>
            </div>
            <div class="p-8 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="fa-solid fa-school text-2xl text-genesis-pink mb-3"></i>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">120+</h3>
                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">
                    {{ app()->getLocale() == 'id' ? 'Sekolah Mitra' : 'Partner Schools' }}
                </p>
            </div>
            <div class="p-8 text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <i class="fa-solid fa-certificate text-2xl text-genesis-pink mb-3"></i>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Resmi</h3>
                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">
                    {{ app()->getLocale() == 'id' ? 'Penyelenggara' : 'Official Organizer' }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<section id="profil" class="py-24 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="w-full lg:w-1/2 relative">
                <div class="absolute inset-0 bg-genesis-pink rounded-[40px] transform rotate-3 scale-105 opacity-20"></div>
                <img src="{{ asset('images/director.jpg') }}" alt="Director" class="relative z-10 w-full h-[500px] object-cover rounded-[40px] shadow-2xl border-4 border-white dark:border-gray-800">
            </div>
            <div class="w-full lg:w-1/2">
                <div class="inline-block py-1 px-3 bg-genesis-pink/10 text-genesis-pink rounded-lg font-bold text-xs mb-6 uppercase tracking-widest">
                    {{ app()->getLocale() == 'id' ? 'Pesan Direktur' : 'Director\'s Message' }}
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                    {{ app()->getLocale() == 'id' 
                        ? 'Membangun Ekosistem Juara untuk Masa Depan Pendidikan.' 
                        : 'Building a Champion Ecosystem for the Future of Education.' 
                    }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mb-8 leading-relaxed text-base text-justify">
                    {{ app()->getLocale() == 'id' 
                        ? 'Selamat datang di Genesis Indonesia. Kami berkomitmen menciptakan wadah kompetisi yang transparan, profesional, dan berkualitas bagi siswa seluruh Indonesia untuk mengasah potensi akademik terbaik mereka di kancah nasional maupun internasional.' 
                        : 'Welcome to Genesis Indonesia. We are committed to creating a transparent, professional, and high-quality competition platform for students across Indonesia to hone their best academic potential on the national and international stage.' 
                    }}
                </p>
                <a href="{{ route('about') }}" class="inline-flex items-center text-genesis-pink font-bold hover:underline group">
                    {{ app()->getLocale() == 'id' ? 'Selengkapnya tentang visi kami' : 'More about our vision' }}
                    <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Academic Programs Section -->
<section id="akademik" class="py-24 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-20">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ app()->getLocale() == 'id' ? 'Layanan Akademik Unggulan' : 'Elite Academic Services' }}
            </h2>
            <div class="w-24 h-1.5 bg-genesis-pink mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Program Card 1 -->
            <div class="p-10 bg-gray-50 dark:bg-gray-900 rounded-3xl border border-transparent hover:border-genesis-pink/50 hover:shadow-2xl transition-all group">
                <div class="w-16 h-16 bg-genesis-pink/10 text-genesis-pink rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:bg-genesis-pink group-hover:text-white transition-all">
                    <i class="fa-solid fa-microscope"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-genesis-blue dark:text-blue-400">National Science <span class="text-genesis-pink">Olympiad</span></h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-8">
                    {{ app()->getLocale() == 'id' 
                        ? 'Kompetisi rutin berskala nasional dalam bidang Matematika, Fisika, Biologi, dan Informatika untuk tingkat SD hingga SMA.' 
                        : 'Scale national regular competitions in Mathematics, Physics, Biology, and Informatics for elementary to high school levels.' 
                    }}
                </p>
                <a href="{{ route('services') }}#olympiad" target="_blank" class="text-xs font-bold text-genesis-pink hover:text-genesis-blue flex items-center transition-colors">
                    DETAILS <i class="fa-solid fa-chevron-right ml-2"></i>
                </a>
            </div>

            <!-- Program Card 2 -->
            <div class="p-10 bg-gray-50 dark:bg-gray-900 rounded-3xl border border-transparent hover:border-genesis-pink/50 hover:shadow-2xl transition-all group">
                <div class="w-16 h-16 bg-genesis-pink/10 text-genesis-pink rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:bg-genesis-pink group-hover:text-white transition-all">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-genesis-blue dark:text-blue-400">Intensive <span class="text-genesis-pink">Mentoring</span></h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-8">
                    {{ app()->getLocale() == 'id' 
                        ? 'Bimbingan persiapan olimpiade eksklusif dengan kurikulum terintegrasi, tutor ahli, dan simulasi ujian berkala.' 
                        : 'Exclusive olympiad preparation mentoring with integrated curriculum, expert tutors, and regular exam simulations.' 
                    }}
                </p>
                <a href="{{ route('services') }}#mentoring" target="_blank" class="text-xs font-bold text-genesis-pink hover:text-genesis-blue flex items-center transition-colors">
                    DETAILS <i class="fa-solid fa-chevron-right ml-2"></i>
                </a>
            </div>

            <!-- Program Card 3 -->
            <div class="p-10 bg-gray-50 dark:bg-gray-900 rounded-3xl border border-transparent hover:border-genesis-pink/50 hover:shadow-2xl transition-all group">
                <div class="w-16 h-16 bg-genesis-pink/10 text-genesis-pink rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:bg-genesis-pink group-hover:text-white transition-all">
                    <i class="fa-solid fa-globe"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-genesis-blue dark:text-blue-400">Global <span class="text-genesis-pink">Delegation</span></h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-8">
                    {{ app()->getLocale() == 'id' 
                        ? 'Memfasilitasi delegasi siswa Indonesia terpilih untuk mengikuti kompetisi akademik bergengsi di kancah internasional.' 
                        : 'Facilitating selected Indonesian student delegations to participate in prestigious international academic competitions.' 
                    }}
                </p>
                <a href="{{ route('services') }}#global" target="_blank" class="text-xs font-bold text-genesis-pink hover:text-genesis-blue flex items-center transition-colors">
                    DETAILS <i class="fa-solid fa-chevron-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Organizational Structure Section -->
<section id="organisasi" class="py-24 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-20">
            <div class="inline-block py-1 px-3 bg-genesis-pink/10 text-genesis-pink rounded-lg font-bold text-xs mb-4 uppercase tracking-widest">
                {{ app()->getLocale() == 'id' ? 'Struktur' : 'Structure' }}
            </div>
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                {{ app()->getLocale() == 'id' ? 'Susunan Organisasi' : 'Organizational Structure' }}
            </h2>
            <div class="w-24 h-1.5 bg-genesis-pink mx-auto rounded-full mb-6"></div>
            <p class="text-gray-500 dark:text-gray-400 max-w-2xl mx-auto text-sm leading-relaxed">
                {{ app()->getLocale() == 'id' 
                    ? 'Tim profesional kami yang berkomitmen untuk memajukan pendidikan dan prestasi akademik siswa-siswi di Indonesia.' 
                    : 'Our professional team committed to advancing education and academic achievements of students in Indonesia.' 
                }}
            </p>
        </div>

        <!-- Tier 1: Director Card centered -->
        <div class="flex justify-center mb-16">
            <!-- Director Card -->
            <a href="{{ route('team.show', 'muhammad-ridwan') }}" class="bg-gray-50 dark:bg-gray-900 rounded-3xl p-8 border border-transparent hover:border-genesis-pink/30 hover:shadow-2xl transition-all duration-300 flex flex-col items-center text-center group max-w-sm">
                <div class="relative w-32 h-32 mb-6 rounded-2xl overflow-hidden border-4 border-white dark:border-gray-805 shadow-lg group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/director_struct.png') }}" alt="Director" class="w-full h-full object-cover">
                </div>
                <span class="px-3 py-1 bg-genesis-pink/10 text-genesis-pink text-xs font-bold rounded-full mb-3 uppercase tracking-wider">
                    {{ app()->getLocale() == 'id' ? 'Direktur Utama' : 'Managing Director' }}
                </span>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Muhammad Ridwan, S.Ag.</h3>
                <p class="text-gray-500 dark:text-gray-400 text-xs px-4 leading-relaxed">
                    {{ app()->getLocale() == 'id' 
                        ? 'Direktur Utama Genesis Indonesia.' 
                        : 'Managing Director of Genesis Indonesia.' 
                    }}
                </p>
            </a>
        </div>

        <!-- Tier 2: General Affair & Finance -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto mb-16">
            <!-- Operational -> Krisna Adi Putra, S.T. -->
            <a href="{{ route('team.show', 'krisna-adi-putra') }}" class="bg-gray-50 dark:bg-gray-900 rounded-3xl p-8 border border-transparent hover:border-genesis-pink/30 hover:shadow-2xl transition-all duration-300 flex flex-col items-center text-center group">
                <div class="relative w-28 h-28 mb-5 rounded-2xl overflow-hidden border-4 border-white dark:border-gray-805 shadow-lg group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/operational_struct.png') }}" alt="Operations" class="w-full h-full object-cover">
                </div>
                <span class="px-3 py-1 bg-gray-200/60 text-gray-700 dark:bg-gray-800 dark:text-gray-300 text-xs font-semibold rounded-full mb-3 uppercase tracking-wider">
                    {{ app()->getLocale() == 'id' ? 'Operasional: General Affair' : 'Operations: General Affair' }}
                </span>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Krisna Adi Putra, S.T.</h3>
                <p class="text-gray-500 dark:text-gray-400 text-xs px-4 leading-relaxed">
                    {{ app()->getLocale() == 'id' 
                        ? 'Mengelola administrasi operasional, logistik lapangan, dan sarana prasarana lembaga.' 
                        : 'Manages operational administration, field logistics, and institutional infrastructure.' 
                    }}
                </p>
            </a>

            <!-- Treasurer Card -> Dinda, S.Pd. -->
            <a href="{{ route('team.show', 'dinda') }}" class="bg-gray-50 dark:bg-gray-900 rounded-3xl p-8 border border-transparent hover:border-genesis-pink/30 hover:shadow-2xl transition-all duration-300 flex flex-col items-center text-center group">
                <div class="relative w-28 h-28 mb-5 rounded-2xl overflow-hidden border-4 border-white dark:border-gray-805 shadow-lg group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/finance_struct.png') }}" alt="Treasurer" class="w-full h-full object-cover">
                </div>
                <span class="px-3 py-1 bg-gray-200/60 text-gray-700 dark:bg-gray-800 dark:text-gray-300 text-xs font-semibold rounded-full mb-3 uppercase tracking-wider">
                    {{ app()->getLocale() == 'id' ? 'Keuangan: Accounting Finance' : 'Finance: Accounting & Finance' }}
                </span>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Dinda, S.Pd.</h3>
                <p class="text-gray-500 dark:text-gray-400 text-xs px-4 leading-relaxed">
                    {{ app()->getLocale() == 'id' 
                        ? 'Mengelola transparansi arus kas anggaran keuangan, invoice, dan administrasi transaksi.' 
                        : 'Manages cash flow transparency of financial budgets, invoices, and transaction records.' 
                    }}
                </p>
            </a>
        </div>

        <!-- Tier 3: Division Heads -> Academic, Tech, Marketing -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Academic -> Didin Rasidin, A.Md., Kom. -->
            <a href="{{ route('team.show', 'didin-rasidin') }}" class="bg-gray-50 dark:bg-gray-900 rounded-3xl p-6 border border-transparent hover:border-genesis-pink/30 hover:shadow-2xl transition-all duration-300 flex flex-col items-center text-center group">
                <div class="relative w-24 h-24 mb-4 rounded-2xl overflow-hidden border-4 border-white dark:border-gray-805 shadow-lg group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/academic_struct.png') }}" alt="Curriculum" class="w-full h-full object-cover">
                </div>
                <span class="px-2.5 py-0.5 bg-genesis-blue/5 text-genesis-blue dark:bg-blue-950/20 dark:text-blue-400 text-[10px] font-bold rounded-full mb-3 uppercase tracking-wider">
                    {{ app()->getLocale() == 'id' ? 'Akademik: Tim Kurikulum' : 'Academic: Curriculum Team' }}
                </span>
                <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1">Didin Rasidin, A.Md., Kom.</h3>
                <p class="text-gray-500 dark:text-gray-400 text-[11px] px-2 leading-relaxed">
                    {{ app()->getLocale() == 'id' 
                        ? 'Mengembangkan materi kurikulum sains, validasi bank soal, serta evaluasi hasil belajar.' 
                        : 'Develops science curriculum materials, validates question banks, and learning outcomes.' 
                    }}
                </p>
            </a>

            <!-- Tech -> Welly Eka Cipta, S.Kom. -->
            <a href="{{ route('team.show', 'welly-eka-cipta') }}" class="bg-gray-50 dark:bg-gray-900 rounded-3xl p-6 border border-transparent hover:border-genesis-pink/30 hover:shadow-2xl transition-all duration-300 flex flex-col items-center text-center group">
                <div class="relative w-24 h-24 mb-4 rounded-2xl overflow-hidden border-4 border-white dark:border-gray-805 shadow-lg group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/tech_struct.png') }}" alt="Tech" class="w-full h-full object-cover">
                </div>
                <span class="px-2.5 py-0.5 bg-genesis-pink/5 text-genesis-pink text-[10px] font-bold rounded-full mb-3 uppercase tracking-wider">
                    {{ app()->getLocale() == 'id' ? 'Teknologi: Programmer UI/UX' : 'Technology: UI/UX Programmer' }}
                </span>
                <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1">Welly Eka Cipta, S.Kom.</h3>
                <p class="text-gray-500 dark:text-gray-400 text-[11px] px-2 leading-relaxed">
                    {{ app()->getLocale() == 'id' 
                        ? 'Merancang platform ujian online terintegrasi, pemeliharaan server, dan manajemen UI/UX.' 
                        : 'Designs integrated online exam platforms, server maintenance, and UI/UX design.' 
                    }}
                </p>
            </a>

            <!-- Marketing -> Muhammad Ilham, S.H. -->
            <a href="{{ route('team.show', 'muhammad-ilham') }}" class="bg-gray-50 dark:bg-gray-900 rounded-3xl p-6 border border-transparent hover:border-genesis-pink/30 hover:shadow-2xl transition-all duration-300 flex flex-col items-center text-center group">
                <div class="relative w-24 h-24 mb-4 rounded-2xl overflow-hidden border-4 border-white dark:border-gray-805 shadow-lg group-hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('images/marketing_struct.png') }}" alt="Marketing" class="w-full h-full object-cover">
                </div>
                <span class="px-2.5 py-0.5 bg-genesis-blue/5 text-genesis-blue dark:bg-blue-950/20 dark:text-blue-400 text-[10px] font-bold rounded-full mb-3 uppercase tracking-wider">
                    {{ app()->getLocale() == 'id' ? 'Pemasaran & Kemitraan: Digital Marketing' : 'Marketing & Partnership: Digital Marketing' }}
                </span>
                <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1">Muhammad Ilham, S.H.</h3>
                <p class="text-gray-500 dark:text-gray-400 text-[11px] px-2 leading-relaxed">
                    {{ app()->getLocale() == 'id' 
                        ? 'Memimpin digital marketing, branding media sosial, dan kerja sama kemitraan institusi luar.' 
                        : 'Leads digital marketing, social media branding, and partnership cooperation.' 
                    }}
                </p>
            </a>
        </div>
    </div>
</section>

<!-- Latest News Section (Added from CMS) -->
<section class="py-24 bg-gray-50 dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex justify-between items-end mb-16">
            <div>
                <div class="inline-block py-1 px-3 bg-genesis-blue/10 text-genesis-blue dark:bg-blue-900/30 dark:text-blue-400 rounded-lg font-bold text-xs mb-4 uppercase tracking-widest">
                    {{ app()->getLocale() == 'id' ? 'Berita' : 'News' }}
                </div>
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ app()->getLocale() == 'id' ? 'Berita Terkini' : 'Latest Articles' }}
                </h2>
                <div class="w-24 h-1.5 bg-genesis-blue dark:bg-blue-500 rounded-full"></div>
            </div>
            <a href="{{ route('articles.index') }}" class="hidden md:flex items-center text-genesis-blue dark:text-blue-400 font-bold hover:text-genesis-pink transition-colors group">
                {{ app()->getLocale() == 'id' ? 'Lihat Semua' : 'View All' }}
                <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestArticles as $article)
                <div class="bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700 hover:-translate-y-2 transition-transform duration-300">
                    <div class="relative h-56 bg-gray-200 dark:bg-gray-700">
                        @if($article->image)
                            <img src="{{ Storage::url($article->image) }}" class="w-full h-full object-cover" alt="{{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-genesis-blue/5 text-genesis-blue/30 dark:bg-gray-700 dark:text-gray-600">
                                <i class="fa-solid fa-newspaper text-5xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white/90 dark:bg-gray-900/90 backdrop-blur px-3 py-1.5 rounded-lg text-xs font-bold text-genesis-blue dark:text-blue-400 shadow-sm">
                            <i class="fa-regular fa-calendar mr-1"></i> {{ $article->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 line-clamp-2 leading-snug">
                            <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-genesis-pink transition-colors">
                                {{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}
                            </a>
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-3 mb-6">
                            {{ strip_tags(app()->getLocale() == 'id' ? $article->content_id : $article->content_en) }}
                        </p>
                        <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center text-sm font-bold text-genesis-blue dark:text-blue-400 hover:text-genesis-pink transition-colors">
                            {{ app()->getLocale() == 'id' ? 'Baca Selengkapnya' : 'Read More' }} <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if($latestArticles->isEmpty())
            <div class="text-center text-gray-500 dark:text-gray-400 py-16 bg-white dark:bg-gray-800 rounded-3xl border border-dashed border-gray-300 dark:border-gray-700">
                <i class="fa-regular fa-folder-open text-4xl mb-4 text-gray-300 dark:text-gray-600"></i>
                <p class="font-medium">Belum ada artikel berita.</p>
            </div>
        @endif
        
        <div class="mt-12 text-center md:hidden">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-genesis-blue/10 dark:bg-blue-900/20 text-genesis-blue dark:text-blue-400 font-bold rounded-full hover:bg-genesis-blue hover:text-white transition-colors">
                {{ app()->getLocale() == 'id' ? 'Lihat Semua Berita' : 'View All News' }}
            </a>
        </div>
    </div>
</section>

<!-- Partnership Section -->
<section id="kemitraan" class="py-20 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-12">
            <span class="inline-block py-1 px-3 bg-genesis-pink/10 text-genesis-pink rounded-lg font-bold text-xs mb-3 uppercase tracking-widest">
                {{ app()->getLocale() == 'id' ? 'Kemitraan' : 'Partnership' }}
            </span>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">
                {{ app()->getLocale() == 'id' ? 'Bekerja Sama Dengan' : 'In Partnership With' }}
            </h2>
            <div class="w-16 h-1 bg-genesis-pink mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-items-center">
            <!-- Partner 1: Ruangguru -->
            <div class="flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl w-full h-28 border border-transparent hover:border-genesis-pink/20 hover:shadow-xl transition-all duration-300 group">
                <i class="fa-solid fa-graduation-cap text-3xl text-gray-400 group-hover:text-genesis-pink transition-colors mb-2"></i>
                <span class="font-bold text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">Ruangguru</span>
            </div>
            
            <!-- Partner 2: Zenius -->
            <div class="flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl w-full h-28 border border-transparent hover:border-genesis-pink/20 hover:shadow-xl transition-all duration-300 group">
                <i class="fa-solid fa-brain text-3xl text-gray-400 group-hover:text-genesis-pink transition-colors mb-2"></i>
                <span class="font-bold text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">Zenius Education</span>
            </div>

            <!-- Partner 3: Quipper -->
            <div class="flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl w-full h-28 border border-transparent hover:border-genesis-pink/20 hover:shadow-xl transition-all duration-300 group">
                <i class="fa-solid fa-book-open text-3xl text-gray-400 group-hover:text-genesis-pink transition-colors mb-2"></i>
                <span class="font-bold text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">Quipper School</span>
            </div>

            <!-- Partner 4: British Council -->
            <div class="flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl w-full h-28 border border-transparent hover:border-genesis-pink/20 hover:shadow-xl transition-all duration-300 group">
                <i class="fa-solid fa-globe text-3xl text-gray-400 group-hover:text-genesis-pink transition-colors mb-2"></i>
                <span class="font-bold text-sm text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">British Council</span>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;
        
        setInterval(function() {
            slides[currentSlide].classList.remove('opacity-100');
            slides[currentSlide].classList.add('opacity-0');
            
            currentSlide = (currentSlide + 1) % slides.length;
            
            slides[currentSlide].classList.remove('opacity-0');
            slides[currentSlide].classList.add('opacity-100');
        }, 5000); // Ganti foto setiap 5 detik
    });
</script>
@endsection
