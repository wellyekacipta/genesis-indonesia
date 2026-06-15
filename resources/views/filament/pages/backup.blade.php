<x-filament-panels::page>
    <div class="space-y-6">
        @if (session()->has('error'))
            <div class="bg-red-50 dark:bg-red-950 border-l-4 border-red-500 p-4 rounded-xl shadow-sm">
                <div class="flex items-center">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 mr-3 text-lg"></i>
                    <p class="text-sm font-medium text-red-800 dark:text-red-200">
                        {{ session('error') }}
                    </p>
                </div>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-900 p-6 md:p-8 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-800">
            <div class="flex items-start space-x-4 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-genesis-pink/10 text-genesis-pink flex items-center justify-center text-2xl flex-shrink-0">
                    <i class="fa-solid fa-download"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Unduh Backup Website & Database</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Siapkan dan unduh salinan lengkap website dan database Anda dalam satu arsip ZIP.</p>
                </div>
            </div>

            <div class="border-t border-b border-gray-100 dark:border-gray-800 py-6 my-6 space-y-4">
                <h3 class="text-sm font-bold text-gray-800 dark:text-gray-200">Arsip backup mencakup:</h3>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-400">
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2.5"></i> Database SQLite (`database/database.sqlite`)</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2.5"></i> File Aplikasi (`app/`, `config/`, `routes/`)</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2.5"></i> Kode Tampilan & Aset (`resources/views/`, `public/`)</li>
                    <li class="flex items-center"><i class="fa-solid fa-check text-green-500 mr-2.5"></i> Konfigurasi Projek (`composer.json`, `package.json`, dll.)</li>
                </ul>
                <p class="text-xs text-gray-400 dark:text-gray-500 italic mt-4"><i class="fa-solid fa-circle-info mr-1"></i> Direktori temporer seperti `node_modules`, `.git`, `storage/logs` dan `storage/framework` akan otomatis diabaikan agar ukuran file tetap ringkas.</p>
            </div>

            <div class="flex justify-start">
                <button wire:click="downloadBackup" wire:loading.attr="disabled" class="bg-genesis-pink hover:bg-genesis-pinkDark disabled:bg-gray-300 disabled:dark:bg-gray-850 text-white px-8 py-3.5 rounded-full font-bold shadow-lg transition duration-200 transform active:scale-95 flex items-center text-sm cursor-pointer">
                    <span wire:loading.remove class="flex items-center">
                        <i class="fa-solid fa-file-zipper mr-2"></i> PROSES & UNDUH BACKUP (ZIP)
                    </span>
                    <span wire:loading class="flex items-center">
                        <i class="fa-solid fa-spinner animate-spin mr-2"></i> MEMPROSES BACKUP...
                    </span>
                </button>
            </div>
        </div>
    </div>
</x-filament-panels::page>
