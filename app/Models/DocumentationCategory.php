<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentationCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_id',
        'title_en',
        'slug',
        'description_id',
        'description_en',
        'cover_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function photos()
    {
        return $this->hasMany(DocumentationPhoto::class)->orderBy('sort_order', 'asc')->orderBy('id', 'desc');
    }

    protected static function booted()
    {
        static::saved(function ($category) {
            Article::syncFileToPublicStorage($category->cover_image);
        });
    }

    public function getCoverImageUrlAttribute()
    {
        if (!$this->cover_image) {
            // Return first photo image as fallback if cover image is null
            $firstPhoto = $this->photos->first();
            if ($firstPhoto) {
                return $firstPhoto->image_url;
            }
            return asset('images/slide1.jpg');
        }

        if (\Illuminate\Support\Str::startsWith($this->cover_image, ['http://', 'https://'])) {
            return $this->cover_image;
        }

        $cleanPath = preg_replace('/^(public\/|storage\/)/', '', $this->cover_image);
        return asset('storage/' . ltrim($cleanPath, '/'));
    }
}
