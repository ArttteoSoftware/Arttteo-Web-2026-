<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(PortfolioImage::class)->orderBy('sort_order');
    }

    public function engagements()
    {
        return $this->hasMany(PortfolioEngagement::class);
    }
}
