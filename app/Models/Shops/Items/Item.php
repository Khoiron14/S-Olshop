<?php

namespace App\Models\Shops\Items;

use App\Models\Image;
use App\Models\Users\User;
use App\Models\Users\Cart;
use App\Models\Shops\Store;
use App\Models\Process\Purchase;
use App\Models\Shops\Items\Category;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{    
    protected $fillable = ['name', 'price', 'stock'];

    public function getImage()
    {
        if (!$this->images()->first())
        {
            return null;
        }

        return asset('images/' . $this->images()->first()->path);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
