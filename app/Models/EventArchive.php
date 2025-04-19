<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventArchive extends Model
{
    protected $fillable = ['name', 'description', 'province', 'address', 'startDate', 'endDate', 'paymentType', 'image', 'user_id'];
}
