<?php

namespace App\Item;

use App\Item\Item;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];
    protected $table = 'image_item';

    public function Item()
    {
        return $this->belongsToMany();
    }
}
