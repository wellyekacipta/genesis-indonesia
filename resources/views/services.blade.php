@extends('layouts.app')

@section('title', app()->getLocale() == 'id' ? 'Layanan Akademik Unggulan - Genesis Indo' : 'Elite Academic Services - Genesis Indo')

@section('content')
<!-- Hero Section -->
<section class="relative bg-genesis-blue text-white py-20 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: linear-gradient(rgba(30, 64, 175, 0.9), rgba(236, 72, 153, 0.3)), url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=1920&q=80')"></div>
    <div class="container mx-auto px-4 max-w-6xl relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-4">
            {{ app()->getLocale() == 'id' ? 'Layanan Akademik Unggulan' : 'Elite Academic Services' }}
        </h1>
        <p class="text-gray-200 text-sm md:text-base max-w-2xl mx-auto">
            {{ app()->getLocale() == 'id' 
                ? 'Kami menyediakan program bimbingan dan kompetisi berskala nasional & internasional untuk melahirkan generasi berprestasi.' 
                : 'We provide mentoring programs and national & international scale competitions to foster a high-achieving generation.' 
            }}
        </p>
    </div>
</section>

<!-- Main Services Section -->
<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-4 max-w-6xl space-y-24">

        <!-- 1. National Science Olympiad -->
        <div id="olympiad" class="scroll-mt-24 bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100 dark:border-gray-700 transition-all-300">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="w-full lg:w-1/2">
                    <div class="w-16 h-16 bg-genesis-pink/10 text-genesis-pink rounded-2xl flex items-center justify-center text-3xl mb-6">
                        <i class="fa-solid fa-microscope"></i>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
                        National Science <span class="text-genesis-pink">Olympiad</span>
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base mb-8 leading-relaxed">
                        {{ app()->getLocale() == 'id'
                            ? 'National Science Olympiad (NSO) adalah kompetisi akademik berskala nasional yang diselenggarakan secara berkala oleh Genesis Indo. Kompetisi ini menguji pemahaman konsep, logika berpikir, dan kemampuan pemecahan masalah siswa dalam berbagai disiplin sains dan teknologi.'
                            : 'National Science Olympiad (NSO) is a national-scale academic competition held regularly by Genesis Indo. This competition tests students\' conceptual understanding, logical thinking, and problem-solving abilities in various disciplines of science and technology.'
                        }}
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Tingkat SD, SMP, SMA' : 'Elementary, Junior & Senior High' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Sertifikat & Medali Resmi' : 'Official Certificates & Medals' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Matematika, IPA, IPS, Bahasa' : 'Math, Science, Social, Languages' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Portal Ujian Online Handal' : 'Reliable Online Exam Portal' }}
                        </div>
                    </div>
                    <a href="https://wa.me/6285179637420?text=Halo%20Genesis%20Indo,%20saya%20tertarik%20mendaftar%20National%20Science%20Olympiad" 
                       target="_blank" 
                       class="inline-flex items-center justify-center bg-genesis-pink hover:bg-genesis-pinkDark text-white font-bold px-8 py-3 rounded-xl transition shadow-lg active:scale-95">
                        {{ app()->getLocale() == 'id' ? 'Daftar Kompetisi' : 'Register Now' }}
                        <i class="fa-brands fa-whatsapp ml-2 text-lg"></i>
                    </a>
                </div>
                <div class="w-full lg:w-1/2">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80" 
                         alt="Science Olympiad" 
                         class="w-full h-80 md:h-[400px] object-cover rounded-3xl shadow-lg">
                </div>
            </div>
        </div>

        <!-- 2. Intensive Mentoring -->
        <div id="mentoring" class="scroll-mt-24 bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100 dark:border-gray-700 transition-all-300">
            <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
                <div class="w-full lg:w-1/2">
                    <div class="w-16 h-16 bg-genesis-pink/10 text-genesis-pink rounded-2xl flex items-center justify-center text-3xl mb-6">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
                        Intensive <span class="text-genesis-pink">Mentoring</span>
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base mb-8 leading-relaxed">
                        {{ app()->getLocale() == 'id'
                            ? 'Program bimbingan belajar eksklusif yang dirancang secara khusus untuk mempersiapkan siswa menghadapi berbagai ajang olimpiade sains nasional. Dibimbing oleh para pengajar ahli, peraih medali olimpiade terdahulu, serta kurikulum yang disesuaikan secara dinamis.'
                            : 'Exclusive tutoring program specifically designed to prepare students for various national science olympiads. Guided by expert instructors, past olympiad medalists, and dynamically customized curriculum.'
                        }}
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Tutor Ahli & Berpengalaman' : 'Expert & Experienced Tutors' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Kurikulum Olimpiade Terkini' : 'Latest Olympiad Curriculum' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Simulasi Ujian Rutin (Tryout)' : 'Routine Exam Simulations (Tryout)' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Sesi Konsultasi Eksklusif' : 'Exclusive Consultation Session' }}
                        </div>
                    </div>
                    <a href="https://wa.me/6285179637420?text=Halo%20Genesis%20Indo,%20saya%20tertarik%20mengikuti%20Intensive%20Mentoring" 
                       target="_blank" 
                       class="inline-flex items-center justify-center bg-genesis-pink hover:bg-genesis-pinkDark text-white font-bold px-8 py-3 rounded-xl transition shadow-lg active:scale-95">
                        {{ app()->getLocale() == 'id' ? 'Hubungi Admin Bimbingan' : 'Contact Mentoring Team' }}
                        <i class="fa-brands fa-whatsapp ml-2 text-lg"></i>
                    </a>
                </div>
                <div class="w-full lg:w-1/2">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" 
                         alt="Intensive Mentoring" 
                         class="w-full h-80 md:h-[400px] object-cover rounded-3xl shadow-lg">
                </div>
            </div>
        </div>

        <!-- 3. Global Delegation -->
        <div id="global" class="scroll-mt-24 bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100 dark:border-gray-700 transition-all-300">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="w-full lg:w-1/2">
                    <div class="w-16 h-16 bg-genesis-pink/10 text-genesis-pink rounded-2xl flex items-center justify-center text-3xl mb-6">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
                        Global <span class="text-genesis-pink">Delegation</span>
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base mb-8 leading-relaxed">
                        {{ app()->getLocale() == 'id'
                            ? 'Genesis Indo memfasilitasi dan mendampingi siswa-siswi terbaik Indonesia untuk melangkah ke kancah global. Kami memberikan pembinaan mental, penyelarasan kurikulum kompetisi internasional, serta manajemen logistik penuh menuju kompetisi sains bergengsi di dunia luar.'
                            : 'Genesis Indo facilitates and accompanies the best Indonesian students to step onto the global stage. We provide mental training, international competition curriculum alignment, and full logistical management toward prestigious science competitions worldwide.'
                        }}
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Kemitraan Tingkat Dunia' : 'World-Class Partnerships' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Pendampingan Logistik & Visa' : 'Logistics & Visa Assistance' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Pembekalan Bahasa Inggris' : 'English Preparation Classes' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-450">
                            <i class="fa-solid fa-circle-check text-genesis-pink mr-3"></i>
                            {{ app()->getLocale() == 'id' ? 'Pelatihan Adaptasi Budaya' : 'Cultural Adaptation Training' }}
                        </div>
                    </div>
                    <a href="https://wa.me/6285179637420?text=Halo%20Genesis%20Indo,%20saya%20tertarik%20dengan%20program%20Global%20Delegation" 
                       target="_blank" 
                       class="inline-flex items-center justify-center bg-genesis-pink hover:bg-genesis-pinkDark text-white font-bold px-8 py-3 rounded-xl transition shadow-lg active:scale-95">
                        {{ app()->getLocale() == 'id' ? 'Konsultasi Delegasi' : 'Consult with Delegation Coordinator' }}
                        <i class="fa-brands fa-whatsapp ml-2 text-lg"></i>
                    </a>
                </div>
                <div class="w-full lg:w-1/2">
                    <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=800&q=80" 
                         alt="Global Delegation" 
                         class="w-full h-80 md:h-[400px] object-cover rounded-3xl shadow-lg">
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
