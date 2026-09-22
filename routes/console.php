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
    $publicAppDir = storage_path('app/public');
    $publicWebDir = public_path('storage');

    $copiedCount = 0;

    $syncFolder = function ($srcDir, $dstDir) use (&$copiedCount, &$syncFolder) {
        if (!file_exists($srcDir)) return;
        try {
            $iterator = new \FilesystemIterator($srcDir, \FilesystemIterator::SKIP_DOTS);
            foreach ($iterator as $item) {
                if ($item->isDir()) {
                    if ($item->getFilename() === 'livewire-tmp') continue;
                    $syncFolder($item->getPathname(), $dstDir . DIRECTORY_SEPARATOR . $item->getFilename());
                } elseif ($item->isFile() && $item->getFilename() !== '.gitignore') {
                    if (!file_exists($dstDir)) {
                        @mkdir($dstDir, 0755, true);
                    }
                    $targetPath = $dstDir . DIRECTORY_SEPARATOR . $item->getFilename();
                    @copy($item->getPathname(), $targetPath);
                    $copiedCount++;
                }
            }
        } catch (\Throwable $e) {
            // ignore permission errors on single subfolder
        }
    };

    // 1. Sync private to app/public
    $syncFolder($privateDir, $publicAppDir);

    // 2. Sync app/public to public/storage
    $syncFolder($publicAppDir, $publicWebDir);

    $this->info("Successfully synced storage files ({$copiedCount} files processed).");
})->purpose('Sync files from private storage to public storage');
