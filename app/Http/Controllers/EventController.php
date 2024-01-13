<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Http\Resources\TicketResource;
use App\Interfaces\EventRepositoryInterface;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EventController extends Controller
{

    private EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository=$eventRepository;
    }

    public function addEvent(Request $request)
    {

        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'display_name'=>'required|string',
            'visibility'=>'required|string',
            'starts_from'=>'required|string',
            'ends_at'=>'required|string',
            'timezone'=>'required|string',
            'tag'=>'required|string',
            'status'=>'required|string',
            'platform_name'=> Rule::requiredIf($request->event_tag =='Online Event'),
            'joining_link'=>Rule::requiredIf($request->event_tag=='Online Event'),
            'joining_credentials'=>Rule::requiredIf($request->event_tag=='Online Event'),
            'joining_instruction'=>Rule::requiredIf($request->event_tag=='Online Event'),
            'venue'=>Rule::requiredIf($request->event_tag=='Physical Event'),
            'pin'=>Rule::requiredIf($request->event_tag=='Physical Event'),
            'description_text'=>'required|string',
            'video'=>'required|string',
            'images' => 'array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tickets' => 'required|array|min:1',
            'tickets.*name' => 'required|string',
            'tickets.*type' => 'required|string',
            'tickets.*quantity' => 'required|integer',
            'tickets.*price' => 'required|integer',
            'tickets.*sale_starts_from' => 'required|string',
            'tickets.*sale_ends_at' => 'required|string',
            'tickets.*description' => 'required|string',
            'tickets.*message_to_attendee' => 'required|string',
            'tickets.*status' => 'required|string',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }
        $data=$validator->validated();
       
        $event=$this->eventRepository->createEvent($data);
     
      
        return new EventResource( $event);


    }

    public function updateEvent(Request $request , $event_id)
    {

        $validator=Validator::make($request->all(),[
            'name'=>'string',
            'display_name'=>'string',
            'visibility'=>'string',
            'starts_from'=>'string',
            'ends_at'=>'string',
            'timezone'=>'string',
            'tag'=>'string',
            'status'=>'string',
            'platform_name'=> Rule::requiredIf($request->event_tag =='Online Event'),
            'joining_link'=>Rule::requiredIf($request->event_tag=='Online Event'),
            'joining_credentials'=>Rule::requiredIf($request->event_tag=='Online Event'),
            'joining_instruction'=>Rule::requiredIf($request->event_tag=='Online Event'),
            'venue'=>Rule::requiredIf($request->event_tag=='Physical Event'),
            'pin'=>Rule::requiredIf($request->event_tag=='Physical Event'),
            'description_text'=>'string',
            'video'=>'string',
            'images' => 'array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tickets' => 'array|min:1',
            'tickets.*name' => 'string',
            'tickets.*type' => 'string',
            'tickets.*quantity' => 'numeric',
            'tickets.*price' => 'numeric',
            'tickets.*sale_starts_from' => 'string',
            'tickets.*sale_ends_at' => 'string',
            'tickets.*description' => 'string',
            'tickets.*message_to_attendee' => 'string',
            'tickets.*status' => 'string',
        ]);

        if($validator->fails())
        {
            return $validator->errors();
        }

        $event=$this->eventRepository->updateEvent($validator->validated(),$event_id);


        return new EventResource($event);


    }


    public function deleteEvent($event_id)
    {
          $event=$this->eventRepository->deleteEvent($event_id);
          
          return new EventResource($event); 


    }

    public function getEventById($event_id)
    {
        $event=$this->eventRepository->getEventById($event_id);

        return new EventResource($event);

    }
    public function fetchAllEvents()
    {

        $events=$this->eventRepository->fetchAllEvents();
        return EventResource::collection($events);
    }


    //ticket functions below



}
