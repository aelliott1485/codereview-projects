<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * https://codereview.stackexchange.com/q/281639/120114
 */
class Link extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, LinkProduct::class);
    }
}
