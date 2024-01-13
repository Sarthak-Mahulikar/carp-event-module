<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'participant_name',
        'participant_email',
        'participant_phone',
        'title',
        'gender',
        'designation',
        'organization',
        'emergency_contact',
        'emergency_contact_name',
        'emergency_contact_relation',
        'blood_group',
        'where_did_you_hear_about_us',
        'note_to_organiser',
        'payment_status',
        'event_id',
        
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }


    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }


}
