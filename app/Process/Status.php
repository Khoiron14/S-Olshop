<?php

namespace App\Process;

use App\Process\Purchase;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded = [];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
