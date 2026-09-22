@extends('layouts.app')

@section('title', (app()->getLocale() == 'id' ? $category->title_id : $category->title_en) . ' | Genesis Indonesia')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-r from-genesis-blue via-blue-900 to-indigo-900 text-white py-16 md:py-20 overflow-hidden">
    <div class="container mx-auto px-4 max-w-6xl relative z-10">
        <a href="{{ route('documentation.index') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-widest text-genesis-pink hover:text-white transition-colors mb-4">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            {{ app()->getLocale() == 'id' ? 'Kembali ke Semua Galeri' : 'Back to All Galleries' }}
        </a>
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4">
            {{ app()->getLocale() == 'id' ? $category->title_id : $category->title_en }}
        </h1>
        <p class="text-gray-300 text-sm md:text-base max-w-3xl leading-relaxed">
            {{ app()->getLocale() == 'id' ? ($category->description_id ?: 'Dokumentasi foto kegiatan Genesis Indonesia.') : ($category->description_en ?: 'Photo documentation of Genesis Indonesia events.') }}
        </p>
    </div>
</section>

<!-- Photo Grid -->
<section class="py-12 md:py-20 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="container mx-auto px-4 max-w-6xl">
        @if($category->photos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($category->photos as $index => $photo)
                    <div class="group relative bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md border border-gray-100 dark:border-gray-700/60 cursor-pointer transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl"
                         onclick="openDetailLightbox({{ $index }})">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $photo->image_url }}" 
                                 alt="{{ $photo->title_id ?: $category->title_id }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 text-white">
                                <p class="text-xs font-semibold drop-shadow-md">
                                    {{ app()->getLocale() == 'id' ? ($photo->title_id ?: $category->title_id) : ($photo->title_en ?: $category->title_en) }}
                                </p>
                                <span class="text-[10px] text-genesis-pink font-bold uppercase tracking-wider mt-1 flex items-center">
                                    <i class="fa-solid fa-expand mr-1"></i> {{ app()->getLocale() == 'id' ? 'Lihat Ukuran Penuh' : 'View Full Size' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-12 text-center max-w-md mx-auto shadow-md">
                <i class="fa-solid fa-images text-4xl text-genesis-pink mb-4"></i>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                    {{ app()->getLocale() == 'id' ? 'Belum Ada Foto Dalam Kategori Ini' : 'No Photos In This Category' }}
                </h3>
            </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal -->
<div id="detail-lightbox" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-md flex flex-col justify-between p-4 md:p-8">
    <div class="flex items-center justify-between text-white z-20">
        <div>
            <h4 class="font-bold text-base md:text-lg">{{ app()->getLocale() == 'id' ? $category->title_id : $category->title_en }}</h4>
            <p id="lightbox-counter" class="text-xs text-gray-400 font-mono"></p>
        </div>
        <button type="button" onclick="closeDetailLightbox()" class="text-gray-400 hover:text-white text-2xl p-2 cursor-pointer transition">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="relative flex-1 flex items-center justify-center my-4">
        <button type="button" onclick="prevDetailPhoto()" class="absolute left-2 md:left-6 text-white bg-black/50 hover:bg-genesis-pink text-xl md:text-2xl w-10 h-10 md:w-14 md:h-14 rounded-full flex items-center justify-center transition cursor-pointer z-20">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <img id="detail-lightbox-image" src="" alt="Photo" class="max-h-[75vh] max-w-full object-contain rounded-xl shadow-2xl transition-all duration-300">

        <button type="button" onclick="nextDetailPhoto()" class="absolute right-2 md:right-6 text-white bg-black/50 hover:bg-genesis-pink text-xl md:text-2xl w-10 h-10 md:w-14 md:h-14 rounded-full flex items-center justify-center transition cursor-pointer z-20">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

    <div class="text-center text-white z-20 max-w-2xl mx-auto">
        <p id="detail-lightbox-caption" class="text-sm md:text-base font-medium text-gray-200"></p>
    </div>
</div>

<script>
    const photosList = [
        @foreach($category->photos as $p)
            {
                url: @json($p->image_url),
                caption: @json(app()->getLocale() == 'id' ? ($p->title_id ?: $category->title_id) : ($p->title_en ?: $category->title_en))
            },
        @endforeach
    ];

    let currentPhotoIdx = 0;

    function openDetailLightbox(idx) {
        if (photosList.length === 0) return;
        currentPhotoIdx = idx;
        updateDetailContent();
        document.getElementById('detail-lightbox').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailLightbox() {
        document.getElementById('detail-lightbox').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function updateDetailContent() {
        const item = photosList[currentPhotoIdx];
        document.getElementById('lightbox-counter').textContent = `${currentPhotoIdx + 1} / ${photosList.length}`;
        document.getElementById('detail-lightbox-image').src = item.url;
        document.getElementById('detail-lightbox-caption').textContent = item.caption || '';
    }

    function prevDetailPhoto() {
        if (photosList.length === 0) return;
        currentPhotoIdx = (currentPhotoIdx - 1 + photosList.length) % photosList.length;
        updateDetailContent();
    }

    function nextDetailPhoto() {
        if (photosList.length === 0) return;
        currentPhotoIdx = (currentPhotoIdx + 1) % photosList.length;
        updateDetailContent();
    }

    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('detail-lightbox');
        if (modal && !modal.classList.contains('hidden')) {
            if (e.key === 'Escape') closeDetailLightbox();
            if (e.key === 'ArrowLeft') prevDetailPhoto();
            if (e.key === 'ArrowRight') nextDetailPhoto();
        }
    });
</script>
@endsection
