@extends('layouts.app')

@section('title', app()->getLocale() == 'id' ? 'Visi, Misi & Profil - Genesis Indonesia' : 'Vision, Mission & Profile - Genesis Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative bg-genesis-blue text-white py-20 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: linear-gradient(rgba(30, 64, 175, 0.9), rgba(236, 72, 153, 0.3)), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1920&q=80')"></div>
    <div class="container mx-auto px-4 max-w-6xl relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-4">
            {{ app()->getLocale() == 'id' ? 'Visi, Misi & Profil Kami' : 'Our Vision, Mission & Profile' }}
        </h1>
        <p class="text-gray-200 text-sm md:text-base max-w-2xl mx-auto">
            {{ app()->getLocale() == 'id' 
                ? 'Mengenal lebih dekat komitmen, tujuan utama, dan landasan nilai yang kami pegang untuk masa depan pendidikan Indonesia.' 
                : 'Get to know our commitment, core objectives, and the values we hold for the future of Indonesian education.' 
            }}
        </p>
    </div>
</section>

<!-- Profil & Visi Misi Section -->
<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Sidebar: Director Details -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-150 dark:border-gray-700 sticky top-24 text-center">
                    <div class="relative w-40 h-40 mx-auto mb-6 rounded-3xl overflow-hidden border-4 border-white dark:border-gray-700 shadow-lg">
                        <img src="{{ asset('images/director.jpg') }}" alt="Muhammad Ridwan, S.Ag." class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Muhammad Ridwan, S.Ag.</h3>
                    <p class="text-genesis-pink font-bold text-xs uppercase tracking-widest mt-1 mb-6">
                        {{ app()->getLocale() == 'id' ? 'Direktur Utama' : 'Executive Director' }}
                    </p>
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-6 text-left space-y-4 text-sm text-gray-600 dark:text-gray-400">
                        <div class="flex items-center">
                            <i class="fa-solid fa-envelope text-genesis-pink mr-3 text-base"></i>
                            <span>ridwan@genesisindonesia.com</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Profil Lengkap -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-10 shadow-xl border border-gray-100 dark:border-gray-700">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <i class="fa-solid fa-school text-genesis-pink mr-3"></i>
                        {{ app()->getLocale() == 'id' ? 'Profil Lembaga' : 'Institution Profile' }}
                    </h2>
                    <div class="text-gray-600 dark:text-gray-300 text-sm md:text-base space-y-6 leading-relaxed text-justify">
                        <p>
                            {{ app()->getLocale() == 'id'
                                ? 'Genesis Indonesia Education Centre adalah organisasi pelopor dalam penyelarasan kurikulum olimpiade nasional dan bimbingan belajar intensif di Indonesia. Kami didirikan dengan cita-cita mulia untuk menjadi motor penggerak prestasi akademik pelajar Indonesia demi menyongsong generasi emas Indonesia di kancah persaingan global.'
                                : 'Genesis Indonesia Education Centre is a pioneer organization in national olympiad curriculum alignment and intensive tutoring in Indonesia. We were founded with a noble vision to drive the academic achievement of Indonesian students in welcoming the golden generation to the global stage.'
                            }}
                        </p>
                        <p>
                            {{ app()->getLocale() == 'id'
                                ? 'Dengan mengintegrasikan teknologi modern pada sistem portal ujian (Tryout & Real Test) serta berkolaborasi dengan jajaran akademisi ahli dan mantan peraih medali olimpiade, kami memastikan bahwa setiap event kompetisi yang kami selenggarakan memiliki validitas keilmuan yang tinggi, transparan, objektif, dan tepercaya.'
                                : 'By integrating modern technology into our exam portal system (Tryout & Real Test) and collaborating with expert academics and former olympiad medalists, we ensure that every competition event we host possesses high scientific validity, transparency, objectivity, and trust.'
                            }}
                        </p>
                    </div>
                </div>

                <!-- Visi & Misi -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-10 shadow-xl border border-gray-100 dark:border-gray-700 space-y-8">
                    <!-- Visi -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fa-solid fa-eye text-genesis-pink mr-3"></i>
                            Visi
                        </h2>
                        <div class="p-6 bg-genesis-blue/5 dark:bg-blue-900/10 rounded-2xl border-l-4 border-genesis-pink text-gray-700 dark:text-gray-300 italic text-sm md:text-base leading-relaxed">
                            "{{ app()->getLocale() == 'id'
                                ? 'Menjadi lembaga pendidikan dan pengembangan potensi akademik terkemuka di Indonesia yang melahirkan generasi emas berdaya saing global dengan berlandaskan integritas.'
                                : 'To become the leading educational and academic potential development institution in Indonesia, fostering a golden generation with global competitiveness based on integrity.'
                            }}"
                        </div>
                    </div>

                    <!-- Misi -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fa-solid fa-list-check text-genesis-pink mr-3"></i>
                            Misi
                        </h2>
                        <ul class="space-y-4 text-gray-600 dark:text-gray-300 text-sm md:text-base">
                            @if(app()->getLocale() == 'id')
                                <li class="flex items-start">
                                    <span class="w-6 h-6 bg-genesis-pink/15 text-genesis-pink rounded-full flex items-center justify-center font-bold text-xs mr-3 mt-0.5 flex-shrink-0">1</span>
                                    <span>Menyelenggarakan kompetisi sains dan akademik berkualitas tinggi secara profesional, objektif, dan transparan.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-6 h-6 bg-genesis-pink/15 text-genesis-pink rounded-full flex items-center justify-center font-bold text-xs mr-3 mt-0.5 flex-shrink-0">2</span>
                                    <span>Menyediakan program bimbingan belajar (mentoring) intensif dengan kurikulum terstruktur yang diselaraskan dengan kebutuhan kompetisi nasional &amp; internasional.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-6 h-6 bg-genesis-pink/15 text-genesis-pink rounded-full flex items-center justify-center font-bold text-xs mr-3 mt-0.5 flex-shrink-0">3</span>
                                    <span>Memfasilitasi dan membina siswa-siswi terbaik bangsa untuk melangkah ke kancah global (Global Delegation).</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-6 h-6 bg-genesis-pink/15 text-genesis-pink rounded-full flex items-center justify-center font-bold text-xs mr-3 mt-0.5 flex-shrink-0">4</span>
                                    <span>Menanamkan nilai kejujuran, kerja keras, sportivitas, dan semangat pantang menyerah dalam setiap proses bimbingan.</span>
                                </li>
                            @else
                                <li class="flex items-start">
                                    <span class="w-6 h-6 bg-genesis-pink/15 text-genesis-pink rounded-full flex items-center justify-center font-bold text-xs mr-3 mt-0.5 flex-shrink-0">1</span>
                                    <span>Organise high-quality science and academic competitions professionally, objectively, and transparently.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-6 h-6 bg-genesis-pink/15 text-genesis-pink rounded-full flex items-center justify-center font-bold text-xs mr-3 mt-0.5 flex-shrink-0">2</span>
                                    <span>Provide intensive mentoring programs with structured curriculum aligned to both national &amp; international competition standards.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-6 h-6 bg-genesis-pink/15 text-genesis-pink rounded-full flex items-center justify-center font-bold text-xs mr-3 mt-0.5 flex-shrink-0">3</span>
                                    <span>Facilitate and mentor the nation\'s best students to compete confidently on the international stage (Global Delegation).</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-6 h-6 bg-genesis-pink/15 text-genesis-pink rounded-full flex items-center justify-center font-bold text-xs mr-3 mt-0.5 flex-shrink-0">4</span>
                                    <span>Instil values of honesty, hard work, sportsmanship, and resilience throughout the learning journey.</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Nilai Utama (Core Values) -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-10 shadow-xl border border-gray-100 dark:border-gray-700">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8 flex items-center">
                        <i class="fa-solid fa-heart text-genesis-pink mr-3"></i>
                        {{ app()->getLocale() == 'id' ? 'Nilai-Nilai Utama Kami' : 'Our Core Values' }}
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Value 1 -->
                        <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl text-center border border-gray-100 dark:border-gray-850">
                            <i class="fa-solid fa-shield-halved text-genesis-pink text-3xl mb-4"></i>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-2">Integrity</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                {{ app()->getLocale() == 'id' ? 'Mengedepankan kejujuran, sportivitas, dan transparansi mutlak dalam setiap penilaian.' : 'Prioritising honesty, sportsmanship, and absolute transparency in every assessment.' }}
                            </p>
                        </div>
                        <!-- Value 2 -->
                        <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl text-center border border-gray-100 dark:border-gray-850">
                            <i class="fa-solid fa-fire text-genesis-pink text-3xl mb-4"></i>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-2">Competition</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                {{ app()->getLocale() == 'id' ? 'Mendorong persaingan yang sehat guna memacu batas maksimal kemampuan siswa.' : 'Encouraging healthy competition to push students to their absolute limits.' }}
                            </p>
                        </div>
                        <!-- Value 3 -->
                        <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl text-center border border-gray-100 dark:border-gray-850">
                            <i class="fa-solid fa-star text-genesis-pink text-3xl mb-4"></i>
                            <h4 class="font-bold text-gray-900 dark:text-white mb-2">Excellence</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                {{ app()->getLocale() == 'id' ? 'Berkomitmen pada penyediaan program bimbingan dan kurikulum bermutu tinggi.' : 'Committed to providing high-quality tutoring programs and scientific curriculum.' }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
