@extends('layouts.app')

@section('title', $member['name'] . ' - Genesis Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative bg-genesis-blue text-white py-20 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: linear-gradient(rgba(30, 64, 175, 0.9), rgba(236, 72, 153, 0.3)), url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1920&q=80')"></div>
    <div class="container mx-auto px-4 max-w-4xl relative z-10 text-center">
        <span class="px-3 py-1 bg-genesis-pink/20 text-genesis-pink border border-genesis-pink/30 text-xs font-bold rounded-full mb-4 uppercase tracking-wider inline-block">
            {{ app()->getLocale() == 'id' ? 'Profil Tim Genesis' : 'Genesis Team Profile' }}
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold mb-2">
            {{ $member['name'] }}
        </h1>
        <p class="text-gray-200 text-sm md:text-base font-semibold tracking-wide uppercase">
            {{ app()->getLocale() == 'id' ? $member['role_id'] : $member['role_en'] }}
        </p>
    </div>
</section>

<!-- Detail Section -->
<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row items-center md:items-start gap-12">
            <!-- Member Photo -->
            <div class="w-48 h-48 md:w-64 md:h-64 rounded-2xl overflow-hidden border-4 border-white dark:border-gray-700 shadow-xl flex-shrink-0">
                <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover">
            </div>

            <!-- Member Details -->
            <div class="flex-grow space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        {{ $member['name'] }}
                    </h2>
                    <p class="text-genesis-pink font-bold text-sm uppercase tracking-wide">
                        {{ app()->getLocale() == 'id' ? $member['role_id'] : $member['role_en'] }}
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-700 pt-6 space-y-4">
                    <h4 class="font-bold text-gray-900 dark:text-white uppercase tracking-wider text-xs">
                        {{ app()->getLocale() == 'id' ? 'Tentang Anggota Tim' : 'About Team Member' }}
                    </h4>
                    <p class="text-gray-600 dark:text-gray-300 text-sm md:text-base leading-relaxed text-justify">
                        {{ app()->getLocale() == 'id' ? $member['desc_id'] : $member['desc_en'] }}
                    </p>
                </div>

                <div class="border-t border-gray-100 dark:border-gray-700 pt-6">
                    <a href="{{ route('home') }}#organisasi" class="inline-flex items-center text-sm font-bold text-genesis-blue dark:text-blue-400 hover:text-genesis-pink transition-colors">
                        <i class="fa-solid fa-arrow-left mr-2"></i> {{ app()->getLocale() == 'id' ? 'Kembali ke Beranda' : 'Back to Home' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
