<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Content extends Model
{
    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Content $content) {
            if (is_null($content->ordering)) {
                $content->ordering = (static::where('section_id', $content->section_id)->max('ordering') ?? 0) + 1;
            }
        });
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class)->orderBy('ordering');
    }
}
