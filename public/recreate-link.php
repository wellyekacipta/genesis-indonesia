<?php

header('Content-Type: text/plain');

echo "=== RE-CREATING STORAGE SYMLINK ===\n\n";

$link = __DIR__ . '/storage';
$target = __DIR__ . '/../storage/app/public';

// 1. Hapus symlink lama yang dibuat oleh user SSH
if (is_link($link)) {
    if (unlink($link)) {
        echo "Sukses menghapus symlink lama yang bermasalah.\n";
    } else {
        echo "Gagal menghapus symlink lama.\n";
    }
} elseif (file_exists($link)) {
    // Jika ternyata folder fisik, kita ganti namanya
    $backupLink = $link . '_backup_' . time();
    if (rename($link, $backupLink)) {
        echo "Mengubah folder fisik storage menjadi backup: $backupLink\n";
    }
} else {
    echo "Tidak ada symlink lama yang terdeteksi. Melanjutkan pembuatan...\n";
}

// 2. Buat symlink baru dengan kepemilikan user web server (genesisindonesia)
if (symlink($target, $link)) {
    echo "Sukses membuat symlink baru!\n";
    echo "Pemilik Symlink Baru: " . posix_getpwuid(posix_geteuid())['name'] . "\n";
    echo "Sekarang silakan coba akses kembali link tes sebelumnya:\n";
    echo "--> https://genesisindonesia.com/storage/test-akses.txt\n";
} else {
    echo "Gagal membuat symlink baru. Silakan periksa log server.\n";
}
