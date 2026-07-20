<?php

header('Content-Type: text/plain');

echo "=== RECREATING SYMLINK VIA PHP (FOR OWNER ALIGNMENT) ===\n\n";

$link = '/home/genesisindonesia/htdocs/genesisindonesia.com/public/storage';
$target = '/home/genesisindonesia/htdocs/genesisindonesia.com/storage/app/public';

if (file_exists($link) || is_link($link)) {
    echo "Deleting old link...\n";
    if (unlink($link)) {
        echo "Old link deleted successfully.\n";
    } else {
        echo "Failed to delete old link!\n";
        exit;
    }
}

echo "Creating new symlink as PHP user...\n";
if (symlink($target, $link)) {
    echo "SUCCESS! New symlink created.\n";
    
    // Check new owner
    $ownerInfo = posix_getpwuid(fileowner($link));
    echo "New link owner: " . ($ownerInfo ? $ownerInfo['name'] : 'Unknown') . "\n";
    
    $targetOwnerInfo = posix_getpwuid(fileowner($target));
    echo "Target directory owner: " . ($targetOwnerInfo ? $targetOwnerInfo['name'] : 'Unknown') . "\n";
    
    if ($ownerInfo['name'] === $targetOwnerInfo['name']) {
        echo "\n--> OWNERS MATCH PERFECTLY! Nginx will now allow this symlink.\n";
    } else {
        echo "\n--> WARNING: Owners still do not match.\n";
    }
} else {
    echo "FAILED to create new symlink!\n";
}
