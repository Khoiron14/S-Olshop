<?php

namespace App;

use App\User;
use App\Image;
use App\Item\Item;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'domain';
    }

    public function getImage()
    {
        if (!$this->image()) {
            return null;
        }

        return asset('images/' . $this->image()->path);
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
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
