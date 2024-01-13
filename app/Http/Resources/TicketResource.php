<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'ticket_name'=>$this->name,
            'ticket_type'=>$this->type,
            'ticket_quantity'=>$this->quantity,
            'ticket_price'=>$this->price,
            'ticket_sale_starts_from'=>$this->sale_starts_from,
            'ticket_sale_ends_at'=>$this->sale_ends_at,
            'ticket_description'=>$this->description,
            'message_to_attendee'=>$this->message_to_attendee,
            'ticket_status'=>$this->status,
        ];
    }
}
