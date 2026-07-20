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

