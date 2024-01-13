<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Http\Resources\RegistrationResource;
use App\Interfaces\EventRepositoryInterface;
use App\Models\Registration;
use App\Models\Ticket;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ortigan\Cashfree\Cashfree;

class RegistrationController extends Controller
{

    private EventRepositoryInterface $eventRepository;
    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository=$eventRepository;
    }

    public function eventRegister(Request $request,$event_id)
    {
        $validator=Validator::make($request->all(),
            [
                'participant_name' => 'required|string',
                'participant_email' => 'required|string|email|unique:registrations,email',
                'participant_phone' => 'required|numeric|digits:10',
                'title' => 'required|string',
                'gender' => 'required|string',
                'designation' => 'required|string',
                'organization' => 'required|string',
                'emergency_contact' => 'required|numeric|digits:10',
                'emergency_contact_name' => 'required|string',
                'emergency_contact_relation' => 'required|string',
                'blood_group' => 'required|string',
                'where_did_you_hear_about_us' => 'required|string',
                'note_to_organiser' => 'required|string',
                'ticket_id'=>'required|string',

        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $data=$validator->validated();
        $data['event_id']=$event_id;
      
        $registration=$this->eventRepository->createEventRegistration($data);
        $ticket=Ticket::find($data['ticket_id']);
        if($ticket->type === 'free')
       {
        return new RegistrationResource($registration);
       }
       else
       {
        return $registration;
       }

    }

    public function getEventByIdForEventRegistration($event_id)
    {
        $event=$this->eventRepository->publicGetEventById($event_id);
        return new EventResource($event);

    }

   

    public function fetchAllEventPublic()
    {
        $events=$this->eventRepository->publicFetchAllEvents();
        return EventResource::collection($events);
    }

    public function registrationPaymentConfirmation($event_id,$registration_id, Request $request)
    {
        
       $ticket_id=$request->ticket_id;
       $registration=$this->eventRepository->registrationPaymentConfirmation($registration_id,$ticket_id);
       return new RegistrationResource($registration);

    }
}
