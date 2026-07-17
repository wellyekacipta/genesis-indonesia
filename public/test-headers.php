<?php

header('Content-Type: text/plain');

echo "=== DIAGNOSTIK COOKIE & HEADER ===\n\n";

// 1. Tampilkan semua HTTP Headers yang dikirim browser
echo "--- HTTP REQUEST HEADERS ---\n";
foreach (getallheaders() as $name => $value) {
    // Sembunyikan Authorization untuk keamanan
    if (stripos($name, 'Authorization') !== false) {
        $value = '[REDACTED]';
    }
    echo "$name: $value\n";
}

echo "\n--- COOKIES DI TERIMA SERVER ---\n";
if (empty($_COOKIE)) {
    echo "TIDAK ADA COOKIE YANG DITERIMA OLEH SERVER.\n";
    echo "Penyebab: Browser tidak mengirim cookie (karena secure cookie mismatch) atau Nginx membuang cookie.\n";
} else {
    foreach ($_COOKIE as $key => $value) {
        echo "$key: " . substr($value, 0, 15) . "...\n";
    }
}

echo "\n--- PROTOKOL YANG DIDETEKSI PHP ---\n";
echo "HTTPS: " . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'ON' : 'OFF') . "\n";
echo "HTTP_X_FORWARDED_PROTO: " . ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'TIDAK ADA') . "\n";
echo "SERVER_PORT: " . $_SERVER['SERVER_PORT'] . "\n";

// Coba pasang cookie test baru untuk melihat apakah browser menerima cookie berikutnya
setcookie("test_genesis_cookie", "sukses_menyimpan_cookie", time() + 3600, "/", "", true, true);
echo "\n[INFO] Mencoba memasang cookie test baru ('test_genesis_cookie'). Silakan refresh halaman ini sekali lagi untuk melihat apakah cookie test ini muncul di daftar di atas.\n";
