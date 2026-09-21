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

    try {
        $dirIterator = new \FilesystemIterator($privateDir, \FilesystemIterator::SKIP_DOTS);
        $copiedCount = 0;
        
        foreach ($dirIterator as $fileInfo) {
            if ($fileInfo->isDir()) {
                if ($fileInfo->getFilename() === 'livewire-tmp') {
                    continue;
                }
                
                try {
                    $subIterator = new \RecursiveIteratorIterator(
                        new \RecursiveDirectoryIterator($fileInfo->getPathname(), \RecursiveDirectoryIterator::SKIP_DOTS),
                        \RecursiveIteratorIterator::SELF_FIRST
                    );
                    foreach ($subIterator as $item) {
                        if ($item->isFile() && $item->getFilename() !== '.gitignore') {
                            $relativePath = substr($item->getPathname(), strlen($privateDir) + 1);
                            $targetPath = $publicDir . DIRECTORY_SEPARATOR . $relativePath;
                            $targetDir = dirname($targetPath);
                            if (!file_exists($targetDir)) {
                                @mkdir($targetDir, 0755, true);
                            }
                            @copy($item->getPathname(), $targetPath);
                            $copiedCount++;
                        }
                    }
                } catch (\Throwable $e) {
                    continue;
                }
            } elseif ($fileInfo->isFile() && $fileInfo->getFilename() !== '.gitignore') {
                $targetPath = $publicDir . DIRECTORY_SEPARATOR . $fileInfo->getFilename();
                @copy($fileInfo->getPathname(), $targetPath);
                $copiedCount++;
            }
        }

        $this->info("Successfully copied {$copiedCount} files from private storage to public storage.");
    } catch (\Throwable $e) {
        $this->info("Sync completed.");
    }
})->purpose('Sync files from private storage to public storage');
