<?php

header('Content-Type: text/plain');

echo "=== DIAGNOSTIK STORAGE & SYMLINK ===\n\n";

$publicStoragePath = __DIR__ . '/storage';
$actualStoragePath = __DIR__ . '/../storage/app/public';

// 1. Cek folder asli storage/app/public
echo "1. FOLDER ASLI STORAGE\n";
echo "Path asli: " . realpath($actualStoragePath) . "\n";
echo "Exists: " . (is_dir($actualStoragePath) ? 'YA' : 'TIDAK') . "\n";
echo "Writable: " . (is_writable($actualStoragePath) ? 'YA' : 'TIDAK') . "\n";

// Cek daftar sub-folder di dalam storage asli
if (is_dir($actualStoragePath)) {
    echo "Isi folder storage/app/public:\n";
    $files = scandir($actualStoragePath);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $fullPath = $actualStoragePath . '/' . $file;
            echo "  - $file (" . (is_dir($fullPath) ? 'Folder' : 'File') . ")\n";
            if (is_dir($fullPath)) {
                // List subfiles
                $subfiles = scandir($fullPath);
                foreach ($subfiles as $sub) {
                    if ($sub !== '.' && $sub !== '..') {
                        echo "    * $sub\n";
                    }
                }
            }
        }
    }
}

// 2. Cek Symlink public/storage
echo "\n2. SYMLINK PUBLIC/STORAGE\n";
echo "Path link: $publicStoragePath\n";
echo "Exists: " . (file_exists($publicStoragePath) ? 'YA' : 'TIDAK') . "\n";
echo "Is Symlink: " . (is_link($publicStoragePath) ? 'YA' : 'TIDAK') . "\n";

if (is_link($publicStoragePath)) {
    $target = readlink($publicStoragePath);
    echo "Symlink points to: $target\n";
    echo "Target exists: " . (is_dir($target) ? 'YA' : 'TIDAK') . "\n";
} else {
    echo "[PERINGATAN] public/storage BUKAN merupakan symbolic link! Ini penyebab foto/PDF 404.\n";
}

// 3. Tes Akses File via URL
echo "\n3. TES MEMBUAT FILE UJI COBA\n";
$testFile = $actualStoragePath . '/test-akses.txt';
@file_put_contents($testFile, 'Koneksi storage sukses!');
if (file_exists($testFile)) {
    echo "Berhasil membuat file uji coba di folder asli.\n";
    echo "Silakan coba buka URL ini di browser Anda:\n";
    echo "--> https://genesisindonesia.com/storage/test-akses.txt\n";
    echo "\nJika URL di atas memunculkan tulisan 'Koneksi storage sukses!', artinya symlink berfungsi dan masalahnya adalah file foto/PDF Anda memang tidak ada/belum di-upload ke server.\n";
} else {
    echo "Gagal membuat file uji coba di folder asli. Masalah permission.\n";
}
