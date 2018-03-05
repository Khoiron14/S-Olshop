<?php

namespace App\Models\Process;

use App\Models\Process\Purchase;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
