<?php

namespace App;

use App\Cart;
use App\Store;
use App\Item\Item;
use App\Process\Purchase;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'avatar', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return null;
        }

        return asset('images/' . $this->avatar);
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
