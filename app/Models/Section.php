<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Section $section) {
            if (is_null($section->ordering)) {
                $section->ordering = (static::where('page_id', $section->page_id)->max('ordering') ?? 0) + 1;
            }
        });
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class)->orderBy('ordering');
    }
}
