@extends('layouts.app')

@php
    $title = app()->getLocale() == 'id' ? $article->title_id : $article->title_en;
    $content = app()->getLocale() == 'id' ? $article->content_id : $article->content_en;
@endphp

@section('title', $article->seo_title ? $article->seo_title : $title . ' - Genesis Indonesia')
@section('meta_description', $article->seo_description ? $article->seo_description : \Illuminate\Support\Str::limit(strip_tags($content), 150))

@section('content')
<section class="py-16 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Article Content -->
            <div class="lg:col-span-8">
                <!-- Back Navigation -->
                <div class="mb-10">
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center text-sm font-bold text-genesis-blue dark:text-blue-400 hover:text-genesis-pink dark:hover:text-genesis-pink transition-colors group">
                        <i class="fa-solid fa-arrow-left mr-2 group-hover:-translate-x-1.5 transition-transform"></i>
                        {{ app()->getLocale() == 'id' ? 'Kembali ke Artikel' : 'Back to Articles' }}
                    </a>
                </div>

                <!-- Article Card -->
                <article class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all-300">
                    <!-- Article Image -->
                    @if($article->image_url)
                        <div class="w-full h-64 md:h-[450px] relative">
                            <img src="{{ $article->image_url }}" alt="{{ $title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        </div>
                    @endif

                    <div class="p-8 md:p-12">
                        <!-- Meta Info -->
                        <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 dark:text-gray-400 mb-8">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg bg-genesis-blue/10 text-genesis-blue dark:bg-blue-900/30 dark:text-blue-400 font-bold uppercase tracking-wider">
                                {{ app()->getLocale() == 'id' ? 'Edukasi' : 'Education' }}
                            </span>
                            <span class="flex items-center">
                                <i class="fa-regular fa-calendar mr-2 text-genesis-pink"></i>
                                {{ $article->created_at->format('d F Y') }}
                            </span>
                            <span class="flex items-center">
                                <i class="fa-regular fa-eye mr-2 text-genesis-pink"></i>
                                {{ $article->views }} {{ app()->getLocale() == 'id' ? 'dilihat' : 'views' }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 dark:text-white leading-tight mb-8">
                            {{ $title }}
                        </h1>

                        <!-- Prose Content (Using Tailwind Typography + custom overrides for dark mode & responsive Excel tables) -->
                        <style>
                            /* =====================================================
                               PARAGRAPH & LINE BREAK SPACING
                               Ensures enters/blank lines are visually preserved
                               in article content rendered from rich editor
                             ====================================================== */
                            .article-content-body p {
                                margin-top: 0.85em !important;
                                margin-bottom: 0.85em !important;
                                min-height: 1em;
                            }
                            /* Empty paragraph used as spacer (pressing Enter in editor) */
                            .article-content-body p:empty,
                            .article-content-body p br:only-child {
                                display: block;
                                min-height: 1.2em;
                                margin-top: 0.5em !important;
                                margin-bottom: 0.5em !important;
                            }
                            /* Ensure <br> tags inside paragraphs add proper line space */
                            .article-content-body br {
                                display: block;
                                content: '';
                                margin-top: 0.4em;
                            }
                            /* Headings spacing */
                            .article-content-body h1,
                            .article-content-body h2,
                            .article-content-body h3,
                            .article-content-body h4,
                            .article-content-body h5,
                            .article-content-body h6 {
                                margin-top: 1.5em !important;
                                margin-bottom: 0.6em !important;
                            }
                            /* List spacing */
                            .article-content-body ul,
                            .article-content-body ol {
                                margin-top: 0.75em !important;
                                margin-bottom: 0.75em !important;
                                padding-left: 1.75em !important;
                            }
                            .article-content-body li {
                                margin-top: 0.3em !important;
                                margin-bottom: 0.3em !important;
                            }
                            /* Blockquote */
                            .article-content-body blockquote {
                                border-left: 4px solid #1e40af;
                                padding-left: 1rem;
                                margin: 1.25em 0 !important;
                                color: #64748b;
                                font-style: italic;
                            }

                            /* =====================================================
                               RESPONSIVE EXCEL TABLE STYLING
                               Supports 1000+ rows with sticky blue header,
                               horizontal & vertical scroll, zebra striping
                             ====================================================== */
                            .article-content-body .table-responsive-wrapper {
                                width: 100%;
                                overflow-x: auto;
                                overflow-y: auto;
                                -webkit-overflow-scrolling: touch;
                                margin: 1.75rem 0;
                                border-radius: 0.75rem;
                                border: 1px solid #e2e8f0;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
                                background: #ffffff;
                                /* 80vh gives large scroll area for 1000+ rows without breaking layout */
                                max-height: 80vh;
                            }
                            .dark .article-content-body .table-responsive-wrapper {
                                border-color: #334155;
                                background: #1e293b;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
                            }
                            .article-content-body table {
                                width: 100% !important;
                                min-width: 600px;
                                border-collapse: separate !important;
                                border-spacing: 0 !important;
                                margin: 0 !important;
                                font-size: 0.875rem !important;
                                line-height: 1.4 !important;
                                text-align: left !important;
                                /* table-layout fixed for consistent columns */
                                table-layout: auto !important;
                            }
                            /* HEADER: Sticky blue Genesis header */
                            .article-content-body table thead tr,
                            .article-content-body table tbody tr:first-child {
                                position: sticky;
                                top: 0;
                                z-index: 10;
                            }
                            .article-content-body table thead th,
                            .article-content-body table thead td,
                            .article-content-body table tr:first-child th,
                            .article-content-body table tr:first-child td {
                                background-color: #1e40af !important;
                                color: #ffffff !important;
                                font-weight: 700 !important;
                                text-transform: uppercase !important;
                                letter-spacing: 0.04em !important;
                                font-size: 0.8125rem !important;
                                padding: 12px 16px !important;
                                border: 1px solid #1d4ed8 !important;
                                border-top: none !important;
                                /* Allow wrapping on small screens */
                                white-space: normal !important;
                                word-break: break-word;
                            }
                            .article-content-body table thead th *,
                            .article-content-body table tr:first-child th *,
                            .article-content-body table tr:first-child td * {
                                color: #ffffff !important;
                                background-color: transparent !important;
                            }
                            /* Table Body Cells */
                            .article-content-body table tbody tr td,
                            .article-content-body table tr:not(:first-child) td,
                            .article-content-body table tr:not(:first-child) th {
                                padding: 10px 16px !important;
                                border-bottom: 1px solid #e2e8f0 !important;
                                border-right: 1px solid #f1f5f9 !important;
                                border-left: none !important;
                                border-top: none !important;
                                color: #334155 !important;
                                vertical-align: middle !important;
                                word-break: break-word;
                            }
                            .dark .article-content-body table tbody tr td,
                            .dark .article-content-body table tr:not(:first-child) td,
                            .dark .article-content-body table tr:not(:first-child) th {
                                border-bottom-color: #334155 !important;
                                border-right-color: #1e293b !important;
                                color: #cbd5e1 !important;
                            }
                            /* Zebra Striping — works for unlimited rows */
                            .article-content-body table tbody tr:nth-child(even),
                            .article-content-body table tr:not(:first-child):nth-child(even) {
                                background-color: #f8fafc !important;
                            }
                            .dark .article-content-body table tbody tr:nth-child(even),
                            .dark .article-content-body table tr:not(:first-child):nth-child(even) {
                                background-color: rgba(30, 41, 59, 0.5) !important;
                            }
                            /* Row hover highlight */
                            .article-content-body table tbody tr:hover,
                            .article-content-body table tr:not(:first-child):hover {
                                background-color: #eff6ff !important;
                                transition: background-color 0.15s ease;
                            }
                            .dark .article-content-body table tbody tr:hover,
                            .dark .article-content-body table tr:not(:first-child):hover {
                                background-color: #1e3a8a33 !important;
                            }
                            /* Mobile optimization */
                            @media (max-width: 640px) {
                                .article-content-body .table-responsive-wrapper {
                                    margin-left: -1rem;
                                    margin-right: -1rem;
                                    border-radius: 0;
                                    border-left: none;
                                    border-right: none;
                                    max-height: 70vh;
                                }
                                .article-content-body table {
                                    font-size: 0.8125rem !important;
                                    min-width: 480px;
                                }
                                .article-content-body table thead th,
                                .article-content-body table tr:first-child th,
                                .article-content-body table tr:first-child td {
                                    padding: 10px 12px !important;
                                    font-size: 0.75rem !important;
                                }
                                .article-content-body table tbody tr td,
                                .article-content-body table tr:not(:first-child) td {
                                    padding: 8px 12px !important;
                                }
                            }
                        </style>

                        <div class="article-content-body prose prose-lg dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed
                                    prose-headings:text-gray-900 dark:prose-headings:text-white prose-headings:font-bold
                                    prose-a:text-blue-600 dark:prose-a:text-blue-400 hover:prose-a:text-genesis-pink transition-colors prose-a:no-underline
                                    prose-strong:text-gray-900 dark:prose-strong:text-white">
                            {!! $content !!}
                        </div>

                        <!-- PDF Attachment Card -->
                        @if($article->pdf_file)
                            <div class="mt-10 p-6 rounded-2xl bg-gray-50 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-750 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 transition-all duration-300 hover:border-genesis-pink/20 hover:shadow-xl">
                                <div class="flex items-center space-x-4 flex-1 min-w-0">
                                    <div class="w-12 h-12 rounded-xl bg-red-500/10 text-red-500 flex items-center justify-center text-2xl flex-shrink-0">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                            {{ app()->getLocale() == 'id' ? 'Dokumen Lampiran PDF' : 'PDF Attachment Document' }}
                                        </h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate">
                                            {{ basename($article->pdf_file) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="{{ $article->pdf_file_url }}" target="_blank" download class="w-full sm:w-auto bg-gradient-to-r from-genesis-pink to-genesis-pinkDark hover:from-genesis-pinkDark hover:to-genesis-pink text-white text-xs font-bold px-6 py-3.5 rounded-full shadow-lg transition duration-200 transform active:scale-95 flex items-center justify-center cursor-pointer">
                                        <i class="fa-solid fa-cloud-arrow-down mr-2 text-sm animate-bounce"></i>
                                        {{ app()->getLocale() == 'id' ? 'UNDUH LAMPIRAN' : 'DOWNLOAD ATTACHMENT' }}
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Social Media Share -->
                        <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-700">
                            <h4 class="text-xs font-bold text-gray-700 dark:text-gray-300 mb-4 uppercase tracking-widest">
                                {{ app()->getLocale() == 'id' ? 'Bagikan Artikel Ini' : 'Share This Article' }}
                            </h4>
                            <div class="flex flex-wrap gap-3">
                                <!-- WhatsApp -->
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($title . ' - ' . request()->url()) }}" target="_blank" rel="noopener noreferrer" class="flex items-center space-x-2 px-4 py-2.5 rounded-full bg-[#25D366] hover:bg-[#20ba59] text-white text-xs font-bold transition shadow hover:-translate-y-0.5">
                                    <i class="fa-brands fa-whatsapp text-base"></i>
                                    <span>WhatsApp</span>
                                </a>
                                <!-- Telegram -->
                                <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($title) }}" target="_blank" rel="noopener noreferrer" class="flex items-center space-x-2 px-4 py-2.5 rounded-full bg-[#0088cc] hover:bg-[#0077b3] text-white text-xs font-bold transition shadow hover:-translate-y-0.5">
                                    <i class="fa-brands fa-telegram text-base"></i>
                                    <span>Telegram</span>
                                </a>
                                <!-- X -->
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($title) }}&url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer" class="flex items-center space-x-2 px-4 py-2.5 rounded-full bg-[#000000] dark:bg-[#1a1a1a] hover:bg-[#333333] text-white text-xs font-bold transition shadow hover:-translate-y-0.5">
                                    <i class="fa-brands fa-x-twitter text-base"></i>
                                    <span>X</span>
                                </a>
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer" class="flex items-center space-x-2 px-4 py-2.5 rounded-full bg-[#1877F2] hover:bg-[#166fe5] text-white text-xs font-bold transition shadow hover:-translate-y-0.5">
                                    <i class="fa-brands fa-facebook-f text-base"></i>
                                    <span>Facebook</span>
                                </a>
                                <!-- Instagram / Copy Link -->
                                <button onclick="copyToClipboard()" class="flex items-center space-x-2 px-4 py-2.5 rounded-full bg-gradient-to-r from-[#833AB4] via-[#FD1D1D] to-[#F56040] hover:opacity-90 text-white text-xs font-bold transition shadow hover:-translate-y-0.5 cursor-pointer">
                                    <i class="fa-brands fa-instagram text-base"></i>
                                    <span id="copy-btn-text">{{ app()->getLocale() == 'id' ? 'Salin Link (Instagram)' : 'Copy Link (Instagram)' }}</span>
                                </button>
                            </div>
                        </div>

                        <script>
                            function copyToClipboard() {
                                navigator.clipboard.writeText(window.location.href).then(() => {
                                    const textSpan = document.getElementById('copy-btn-text');
                                    const orig = textSpan.innerText;
                                    textSpan.innerText = "{{ app()->getLocale() == 'id' ? 'Tersalin!' : 'Copied!' }}";
                                    setTimeout(() => {
                                        textSpan.innerText = orig;
                                    }, 2000);
                                });
                            }

                            // Dynamic Table Enhancement for Excel uploads & responsiveness
                            document.addEventListener('DOMContentLoaded', function () {
                                const articleContainer = document.querySelector('.article-content-body');
                                if (!articleContainer) return;

                                const tables = articleContainer.querySelectorAll('table');
                                tables.forEach(table => {
                                    // 1. Wrap each table in a responsive & scrollable container if not already wrapped
                                    if (!table.parentElement.classList.contains('table-responsive-wrapper')) {
                                        const wrapper = document.createElement('div');
                                        wrapper.className = 'table-responsive-wrapper';
                                        table.parentNode.insertBefore(wrapper, table);
                                        wrapper.appendChild(table);
                                    }

                                    // 2. Ensure top row/header cells are properly marked as header with blue background
                                    const firstRow = table.querySelector('tr');
                                    if (firstRow) {
                                        firstRow.classList.add('table-header-row');
                                        const headerCells = firstRow.querySelectorAll('th, td');
                                        headerCells.forEach(cell => {
                                            cell.style.setProperty('background-color', '#1e40af', 'important');
                                            cell.style.setProperty('color', '#ffffff', 'important');
                                            cell.style.setProperty('font-weight', '700', 'important');
                                            cell.style.setProperty('text-align', 'center', 'important');
                                            // Reset inner span styles often generated by Excel paste
                                            const innerSpans = cell.querySelectorAll('span, strong, font, b, p');
                                            innerSpans.forEach(span => {
                                                span.style.color = '#ffffff';
                                                span.style.backgroundColor = 'transparent';
                                            });
                                        });
                                    }

                                    // 3. Clear ugly inline colors pasted from Excel for body cells to keep crisp styling
                                    const bodyRows = table.querySelectorAll('tr:not(:first-child)');
                                    bodyRows.forEach((row, index) => {
                                        const cells = row.querySelectorAll('td, th');
                                        cells.forEach(cell => {
                                            // If cell has inline bg from Excel (like yellow, green, grey), reset to transparent so zebra stripes take over
                                            if (cell.style.backgroundColor && cell.style.backgroundColor !== 'inherit') {
                                                cell.style.backgroundColor = '';
                                            }
                                        });
                                    });
                                });
                            });
                        </script>
                        
                        <!-- Footer Info -->
                        <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-700 flex flex-wrap justify-between items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                            <div>
                                {{ app()->getLocale() == 'id' ? 'Dipublikasikan oleh' : 'Published by' }}: **Genesis Indonesia Editor**
                            </div>
                            <div>
                                {{ app()->getLocale() == 'id' ? 'Terakhir diperbarui' : 'Last updated' }}: {{ $article->updated_at->format('d M Y, H:i') }} WIB
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Comments Section -->
                <div class="mt-12 bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center">
                        <i class="fa-regular fa-comments text-genesis-pink mr-3"></i>
                        {{ app()->getLocale() == 'id' ? 'Komentar' : 'Comments' }}
                        <span class="ml-2 text-sm bg-genesis-blue/10 dark:bg-blue-900/30 text-genesis-blue dark:text-blue-400 px-3 py-1 rounded-full">
                            {{ $comments->count() }}
                        </span>
                    </h3>

                    <!-- Success Message -->
                    @if(session('comment_success'))
                        <div class="mb-8 p-4 bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-900/50 rounded-2xl text-emerald-800 dark:text-emerald-450 text-sm flex items-start space-x-3">
                            <i class="fa-solid fa-circle-check mt-0.5 text-lg"></i>
                            <div>
                                <h4 class="font-bold mb-1">
                                    {{ app()->getLocale() == 'id' ? 'Komentar Berhasil Terkirim!' : 'Comment Submitted Successfully!' }}
                                </h4>
                                <p>
                                    {{ app()->getLocale() == 'id' 
                                        ? 'Komentar Anda telah diterima dan akan segera tampil setelah disetujui oleh admin.' 
                                        : 'Your comment has been received and will appear once approved by the admin.' 
                                    }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Comments List -->
                    <div class="space-y-6 mb-12">
                        @foreach($comments as $comment)
                            <div class="flex items-start space-x-4 p-4 rounded-2xl bg-gray-50 dark:bg-gray-900/50 border border-gray-100/50 dark:border-gray-800/50">
                                <!-- Avatar Placeholder -->
                                <div class="w-10 h-10 rounded-full bg-genesis-blue/10 dark:bg-blue-900/30 text-genesis-blue dark:text-blue-400 flex items-center justify-center flex-shrink-0 font-bold uppercase">
                                    {{ substr($comment->name, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                            {{ $comment->name }}
                                        </h4>
                                        <span class="text-[10px] text-gray-400">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        @if($comments->isEmpty())
                            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                <i class="fa-regular fa-comment-dots text-4xl mb-3 text-gray-300 dark:text-gray-600 block"></i>
                                <p class="text-sm">
                                    {{ app()->getLocale() == 'id' ? 'Belum ada komentar. Jadilah yang pertama berkomentar!' : 'No comments yet. Be the first to comment!' }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Comment Form -->
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-8">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-6">
                            {{ app()->getLocale() == 'id' ? 'Tinggalkan Komentar' : 'Leave a Comment' }}
                        </h4>
                        <form action="{{ route('articles.comments.store', $article->slug) }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2 uppercase">
                                        {{ app()->getLocale() == 'id' ? 'Nama Lengkap' : 'Full Name' }} <span class="text-genesis-pink">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-genesis-blue dark:focus:ring-blue-500 text-sm transition-colors text-gray-900 dark:text-white">
                                </div>
                                <div>
                                    <label for="email" class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2 uppercase">
                                        {{ app()->getLocale() == 'id' ? 'Alamat Email' : 'Email Address' }} <span class="text-genesis-pink">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-genesis-blue dark:focus:ring-blue-500 text-sm transition-colors text-gray-900 dark:text-white">
                                </div>
                            </div>
                            <div>
                                <label for="comment" class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2 uppercase">
                                    {{ app()->getLocale() == 'id' ? 'Komentar' : 'Comment' }} <span class="text-genesis-pink">*</span>
                                </label>
                                <textarea name="comment" id="comment" rows="5" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-genesis-blue dark:focus:ring-blue-500 text-sm transition-colors text-gray-900 dark:text-white resize-y"></textarea>
                            </div>
                            <div class="flex justify-end pt-2">
                                <button type="submit" class="bg-genesis-blue hover:bg-blue-800 text-white font-bold px-8 py-3.5 rounded-full transition shadow-lg hover:-translate-y-0.5 cursor-pointer">
                                    {{ app()->getLocale() == 'id' ? 'Kirim Komentar' : 'Post Comment' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-8 lg:mt-16">
                <!-- Popular Posts Card -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b border-gray-100 dark:border-gray-700 flex items-center">
                        <i class="fa-solid fa-fire text-genesis-pink mr-2"></i>
                        {{ app()->getLocale() == 'id' ? 'Postingan Populer' : 'Popular Posts' }}
                    </h3>
                    <div class="space-y-6">
                        @foreach($popularArticles as $popArticle)
                            <div class="flex items-center space-x-4 group">
                                <!-- Thumbnail -->
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-700 flex-shrink-0">
                                    @if($popArticle->image_url)
                                        <img src="{{ $popArticle->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ app()->getLocale() == 'id' ? $popArticle->title_id : $popArticle->title_en }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-genesis-blue/5 text-genesis-blue/30 dark:bg-gray-700 dark:text-gray-600">
                                            <i class="fa-solid fa-newspaper text-xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <!-- Info -->
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-genesis-pink transition-colors line-clamp-2 leading-snug">
                                        <a href="{{ route('articles.show', $popArticle->slug) }}">
                                            {{ app()->getLocale() == 'id' ? $popArticle->title_id : $popArticle->title_en }}
                                        </a>
                                    </h4>
                                    <div class="flex items-center space-x-3 mt-1.5 text-xs text-gray-500 dark:text-gray-400">
                                        <span>{{ $popArticle->created_at->format('d M Y') }}</span>
                                        <span class="flex items-center"><i class="fa-regular fa-eye mr-1"></i> {{ $popArticle->views }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($popularArticles->isEmpty())
                            <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                                {{ app()->getLocale() == 'id' ? 'Belum ada postingan populer.' : 'No popular posts yet.' }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
