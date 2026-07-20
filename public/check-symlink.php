<?php

header('Content-Type: text/plain');

$dir = '/home/genesisindonesia/htdocs/genesisindonesia.com/storage/app/public';

if (is_dir($dir)) {
    $items = scandir($dir);
    echo "Files inside storage/app/public:\n";
    foreach ($items as $item) {
        if ($item != '.' && $item != '..') {
            $path = $dir . '/' . $item;
            echo "- $item\n";
            if (is_link($path)) {
                echo "  --> IS SYMLINK! Points to: " . readlink($path) . "\n";
            } else {
                echo "  --> Is regular " . (is_dir($path) ? "Directory" : "File") . "\n";
            }
        }
    }
} else {
    echo "Directory does not exist!\n";
}
