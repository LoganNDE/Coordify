<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['id', 'name', 'image'];

    public function events(){
        return $this->hasMany(Event::class);
    }
}
