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
