<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $guarded = [];

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function texts(): HasMany
    {
        return $this->hasMany(Text::class);
    }
}
