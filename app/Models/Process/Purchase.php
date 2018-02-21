<?php

namespace App\Models\Process;

use App\Models\Users\User;
use App\Models\Items\Item;
use App\Models\Process\Status;
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
