<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,SoftDeletes;

    protected $guard_name='api';
    protected $fillable=[
        'name',
        'display_name',
        'visibility',
        'starts_from',
        'ends_at',
        'timezone',
        'tag',
        'status',
        'platform_name',
        'joining_link',
        'joining_credentials',
        'joining_instruction',
        'venue',
        'pin',
        'description_text',
        'video',
        
    ];

    public function tickets()
    {
       return $this->hasMany(Ticket::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }


}
