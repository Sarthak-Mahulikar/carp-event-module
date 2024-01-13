<?php
 
namespace App\Interfaces;

interface EventRepositoryInterface{

    //Event Methods
    public function createEvent($event_details);

    public function updateEvent($new_event_details,$event_id);

    public function deleteEvent($event_id);

    public function getEventById($event_id);

    public function fetchAllEvents();

    //ticket methods
    public function createTickets($event,$event_id);

    public function updateTicket($event_details,$event);
    //event Registrtaion methods
    
    public function createEventRegistration($registration_details);

    public function publicFetchAllEvents();

    public function publicGetEventById($event_id);

    public function registrationPaymentConfirmation($registration_id,$ticket_id);

 
    // public function updateTicket($ticket_details,$event_id);


}
