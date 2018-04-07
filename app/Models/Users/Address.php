<?php

namespace App\Models\Users;

use App\Models\Users\User;
use App\Models\Process\Purchase;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['receiver', 'phone', 'location'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
