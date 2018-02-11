<?php

namespace App;

use App\User;
use App\Item\Item;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'domain';
    }

    public function getAvatar()
    {
        if (!$this->avatar) {
            return null;
        }

        return asset('images/' . $this->avatar);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
