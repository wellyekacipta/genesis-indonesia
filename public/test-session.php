<?php

// Diagnostic script to check session and folder permissions
header('Content-Type: text/plain');

echo "=== DIAGNOSTIK SERVER GENESIS INDONESIA ===\n\n";

// 1. Check PHP User
echo "PHP running as user: " . posix_getpwuid(posix_geteuid())['name'] . "\n";

// 2. Check Storage Permissions
$storagePath = __DIR__ . '/../storage';
echo "Storage path: " . realpath($storagePath) . "\n";
echo "Storage folder exists: " . (is_dir($storagePath) ? 'YA' : 'TIDAK') . "\n";
echo "Storage folder writable: " . (is_writable($storagePath) ? 'YA' : 'TIDAK') . "\n";

$sessionPath = $storagePath . '/framework/sessions';
echo "Sessions path exists: " . (is_dir($sessionPath) ? 'YA' : 'TIDAK') . "\n";
if (is_dir($sessionPath)) {
    echo "Sessions folder writable: " . (is_writable($sessionPath) ? 'YA' : 'TIDAK') . "\n";
    
    // Try to write a test file
    $testFile = $sessionPath . '/test_write.txt';
    @file_put_contents($testFile, 'test');
    if (file_exists($testFile)) {
        echo "Write test to sessions folder: SUKSES\n";
        unlink($testFile);
    } else {
        echo "Write test to sessions folder: GAGAL (Izin Tulis Ditolak/Permission Denied)\n";
    }
}

// 3. Check Cache Permissions
$cachePath = __DIR__ . '/../bootstrap/cache';
echo "Cache folder exists: " . (is_dir($cachePath) ? 'YA' : 'TIDAK') . "\n";
if (is_dir($cachePath)) {
    echo "Cache folder writable: " . (is_writable($cachePath) ? 'YA' : 'TIDAK') . "\n";
}

echo "\n==========================================\n";
