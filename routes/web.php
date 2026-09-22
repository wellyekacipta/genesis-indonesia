<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/competitions', [HomeController::class, 'competitions'])->name('competitions.index');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/{slug}/comments', [ArticleController::class, 'storeComment'])->name('articles.comments.store');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/team/{slug}', function ($slug) {
    $team = [
        'muhammad-ridwan' => [
            'name' => 'Muhammad Ridwan, S.Ag.',
            'role_id' => 'Direktur Utama',
            'role_en' => 'Executive Director',
            'image' => 'images/director_struct.png',
            'desc_id' => 'Muhammad Ridwan, S.Ag. selaku Direktur Utama memimpin arah strategis, operasional, dan pengembangan seluruh program pendidikan dan kompetisi sains di Genesis Indonesia untuk melahirkan generasi juara.',
            'desc_en' => 'Muhammad Ridwan, S.Ag. as the Executive Director leads the strategic direction, operations, and development of all educational programs and science competitions at Genesis Indonesia to foster a champion generation.'
        ],
        'krisna-adi-putra' => [
            'name' => 'Krisna Adi Putra, S.T.',
            'role_id' => 'Operasional: General Affair',
            'role_en' => 'Operations: General Affair',
            'image' => 'images/operational_struct.png',
            'desc_id' => 'Krisna Adi Putra, S.T. memimpin seluruh manajemen operasional, logistik lapangan, dan administrasi umum guna memastikan seluruh kompetisi berjalan tertib, aman, dan efisien.',
            'desc_en' => 'Krisna Adi Putra, S.T. leads all operational management, field logistics, and general administration to ensure all competitions run orderly, safely, and efficiently.'
        ],
        'dinda' => [
            'name' => 'Dinda, S.Pd.',
            'role_id' => 'Keuangan: Accounting Finance',
            'role_en' => 'Finance: Accounting & Finance',
            'image' => 'images/finance_struct.png',
            'desc_id' => 'Dinda, S.Pd. bertanggung jawab penuh atas pengelolaan anggaran, arus kas, transparansi keuangan lembaga, serta administrasi biaya pendaftaran peserta didik dan program bimbingan.',
            'desc_en' => 'Dinda, S.Pd. is fully responsible for budget management, cash flow, financial transparency of the institution, and administrative costs for student registrations and mentoring programs.'
        ],
        'didin-rasidin' => [
            'name' => 'Didin Rasidin, A.Md., Kom.',
            'role_id' => 'Akademik: Tim Kurikulum',
            'role_en' => 'Academic: Curriculum Team',
            'image' => 'images/academic_struct.png',
            'desc_id' => 'Didin Rasidin, A.Md., Kom. menyusun materi akademis, memvalidasi soal-soal olimpiade sains secara ilmiah, serta mengarahkan modul pembelajaran terstruktur bagi seluruh peserta didik.',
            'desc_en' => 'Didin Rasidin, A.Md., Kom. designs academic materials, scientifically validates science olympiad questions, and directs structured learning modules for all students.'
        ],
        'welly-eka-cipta' => [
            'name' => 'Welly Eka Cipta, S.Kom.',
            'role_id' => 'Teknologi: Programmer UI/UX',
            'role_en' => 'Technology: UI/UX Programmer',
            'image' => 'images/tech_struct.png',
            'desc_id' => 'Welly Eka Cipta, S.Kom. mengembangkan portal ujian online, mengoptimasi antarmuka dan pengalaman pengguna (UI/UX), serta memastikan keamanan infrastruktur server Genesis Indonesia.',
            'desc_en' => 'Welly Eka Cipta, S.Kom. develops the online exam portal, optimizes user interfaces and user experience (UI/UX), and ensures the security of Genesis Indonesia\'s server infrastructure.'
        ],
        'muhammad-ilham' => [
            'name' => 'Muhammad Ilham, S.H.',
            'role_id' => 'Pemasaran & Kemitraan: Digital Marketing',
            'role_en' => 'Marketing & Partnership: Digital Marketing',
            'image' => 'images/marketing_struct.png',
            'desc_id' => 'Muhammad Ilham, S.H. menginisiasi kemitraan strategis dengan sekolah-sekolah mitra, mengelola branding digital, serta merancang kampanye pemasaran untuk event olimpiade berskala nasional.',
            'desc_en' => 'Muhammad Ilham, S.H. initiates strategic partnerships with partner schools, manages digital branding, and designs marketing campaigns for national-scale olympiad events.'
        ]
    ];

    if (!array_key_exists($slug, $team)) {
        abort(404);
    }

    return view('team.show', ['member' => $team[$slug]]);
})->name('team.show');

