<?php

namespace App\Models\Process;

use App\Models\Users\User;
use App\Models\Process\Status;
use App\Models\Shops\Items\Item;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function status()
    {
        return $this->hasOne(Status::class);
    }
}
