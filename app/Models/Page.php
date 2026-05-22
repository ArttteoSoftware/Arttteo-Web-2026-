<?php

namespace App\Models;

use App\Enums\PageCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Section;

class Page extends Model
{
    protected $guarded = [];

    protected $casts = [
        'category' => PageCategory::class,
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Page $page) {
            if (is_null($page->ordering)) {
                $page->ordering = (static::max('ordering') ?? 0) + 1;
            }
        });
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function texts(): HasMany
    {
        return $this->hasMany(Text::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('ordering');
    }
}
