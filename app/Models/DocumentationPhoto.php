<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentationPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'documentation_category_id',
        'title_id',
        'title_en',
        'image',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(DocumentationCategory::class, 'documentation_category_id');
    }

    protected static function booted()
    {
        static::saved(function ($photo) {
            Article::syncFileToPublicStorage($photo->image);
        });
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
}
