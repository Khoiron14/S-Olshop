<?php

namespace App\Models\Process;

use App\Models\Process\Purchase;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const SELLER_CONFIRM = 1;
    const SYSTEM_PENDING = 2;
    const SELLER_CANCEL = 3;
    const SYSTEM_CANCEL = 4;
    const USER_CANCEL = 5;

    public $timestamps = false;

    protected $guarded = [];

    public function isType(string $type) : bool
    {
        return starts_with(strtolower($this->name), $type);
    }

    public function getColor()
    {
        if ($this->isType('confirmed')) {
            return 'text-success';
        } elseif ($this->isType('cancelled')) {
            return 'text-danger';
        }

        return 'text-primary';
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
