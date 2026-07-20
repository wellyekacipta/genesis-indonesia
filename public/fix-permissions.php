<?php

header('Content-Type: text/plain');

echo "=== STARTING PERMISSION FIX VIA PHP ===\n\n";

$targetDir = '/home/genesisindonesia/htdocs/genesisindonesia.com/storage/app/public';

function recursiveChmod($path) {
    if (!file_exists($path)) {
        echo "Path does not exist: $path\n";
        return;
    }

    if (is_dir($path)) {
        // Change directory permission to 755
        if (chmod($path, 0755)) {
            echo "SUCCESS: chmod 755 -> [Folder] $path\n";
        } else {
            echo "FAILED: chmod 755 -> [Folder] $path\n";
        }

        $items = scandir($path);
        foreach ($items as $item) {
            if ($item != '.' && $item != '..') {
                recursiveChmod($path . '/' . $item);
            }
        }
    } else {
        // Change file permission to 644 (or 755 for executables/others, 644 is standard for public files)
        if (chmod($path, 0644)) {
            echo "SUCCESS: chmod 644 -> [File] $path\n";
        } else {
            echo "FAILED: chmod 644 -> [File] $path\n";
        }
    }
}

recursiveChmod($targetDir);

echo "\n=== PERMISSION FIX COMPLETE ===\n";
