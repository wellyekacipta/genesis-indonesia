<?php

header('Content-Type: text/plain');

echo "=== SERVER ENV DIAGNOSIS ===\n\n";

echo "1. APP_URL from .env: " . env('APP_URL') . "\n";
echo "2. config('app.url'): " . config('app.url') . "\n";
echo "3. request()->root(): " . (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . "\n";
echo "4. Public Storage URL check:\n";
echo "   --> " . asset('storage/test.pdf') . "\n";

echo "\n============================\n";
echo "Jika nomor 1 dan 2 bernilai 'http://localhost', maka ini adalah penyebab UTAMA bug ini!\n";
echo "Laravel akan salah menghasilkan tautan gambar & PDF menjadi 'http://localhost/storage/...' sehingga orang lain tidak bisa mengaksesnya.\n";
