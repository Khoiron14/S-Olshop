<?php

namespace App\Models\Users;

use App\Models\Users\User;
use App\Models\Shops\Items\Item;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    const MINIMUM_QUANTITY = 1;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
