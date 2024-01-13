<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'event_name'=>$this->name,
            'event_display_name'=>$this->display_name,
            'event_visibility'=>$this->visibility,
            'event_starts_from'=>$this->starts_from,
            'event_ends_at'=>$this->ends_at,
            'event_timezone'=>$this->timezone,
            'event_tag'=>$this->tag,
            'event_status'=>$this->status,
            'platform_name'=>$this->platform_name,
            'joining_link'=>$this->joining_link,
            'joining_credentials'=>$this->joining_credentials,
            'joining_instruction'=>$this->joining_instruction,
            'event_venue'=>$this->venue,
            'event_pin'=>$this->pin,
            'event_description_text'=>$this->description_text,
            'video'=>$this->video,
            'tickets'=>TicketResource::collection($this->tickets),

        ];
    }
}
