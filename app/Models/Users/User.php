<?php

namespace App\Models\Users;

use App\Models\Image;
use App\Models\Users\Cart;
use App\Models\Shops\Store;
use App\Models\Shops\Items\Item;
use App\Models\Process\Purchase;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'avatar', 'password', 'active', 'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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

    public function store()
    {
        return $this->hasOne(Store::class);
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
