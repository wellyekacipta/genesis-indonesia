<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'title_id',
        'title_en',
        'content_id',
        'content_en',
        'image',
        'pdf_file',
        'seo_title',
        'seo_description',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected static function booted()
    {
        static::saved(function ($article) {
            static::syncFileToPublicStorage($article->image);
            static::syncFileToPublicStorage($article->pdf_file);
        });
    }

    public static function syncFileToPublicStorage($path)
    {
        if (!$path || \Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
            return;
        }

        $cleanPath = preg_replace('/^(public\/|storage\/)/', '', $path);
        $targetPath = public_path('storage/' . $cleanPath);
        $targetDir = dirname($targetPath);

        if (!file_exists($targetDir)) {
            @mkdir($targetDir, 0755, true);
        }
        @chmod($targetDir, 0755);

        if (file_exists($targetPath) && !is_dir($targetPath)) {
            @chmod($targetPath, 0644);
            return;
        }

        $sourcePath = storage_path('app/public/' . $cleanPath);
        if (!file_exists($sourcePath)) {
            $sourcePath = storage_path('app/private/' . $cleanPath);
        }

        if (file_exists($sourcePath) && !is_dir($sourcePath)) {
            @chmod($sourcePath, 0644);
            @copy($sourcePath, $targetPath);
            @chmod($targetPath, 0644);
        }
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        $cleanPath = preg_replace('/^(public\/|storage\/)/', '', $this->image);
        return asset('storage/' . ltrim($cleanPath, '/'));
    }

    public function getPdfFileUrlAttribute()
    {
        if (!$this->pdf_file) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($this->pdf_file, ['http://', 'https://'])) {
            return $this->pdf_file;
        }

        $cleanPath = preg_replace('/^(public\/|storage\/)/', '', $this->pdf_file);
        return asset('storage/' . ltrim($cleanPath, '/'));
    }
}
