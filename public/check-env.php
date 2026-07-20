<?php

header('Content-Type: text/plain');

echo "=== SERVER ENV DIAGNOSIS ===\n\n";

$envPath = __DIR__ . '/../.env';

if (file_exists($envPath)) {
    echo ".env file found!\n";
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Only output key variables we care about for security
            if (in_array($key, ['APP_URL', 'APP_ENV', 'FILESYSTEM_DISK'])) {
                echo "$key: $value\n";
            }
        }
    }
} else {
    echo ".env file NOT found at $envPath!\n";
}

echo "HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "\n";
echo "HTTPS Status: " . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'ON' : 'OFF') . "\n";
echo "SERVER_PORT: " . $_SERVER['SERVER_PORT'] . "\n";
