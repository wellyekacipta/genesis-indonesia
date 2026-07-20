<?php

header('Content-Type: text/plain');

echo "=== SYSTEM DIAGNOSIS VIA SHELL ===\n\n";

$commands = [
    'ls -ld /home/genesisindonesia/htdocs/genesisindonesia.com/public/storage',
    'ls -ld /home/genesisindonesia/htdocs/genesisindonesia.com/storage/app/public',
    'readlink -f /home/genesisindonesia/htdocs/genesisindonesia.com/public/storage',
    'file /home/genesisindonesia/htdocs/genesisindonesia.com/public/storage',
];

foreach ($commands as $cmd) {
    echo "Running: $cmd\n";
    $output = shell_exec($cmd . ' 2>&1');
    echo "Output:\n$output\n";
    echo str_repeat("-", 40) . "\n";
}
