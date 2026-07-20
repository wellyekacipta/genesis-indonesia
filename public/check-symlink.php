<?php

header('Content-Type: text/plain');

$link = '/home/genesisindonesia/htdocs/genesisindonesia.com/public/storage';

if (is_link($link)) {
    echo "public/storage is indeed a symbolic link!\n";
    echo "Target: " . readlink($link) . "\n";
} else {
    echo "public/storage is NOT a symbolic link!\n";
    if (file_exists($link)) {
        echo "It is a regular directory/file.\n";
    } else {
        echo "It does not exist.\n";
    }
}