// One-click route to fix all storage file/folder permissions via PHP web process
Route::get('/fix-storage-permissions', function () {
    $storageAppPublic = storage_path('app/public');
    $publicStorage = public_path('storage');

    // 1. Fix parent directory permissions
    $parentDirs = [
        base_path(),
        storage_path(),
        storage_path('app'),
        $storageAppPublic,
        public_path(),
    ];
    foreach ($parentDirs as $pDir) {
        if (file_exists($pDir)) {
            @chmod($pDir, 0755);
        }
    }

    // 2. Handle public/storage symlink vs real directory (convert symlink to real directory to bypass Nginx symlink 403 restrictions)
    if (is_link($publicStorage)) {
        @unlink($publicStorage);
    }
    if (!file_exists($publicStorage)) {
        @mkdir($publicStorage, 0755, true);
    }
    @chmod($publicStorage, 0755);

    $countFiles = 0;
    $countDirs = 0;

    // 3. Helper to recursively copy files and fix permissions
    $copyAndFix = function ($src, $dst) use (&$copyAndFix, &$countFiles, &$countDirs) {
        if (!file_exists($src)) return;
        if (is_dir($src)) {
            if (!file_exists($dst)) {
                @mkdir($dst, 0755, true);
            }
            @chmod($dst, 0755);
            $countDirs++;
            $items = @scandir($src) ?: [];
            foreach ($items as $item) {
                if ($item === '.' || $item === '..') continue;
                $copyAndFix($src . '/' . $item, $dst . '/' . $item);
            }
        } else {
            @chmod($src, 0644);
            $dstDir = dirname($dst);
            if (!file_exists($dstDir)) {
                @mkdir($dstDir, 0755, true);
            }
            @copy($src, $dst);
            @chmod($dst, 0644);
            $countFiles++;
        }
    };

    if (file_exists($storageAppPublic)) {
        $copyAndFix($storageAppPublic, $publicStorage);
    }

    // Also fix permissions for any pre-existing files in publicStorage
    $fixPermissionsOnly = function ($dir) use (&$fixPermissionsOnly) {
        if (!file_exists($dir)) return;
        if (is_dir($dir)) {
            @chmod($dir, 0755);
            $items = @scandir($dir) ?: [];
            foreach ($items as $item) {
                if ($item === '.' || $item === '..') continue;
                $fixPermissionsOnly($dir . '/' . $item);
            }
        } else {
            @chmod($dir, 0644);
        }
    };
    $fixPermissionsOnly($publicStorage);

    return response()->json([
        'status' => 'success',
        'message' => 'Successfully converted public/storage to physical directory and fixed all permissions!',
        'directories_processed' => $countDirs,
        'files_processed' => $countFiles,
        'public_storage_type' => is_link($publicStorage) ? 'symlink' : 'real_directory',
    ]);
});

// Fallback route to guarantee storage files (photos, PDFs, attachments) are served cleanly
Route::get('/storage/{path}', function ($path) {
    $path = ltrim($path, '/');
    
    // Check in storage/app/public/
    $publicPath = storage_path('app/public/' . $path);
    if (file_exists($publicPath) && !is_dir($publicPath)) {
        @chmod($publicPath, 0644);
        return response()->file($publicPath);
    }

    // Check in storage/app/private/
    $privatePath = storage_path('app/private/' . $path);
    if (file_exists($privatePath) && !is_dir($privatePath)) {
        @chmod($privatePath, 0644);
        return response()->file($privatePath);
    }

    // Check directly in storage/app/
    $appPath = storage_path('app/' . $path);
    if (file_exists($appPath) && !is_dir($appPath)) {
        @chmod($appPath, 0644);
        return response()->file($appPath);
    }

    abort(404);
})->where('path', '.*')->name('storage.serve');

