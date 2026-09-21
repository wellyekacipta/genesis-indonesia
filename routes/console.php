<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('log:clear', function () {
    $files = glob(storage_path('logs/*.log'));
    foreach ($files as $file) {
        if (is_file($file)) {
            file_put_contents($file, '');
        }
    }
    $this->info('Log files cleared successfully.');
})->purpose('Clear application log files');

Artisan::command('storage:fix-private', function () {
    $privateDir = storage_path('app/private');
    $publicDir = storage_path('app/public');

    if (!file_exists($privateDir)) {
        $this->info('No private storage directory found.');
        return;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($privateDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    $copiedCount = 0;
    foreach ($iterator as $item) {
        if ($item->isFile() && $item->getFilename() !== '.gitignore') {
            $relativePath = substr($item->getPathname(), strlen($privateDir) + 1);
            $targetPath = $publicDir . DIRECTORY_SEPARATOR . $relativePath;
            
            $targetDir = dirname($targetPath);
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            copy($item->getPathname(), $targetPath);
            $copiedCount++;
        }
    }

    $this->info("Successfully copied {$copiedCount} files from private storage to public storage.");
})->purpose('Sync files from private storage to public storage');
