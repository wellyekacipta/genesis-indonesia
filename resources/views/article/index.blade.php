@extends('layouts.app')

@section('title', app()->getLocale() == 'id' ? 'Artikel & Berita - Genesis Indonesia' : 'Articles & News - Genesis Indonesia')
@section('meta_description', 'Kumpulan berita, artikel pendidikan, dan liputan kegiatan terbaru dari Genesis Indonesia.')

@section('content')
<!-- Page Header -->
<section class="relative bg-genesis-blue text-white py-16 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-25" style="background-image: linear-gradient(rgba(30, 64, 175, 0.95), rgba(236, 72, 153, 0.35)), url('https://images.unsplash.com/photo-1506784983877-45594efa4cbe?auto=format&fit=crop&w=1920&q=80')"></div>
    <div class="container mx-auto px-4 max-w-6xl relative z-10 text-center">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-4 tracking-tight leading-tight">
            {{ app()->getLocale() == 'id' ? 'Artikel & Berita' : 'Articles & News' }}
        </h1>
        <p class="text-blue-100/90 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
            {{ app()->getLocale() == 'id'
                ? 'Temukan informasi terbaru, artikel edukasi, panduan olimpiade, dan liputan kegiatan dari Genesis Indonesia.'
                : 'Find the latest information, educational articles, olympiad guides, and event coverage from Genesis Indonesia.'
            }}
        </p>
    </div>
</section>

<!-- Articles Grid Section -->
<section class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
                <div class="bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700 flex flex-col hover:-translate-y-2 transition-transform duration-300">
                    <!-- Image Wrapper -->
                    <div class="relative h-56 bg-gray-200 dark:bg-gray-700">
                        @if($article->image)
                            <img src="{{ Storage::url($article->image) }}" class="w-full h-full object-cover" alt="{{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-genesis-blue/5 text-genesis-blue/30 dark:bg-gray-700 dark:text-gray-600">
                                <i class="fa-solid fa-newspaper text-5xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white/95 dark:bg-gray-900/90 backdrop-blur px-3 py-1.5 rounded-lg text-xs font-bold text-genesis-blue dark:text-blue-400 shadow-sm">
                            <i class="fa-regular fa-calendar mr-1"></i> {{ $article->created_at->format('d M Y') }}
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 line-clamp-2 leading-snug">
                            <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-genesis-pink transition-colors">
                                {{ app()->getLocale() == 'id' ? $article->title_id : $article->title_en }}
                            </a>
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-3 mb-6 flex-1 leading-relaxed">
                            {{ strip_tags(app()->getLocale() == 'id' ? $article->content_id : $article->content_en) }}
                        </p>
                        <div class="pt-4 border-t border-gray-50 dark:border-gray-700">
                            <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center text-sm font-bold text-genesis-blue dark:text-blue-400 hover:text-genesis-pink transition-colors group">
                                {{ app()->getLocale() == 'id' ? 'Baca Selengkapnya' : 'Read More' }}
                                <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1.5 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($articles->isEmpty())
            <div class="text-center text-gray-500 dark:text-gray-400 py-20 bg-white dark:bg-gray-800 rounded-3xl border border-dashed border-gray-300 dark:border-gray-700">
                <i class="fa-regular fa-folder-open text-5xl mb-4 text-gray-300 dark:text-gray-600"></i>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                    {{ app()->getLocale() == 'id' ? 'Belum Ada Artikel' : 'No Articles Found' }}
                </h3>
                <p class="text-sm text-gray-550 dark:text-gray-400">
                    {{ app()->getLocale() == 'id' ? 'Kembali lagi nanti untuk pembaruan artikel terbaru dari kami.' : 'Please check back later for updates.' }}
                </p>
            </div>
        @endif

        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            {{ $articles->links('pagination::tailwind') }}
        </div>
    </div>
</section>
@endsection
