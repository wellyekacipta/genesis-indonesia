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
}
