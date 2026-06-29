<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
