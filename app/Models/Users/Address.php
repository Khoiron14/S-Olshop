<?php

namespace App\Models\Users;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['phone', 'location'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
