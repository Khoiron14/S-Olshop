<?php

namespace App\Models\Process;

use App\Models\Process\Purchase;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const CONFIRMED = 1;
    const PENDING = 2;
    const CANCELLED = 3;

    public $timestamps = false;

    protected $guarded = [];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
