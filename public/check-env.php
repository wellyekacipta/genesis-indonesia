<?php

header('Content-Type: text/plain');

echo "=== PARENT DIRECTORY PERMISSIONS ===\n\n";

$paths = [
    '/home/genesisindonesia',
    '/home/genesisindonesia/htdocs',
    '/home/genesisindonesia/htdocs/genesisindonesia.com',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/public',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/public/storage',
];

foreach ($paths as $path) {
    echo "Path: $path\n";
    if (file_exists($path)) {
        $perms = fileperms($path);
        $octal = substr(sprintf('%o', $perms), -4);
        $ownerInfo = posix_getpwuid(fileowner($path));
        $groupInfo = posix_getgrgid(filegroup($path));
        
        echo "  - Permissions: $octal\n";
        echo "  - Owner: " . ($ownerInfo ? $ownerInfo['name'] : 'Unknown') . "\n";
        echo "  - Group: " . ($groupInfo ? $groupInfo['name'] : 'Unknown') . "\n";
    } else {
        echo "  - Exists: TIDAK\n";
    }
    echo "\n";
}
