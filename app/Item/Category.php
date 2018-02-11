<?php

namespace App\Item;

use App\Item\Item;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
