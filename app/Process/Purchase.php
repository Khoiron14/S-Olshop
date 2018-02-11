<?php

namespace App\Process;

use App\User;
use App\Item\Item;
use App\Process\Status;
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
        return $this->belongsTo(Status::class);
    }
}
