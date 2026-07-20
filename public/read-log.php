<?php

header('Content-Type: text/plain');

echo "=== NGINGX ERROR LOG SEARCH ===\n\n";

$logPaths = [
    '/home/genesisindonesia/logs/nginx/error.log',
    '/home/genesisindonesia/logs/nginx_error.log',
    '/home/genesisindonesia/logs/error.log',
    '/home/genesisindonesia/logs/nginx/genesisindonesia.com.error.log',
];

$found = false;
foreach ($logPaths as $path) {
    echo "Checking: $path\n";
    if (file_exists($path) && is_readable($path)) {
        echo "--> FOUND and READABLE!\n\nLast 30 lines:\n";
        $lines = file($path);
        $lastLines = array_slice($lines, -30);
        echo implode("", $lastLines);
        $found = true;
        break;
    } else {
        echo "  - Exists: " . (file_exists($path) ? "YA (but not readable)" : "TIDAK") . "\n";
    }
}

if (!$found) {
    echo "\nCould not find or read any Nginx error log.\n";
}
