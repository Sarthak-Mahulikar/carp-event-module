<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;

    protected $guard_name='api';

    protected $fillable=[
        'name',
        'type',
        'quantity',
        'price',
        'sale_starts_from',
        'sale_ends_at',
        'description',
        'message_to_attendee',
        'status',
        'event_id',
        

    ];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
