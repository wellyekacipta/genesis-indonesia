<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'title_id',
        'title_en',
        'image',
        'wa_number_1',
        'wa_number_2',
        'description_id',
        'description_en',
        'is_active',
    ];

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
