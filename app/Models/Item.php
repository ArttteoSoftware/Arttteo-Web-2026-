<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Item $item) {
            if (is_null($item->ordering)) {
                $item->ordering = (static::where('content_id', $item->content_id)->max('ordering') ?? 0) + 1;
            }
        });
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
