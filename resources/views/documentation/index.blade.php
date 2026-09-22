@extends('layouts.app')

@section('title', app()->getLocale() == 'id' ? 'Dokumentasi & Galeri Kegiatan | Genesis Indonesia' : 'Documentation & Event Gallery | Genesis Indonesia')

@section('content')
<!-- Header Banner -->
<section class="relative bg-gradient-to-r from-genesis-blue via-blue-900 to-indigo-900 text-white py-16 md:py-24 overflow-hidden">
    <!-- Ambient Glows & Dot Matrix Grid -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-genesis-pink/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]"></div>
    
    <div class="container mx-auto px-4 max-w-6xl relative z-10 text-center">
        <span class="inline-block py-1.5 px-4 bg-genesis-pink/20 text-genesis-pink border border-genesis-pink/30 rounded-full font-bold text-xs uppercase tracking-widest mb-4 backdrop-blur-md shadow-lg">
            {{ app()->getLocale() == 'id' ? 'Galeri Foto & Dokumentasi' : 'Photo Gallery & Documentation' }}
        </span>
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight drop-shadow-md">
            {{ app()->getLocale() == 'id' ? 'Dokumentasi Kegiatan' : 'Event Documentation' }}
        </h1>
        <p class="text-gray-300 text-sm md:text-base max-w-2xl mx-auto font-medium leading-relaxed">
            {{ app()->getLocale() == 'id' 
                ? 'Arsip dokumentasi foto berbagai kegiatan, pelatihan, dan olimpiade pendidikan nasional Genesis Indonesia.' 
                : 'Photo documentation archives of various events, training, and national education olympiads by Genesis Indonesia.' }}
        </p>
    </div>
</section>

<!-- Main Gallery Content -->
<section class="relative py-12 md:py-20 bg-gray-50 dark:bg-gray-900 min-h-screen overflow-hidden">
    <!-- Decorative Ambient Blobs -->
    <div class="absolute top-1/3 left-0 w-80 h-80 bg-genesis-pink/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>
    
    <div class="container mx-auto px-4 max-w-6xl relative z-10">
        
        @if($categories->count() > 0)
            <!-- Category Filter Tabs -->
            <div class="flex items-center justify-center flex-wrap gap-2.5 mb-12" id="gallery-tabs">
                <button type="button" 
                        onclick="filterCategory('all')" 
                        class="tab-btn active px-6 py-2.5 rounded-full text-xs md:text-sm font-bold transition-all duration-300 shadow-sm cursor-pointer bg-genesis-pink text-white">
                    {{ app()->getLocale() == 'id' ? 'Semua Dokumentasi' : 'All Documentation' }}
                </button>
                @foreach($categories as $cat)
                    <button type="button" 
                            onclick="filterCategory('cat-{{ $cat->id }}')" 
                            class="tab-btn px-6 py-2.5 rounded-full text-xs md:text-sm font-bold transition-all duration-300 shadow-sm cursor-pointer bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700">
                        {{ app()->getLocale() == 'id' ? $cat->title_id : $cat->title_en }}
                    </button>
                @endforeach
            </div>

            <!-- Category Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach($categories as $category)
                    <div class="category-card cat-{{ $category->id }} bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-lg border border-gray-100 dark:border-gray-700/60 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl flex flex-col">
                        <!-- Card Header Image -->
                        <div class="relative h-56 overflow-hidden group">
                            <img src="{{ $category->cover_image_url }}" 
                                 alt="{{ $category->title_id }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            
                            <!-- Photo Count Badge -->
                            <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-full flex items-center shadow-md">
                                <i class="fa-solid fa-camera mr-1.5 text-genesis-pink"></i>
                                <span>{{ $category->photos->count() }} {{ app()->getLocale() == 'id' ? 'Foto' : 'Photos' }}</span>
                            </div>

                            <!-- Title on Image -->
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-xl font-bold text-white leading-snug drop-shadow-md">
                                    {{ app()->getLocale() == 'id' ? $category->title_id : $category->title_en }}
                                </h3>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ app()->getLocale() == 'id' ? ($category->description_id ?: 'Dokumentasi foto kegiatan Genesis Indonesia.') : ($category->description_en ?: 'Photo documentation of Genesis Indonesia events.') }}
                            </p>

                            <!-- Photo Thumbnails Preview -->
                            @if($category->photos->count() > 0)
                                <div class="grid grid-cols-4 gap-2 mb-6">
                                    @foreach($category->photos->take(4) as $photoIndex => $photo)
                                        <div class="relative h-16 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-700 cursor-pointer group"
                                             onclick="openLightbox({{ $category->id }}, {{ $photoIndex }})">
                                            <img src="{{ $photo->image_url }}" alt="Preview" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                            @if($photoIndex === 3 && $category->photos->count() > 4)
                                                <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px] flex items-center justify-center text-white text-xs font-bold">
                                                    +{{ $category->photos->count() - 4 }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700/60">
                                <a href="{{ route('documentation.show', $category->slug) }}" 
                                   class="inline-flex items-center font-bold text-sm text-genesis-pink hover:text-genesis-pinkDark transition-colors">
                                    <span>{{ app()->getLocale() == 'id' ? 'Lihat Galeri Lengkap' : 'View Full Gallery' }}</span>
                                    <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                                @if($category->photos->count() > 0)
                                    <button type="button" 
                                            onclick="openLightbox({{ $category->id }}, 0)"
                                            class="p-2 text-gray-400 hover:text-genesis-pink transition-colors cursor-pointer"
                                            title="{{ app()->getLocale() == 'id' ? 'Pratinjau Foto' : 'Quick Preview' }}">
                                        <i class="fa-solid fa-expand text-base"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-12 text-center max-w-lg mx-auto shadow-md border border-gray-100 dark:border-gray-700">
                <div class="w-20 h-20 bg-genesis-pink/10 text-genesis-pink rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fa-solid fa-images"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ app()->getLocale() == 'id' ? 'Belum Ada Dokumentasi' : 'No Documentation Available' }}
                </h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">
                    {{ app()->getLocale() == 'id' ? 'Dokumentasi foto kegiatan akan segera ditambahkan.' : 'Event photo documentation will be added soon.' }}
                </p>
                <a href="{{ route('home') }}" class="inline-block bg-genesis-blue hover:bg-blue-800 text-white font-bold px-6 py-2.5 rounded-full text-xs uppercase tracking-wider transition">
                    {{ app()->getLocale() == 'id' ? 'Kembali ke Beranda' : 'Back to Home' }}
                </a>
            </div>
        @endif

    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox-modal" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-md flex flex-col justify-between p-4 md:p-8">
    <!-- Top Bar -->
    <div class="flex items-center justify-between text-white z-20">
        <div>
            <h4 id="lightbox-category-title" class="font-bold text-base md:text-lg"></h4>
            <p id="lightbox-photo-counter" class="text-xs text-gray-400 font-mono"></p>
        </div>
        <button type="button" onclick="closeLightbox()" class="text-gray-400 hover:text-white text-2xl p-2 cursor-pointer transition">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <!-- Main Image Display -->
    <div class="relative flex-1 flex items-center justify-center my-4">
        <button type="button" onclick="prevPhoto()" class="absolute left-2 md:left-6 text-white bg-black/50 hover:bg-genesis-pink text-xl md:text-2xl w-10 h-10 md:w-14 md:h-14 rounded-full flex items-center justify-center transition cursor-pointer z-20">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <img id="lightbox-image" src="" alt="Documentation Photo" class="max-h-[75vh] max-w-full object-contain rounded-xl shadow-2xl transition-all duration-300">

        <button type="button" onclick="nextPhoto()" class="absolute right-2 md:right-6 text-white bg-black/50 hover:bg-genesis-pink text-xl md:text-2xl w-10 h-10 md:w-14 md:h-14 rounded-full flex items-center justify-center transition cursor-pointer z-20">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

    <!-- Bottom Caption Bar -->
    <div class="text-center text-white z-20 max-w-2xl mx-auto">
        <p id="lightbox-caption" class="text-sm md:text-base font-medium text-gray-200"></p>
    </div>
