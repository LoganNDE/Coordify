<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['name', 'surname', 'email', 'image', 'qr_code', 'status', 'event_id'];

    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'checkins')
            ->withTimestamps()
            ->withPivot('scanned_at');
    }
}