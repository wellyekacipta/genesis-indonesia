<?php

header('Content-Type: text/plain');

echo "=== DIRECTORY PERMISSIONS DIAGNOSIS ===\n\n";

$paths = [
    '/home/genesisindonesia/htdocs/genesisindonesia.com/public',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/public/storage',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/storage',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/storage/app',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/storage/app/public',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/storage/app/public/articles',
    '/home/genesisindonesia/htdocs/genesisindonesia.com/storage/app/public/articles/pdfs',
];

foreach ($paths as $path) {
    echo "Path: $path\n";
    if (file_exists($path)) {
        $perms = fileperms($path);
        
        // Convert to standard octal string
        $octal = substr(sprintf('%o', $perms), -4);
        
        // Get owner & group info
        $ownerInfo = posix_getpwuid(fileowner($path));
        $groupInfo = posix_getgrgid(filegroup($path));
        
        echo "  - Exists: YA\n";
        echo "  - Permissions: $octal\n";
        echo "  - Owner: " . ($ownerInfo ? $ownerInfo['name'] : 'Unknown') . "\n";
        echo "  - Group: " . ($groupInfo ? $groupInfo['name'] : 'Unknown') . "\n";
        echo "  - Readable by PHP: " . (is_readable($path) ? 'YA' : 'TIDAK') . "\n";
        echo "  - Writable by PHP: " . (is_writable($path) ? 'YA' : 'TIDAK') . "\n";
    } else {
        echo "  - Exists: TIDAK EXIST\n";
    }
    echo "\n";
}

echo "PHP Process User: " . posix_getpwuid(posix_geteuid())['name'] . "\n";
echo "PHP Process Group: " . posix_getgrgid(posix_getegid())['name'] . "\n";
