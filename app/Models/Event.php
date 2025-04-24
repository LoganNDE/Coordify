<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = ['name', 'description', 'community' ,'province', 'address', 'startDate', 'startTime' ,'endDate', 'endTime','paymentType', 'price', 'image', 'category_id' ,'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participant');
    }
    

}
