<?php

namespace App\Models\Process;

use App\Models\Process\Purchase;
use Illuminate\Database\Eloquent\Model;

class StatusBy extends Model
{
    const USER = 1;
    const SELLER = 2;
    const SYSTEM = 3;

    public $timestamps = false;

    protected $guarded = [];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
