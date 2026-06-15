<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use UnitEnum;
use Illuminate\Support\Facades\Response;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class Backup extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowDownTray;

    protected string $view = 'filament.pages.backup';

    protected static ?string $title = 'Backup Website';

    protected static ?string $navigationLabel = 'Backup Website';

    protected static UnitEnum|string|null $navigationGroup = 'Sistem';

    public function downloadBackup()
    {
        $zipFile = storage_path('app/backup-' . date('Y-m-d-H-i-s') . '.zip');
        
        if (!class_exists('ZipArchive')) {
            session()->flash('error', 'Ekstensi PHP ZipArchive tidak aktif.');
            return;
        }

        $zip = new ZipArchive();

        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            session()->flash('error', 'Gagal membuat file ZIP.');
            return;
        }

        // Add database file if exists
        $dbPath = database_path('database.sqlite');
        if (file_exists($dbPath)) {
            $zip->addFile($dbPath, 'database/database.sqlite');
        }

        // Add important directories (app, config, resources, routes, public)
        $directories = [
            'app' => base_path('app'),
            'config' => base_path('config'),
            'resources' => base_path('resources'),
            'routes' => base_path('routes'),
            'public' => base_path('public'),
        ];

        foreach ($directories as $name => $path) {
            if (is_dir($path)) {
                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($path),
                    RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = $name . '/' . substr($filePath, strlen($path) + 1);
                        
                        // Exclude heavy/cache folders
                        if (str_contains($relativePath, 'node_modules') || 
                            str_contains($relativePath, '.git') || 
                            str_contains($relativePath, 'storage/logs') || 
                            str_contains($relativePath, 'storage/framework')) {
                            continue;
                        }

                        $zip->addFile($filePath, $relativePath);
                    }
                }
            }
        }

        // Add root files
        $rootFiles = ['composer.json', 'package.json', 'vite.config.js', 'artisan', '.env.example', '.env'];
        foreach ($rootFiles as $file) {
            $filePath = base_path($file);
            if (file_exists($filePath)) {
                $zip->addFile($filePath, $file);
            }
        }

        $zip->close();

        if (file_exists($zipFile)) {
            return Response::download($zipFile)->deleteFileAfterSend(true);
        } else {
            session()->flash('error', 'Gagal mengunduh file backup.');
        }
    }
}