</div>

<script>
    const categoriesData = {
        @foreach($categories as $cat)
            {{ $cat->id }}: {
                title: @json(app()->getLocale() == 'id' ? $cat->title_id : $cat->title_en),
                photos: [
                    @foreach($cat->photos as $photo)
                        {
                            url: @json($photo->image_url),
                            caption: @json(app()->getLocale() == 'id' ? ($photo->title_id ?: $cat->title_id) : ($photo->title_en ?: $cat->title_en))
                        },
                    @endforeach
                ]
            },
        @endforeach
    };

    let currentCategoryId = null;
    let currentPhotoIndex = 0;

    function filterCategory(catClass) {
        const cards = document.querySelectorAll('.category-card');
        const buttons = document.querySelectorAll('.tab-btn');

        buttons.forEach(btn => {
            btn.classList.remove('bg-genesis-pink', 'text-white');
            btn.classList.add('bg-white', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-200');
        });
        event.currentTarget.classList.remove('bg-white', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-200');
        event.currentTarget.classList.add('bg-genesis-pink', 'text-white');

        cards.forEach(card => {
            if (catClass === 'all' || card.classList.contains(catClass)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function openLightbox(catId, photoIndex) {
        if (!categoriesData[catId] || categoriesData[catId].photos.length === 0) return;
        currentCategoryId = catId;
        currentPhotoIndex = photoIndex;
        updateLightboxContent();
        document.getElementById('lightbox-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function updateLightboxContent() {
        const category = categoriesData[currentCategoryId];
        const photo = category.photos[currentPhotoIndex];
        
        document.getElementById('lightbox-category-title').textContent = category.title;
        document.getElementById('lightbox-photo-counter').textContent = `${currentPhotoIndex + 1} / ${category.photos.length}`;
        document.getElementById('lightbox-image').src = photo.url;
        document.getElementById('lightbox-caption').textContent = photo.caption || '';
    }

    function prevPhoto() {
        const category = categoriesData[currentCategoryId];
        if (!category) return;
        currentPhotoIndex = (currentPhotoIndex - 1 + category.photos.length) % category.photos.length;
        updateLightboxContent();
    }

    function nextPhoto() {
        const category = categoriesData[currentCategoryId];
        if (!category) return;
        currentPhotoIndex = (currentPhotoIndex + 1) % category.photos.length;
        updateLightboxContent();
    }

    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('lightbox-modal');
        if (modal && !modal.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') prevPhoto();
            if (e.key === 'ArrowRight') nextPhoto();
        }
    });
</script>
@endsection
