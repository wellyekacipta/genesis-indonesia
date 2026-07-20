<?php

header('Content-Type: text/plain');

$paths = [
    '/home/genesisindonesia/htdocs/genesisindonesia.com/storage/app/public',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/storage/app',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/storage',
];

foreach ($paths as $path) {
    echo "Path: $path\n";
    if (is_link($path)) {
        echo "  - Is Symbolic Link: YA\n";
        echo "  - Target: " . readlink($path) . "\n";
    } else {
        echo "  - Is Symbolic Link: TIDAK\n";
        if (file_exists($path)) {
            echo "  - Type: " . (is_dir($path) ? "Directory" : "File") . "\n";
        } else {
            echo "  - Exists: TIDAK\n";
        }
    }
    echo "\n";
}
