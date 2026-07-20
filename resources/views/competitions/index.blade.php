@extends('layouts.app')

@section('title', app()->getLocale() == 'id' ? 'Kompetisi Akademik - Genesis Indonesia' : 'Academic Competitions - Genesis Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative bg-genesis-blue text-white py-24 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-25" style="background-image: linear-gradient(rgba(30, 64, 175, 0.95), rgba(236, 72, 153, 0.25)), url('https://images.unsplash.com/photo-1523240715630-991cd2f70ac2?auto=format&fit=crop&w=1920&q=80')"></div>
    <div class="container mx-auto px-4 max-w-6xl relative z-10 text-center">
        <span class="px-4 py-1.5 bg-genesis-pink/20 text-genesis-pink border border-genesis-pink/30 text-xs font-bold rounded-full mb-4 uppercase tracking-wider inline-block">
            {{ app()->getLocale() == 'id' ? 'Kompetisi Mendatang' : 'Upcoming Competitions' }}
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
            {{ app()->getLocale() == 'id' ? 'Ikuti Kompetisi Sains & Akademik' : 'Join Science & Academic Competitions' }}
        </h1>
        <p class="text-gray-200 text-sm md:text-lg max-w-3xl mx-auto leading-relaxed">
            {{ app()->getLocale() == 'id' 
                ? 'Daftarkan diri Anda atau delegasi sekolah dalam ajang olimpiade sains nasional berkualitas tinggi yang kami selenggarakan untuk menguji potensi dan meraih prestasi tingkat nasional.'
                : 'Register yourself or school delegation in high-quality national science olympiads we organize to test potential and achieve national level recognition.' 
            }}
        </p>
    </div>
</section>

<!-- Competitions Grid Section -->
<section class="py-24 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-4 max-w-6xl">
        @if($competitions->isEmpty())
            <div class="text-center py-24 bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-150 dark:border-gray-700 max-w-2xl mx-auto">
                <div class="w-20 h-20 bg-genesis-blue/5 dark:bg-gray-700 text-genesis-blue dark:text-blue-400 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ app()->getLocale() == 'id' ? 'Belum Ada Kompetisi Aktif' : 'No Active Competitions' }}
                </h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm max-w-md mx-auto px-4">
                    {{ app()->getLocale() == 'id' 
                        ? 'Jadwal kompetisi baru sedang disusun. Silakan kembali beberapa saat lagi atau hubungi admin kami.' 
                        : 'New competition schedule is being prepared. Please check back later or contact our admin.' 
                    }}
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($competitions as $comp)
                    <div class="bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700 hover:-translate-y-2 transition-transform duration-300 flex flex-col h-full group">
                        <!-- Image Container (Square 1:1 ratio) -->
                        <div class="relative w-full aspect-square bg-gray-100 dark:bg-gray-700 overflow-hidden flex-shrink-0">
                            <img src="{{ Storage::url($comp->image) }}" alt="{{ app()->getLocale() == 'id' ? $comp->title_id : $comp->title_en }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                <span class="text-white text-xs font-bold uppercase tracking-wider bg-genesis-pink px-4 py-2 rounded-full shadow-lg">
                                    {{ app()->getLocale() == 'id' ? 'Pilih Kompetisi' : 'Select Competition' }}
                                </span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-8 flex-grow flex flex-col justify-between">
                            <div class="space-y-4 mb-8">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2 leading-snug">
                                    {{ app()->getLocale() == 'id' ? $comp->title_id : $comp->title_en }}
                                </h3>
                                <p class="text-gray-550 dark:text-gray-400 text-sm line-clamp-3 leading-relaxed">
                                    {{ app()->getLocale() == 'id' ? $comp->description_id : $comp->description_en }}
                                </p>
                            </div>

                            <!-- Button Trigger (Opens Modal) -->
                            <button onclick="openRegisterModal('{{ addslashes($comp->title_id) }}', '{{ $comp->wa_number_1 }}', '{{ $comp->wa_number_2 }}')" class="w-full bg-genesis-blue hover:bg-blue-800 text-white font-bold py-3.5 rounded-full shadow-lg transition duration-200 text-sm tracking-wide transform active:scale-95 cursor-pointer flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-calendar-check text-base"></i>
                                <span>{{ app()->getLocale() == 'id' ? 'Daftar Sekarang' : 'Register Now' }}</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Beautiful Registration Modal (WhatsApp Admin Choice) -->
<div id="register-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
    <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 max-w-md w-full mx-4 shadow-2xl border border-gray-100 dark:border-gray-700 transform scale-95 transition-all duration-300 relative">
        <!-- Close Button -->
        <button onclick="closeRegisterModal()" class="absolute top-5 right-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors cursor-pointer text-xl">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="text-center mb-6">
            <div class="w-14 h-14 bg-emerald-500/10 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa-brands fa-whatsapp"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                {{ app()->getLocale() == 'id' ? 'Hubungi Admin Pendaftaran' : 'Contact Registration Admin' }}
            </h3>
            <p id="modal-subtitle" class="text-gray-500 dark:text-gray-400 text-xs px-2 leading-relaxed">
                Silakan pilih salah satu admin WhatsApp di bawah untuk berkonsultasi atau mendaftar kompetisi.
            </p>
        </div>

        <div class="space-y-4">
            <!-- Admin 1 Link -->
            <a id="admin-1-btn" href="#" target="_blank" class="flex items-center justify-between p-4 bg-emerald-50 hover:bg-emerald-100/80 dark:bg-emerald-950/20 dark:hover:bg-emerald-950/40 border border-emerald-200/50 dark:border-emerald-900/30 rounded-2xl transition duration-200 group">
                <div class="flex items-center space-x-3.5">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center text-lg">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div class="text-left">
                        <span class="block font-bold text-sm text-gray-800 dark:text-gray-200">WhatsApp Admin 1</span>
                        <span class="block text-xs text-gray-450 dark:text-gray-400 mt-0.5">{{ app()->getLocale() == 'id' ? 'Layanan Cepat' : 'Fast Response' }}</span>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-right text-emerald-500 group-hover:translate-x-1 transition-transform"></i>
            </a>

            <!-- Admin 2 Link -->
            <a id="admin-2-btn" href="#" target="_blank" class="flex items-center justify-between p-4 bg-emerald-50 hover:bg-emerald-100/80 dark:bg-emerald-950/20 dark:hover:bg-emerald-950/40 border border-emerald-200/50 dark:border-emerald-900/30 rounded-2xl transition duration-200 group">
                <div class="flex items-center space-x-3.5">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center text-lg">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div class="text-left">
                        <span class="block font-bold text-sm text-gray-800 dark:text-gray-200">WhatsApp Admin 2</span>
                        <span class="block text-xs text-gray-450 dark:text-gray-400 mt-0.5">{{ app()->getLocale() == 'id' ? 'Layanan Informasi' : 'Information Support' }}</span>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-right text-emerald-500 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</div>

<script>
    function openRegisterModal(title, wa1, wa2) {
        const modal = document.getElementById('register-modal');
        const modalContent = modal.querySelector('div');
        
        // Prefilled WA Message
        const message = encodeURIComponent("Halo, saya ingin bertanya dan mendaftar untuk kompetisi: " + title + "\n\n(Layanan ini dihasilkan dari website: genesisindonesia.com)");
        
        // Update Admin links
        document.getElementById('admin-1-btn').href = "https://api.whatsapp.com/send?phone=" + wa1 + "&text=" + message;
        document.getElementById('admin-2-btn').href = "https://api.whatsapp.com/send?phone=" + wa2 + "&text=" + message;
        
        // Animation Show
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }

    function closeRegisterModal() {
        const modal = document.getElementById('register-modal');
        const modalContent = modal.querySelector('div');
        
        // Animation Hide
        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
    }

    // Close modal on background click
    document.getElementById('register-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRegisterModal();
        }
    });
</script>
@endsection
