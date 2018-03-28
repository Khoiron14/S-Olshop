<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    const USER_DEFAULT = 'seeds/user.png';
    const ITEM_DEFAULT = 'seeds/item.png';
    const STORE_DEFAULT = 'seeds/store.png';

    protected $guarded = [];

    public function isDefault() : bool
    {
        return $this->path == self::USER_DEFAULT || self::ITEM_DEFAULT || self::STORE_DEFAULT;
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
