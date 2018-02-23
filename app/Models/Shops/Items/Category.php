<?php

namespace App\Models\Shops\Items;

use App\Models\Shops\Items\Item;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
