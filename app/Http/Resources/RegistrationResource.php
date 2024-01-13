<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'=>$this->_id,
            'participant_name'=>$this->participant_name,
            'participant_email'=>$this->participant_email,
            'participant_phone'=>$this->participant_phone,
            'title'=>$this->title,
            'gender'=>$this->gender,
            'designation'=>$this->designation,
            'organization'=>$this->organization,
            'emergency_contact'=>$this->emergency_contact,
            'emergency_contact_name'=>$this->emergency_contact_name,
            'emergency_contact_relation'=>$this->emergency_contact_relation,
            'blood_group'=>$this->blood_group,
            'where_did_you_hear_about_us'=>$this->where_did_you_hear_about_us,
            'note_to_organiser'=>$this->note_to_organiser,
            'payment_status'=>$this->payment_status,
            'event_id'=>$this->event_id,
          
        ];
    }
}
