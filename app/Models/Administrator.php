<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    protected $fillable =  ['name', 'email', 'image'];

    protected $hidden = ['password'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
