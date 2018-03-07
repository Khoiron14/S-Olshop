<?php

namespace App\Models\Shops;

use App\Models\Image;
use App\Models\Users\User;
use App\Models\Process\Purchase;
use App\Models\Shops\Items\Item;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'domain', 'description'];

    public function getRouteKeyName()
    {
        return 'domain';
    }

    public function getImage()
    {
        if (!$this->image()->first()) {
            return null;
        }

        return asset('images/' . $this->image()->first()->path);
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

    public function purchases()
    {
        return $this->hasManyThrough(Purchase::class, Item::class);
    }
}
