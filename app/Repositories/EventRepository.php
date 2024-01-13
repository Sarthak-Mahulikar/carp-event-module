<?php


namespace App\Repositories;
Use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Ticket;
use Ortigan\Cashfree\Cashfree;

class EventRepository implements EventRepositoryInterface{


    public function createEvent($data){
        $the_event_data=[
            'name'=> $data['name'],
            'display_name'=>$data['display_name'],
            'visibility'=>$data['visibility'],
            'starts_from'=>$data['starts_from'],
            'ends_at'=>$data['ends_at'],
            'timezone'=>$data['timezone'],
            'tag'=>$data['tag'],
            'status'=>$data['status'],
            'description_text'=>$data['description_text'],
            'video'=>$data['video'],
        ];

        if($data['tag']=='Physical Event')
        {
            $the_event_data['venue']=$data['venue'];
            $the_event_data['pin']=$data['pin'];
        }
        else if($data['tag']=='Online Event')
        {
            $the_event_data['platform_name']= $data['platform_name'];
            $the_event_data['joining_link']= $data['joining_link'];
            $the_event_data['joining_credentials']= $data['joining_credentials'];
            $the_event_data['joining_instruction']= $data['joining_instruction'];

        }



        $event=Event::create($the_event_data);
        $tickets = $this->createTickets($data, $event->_id);
      
        return $event;
    }
    
    public function updateEvent($new_event_details,$event_id){
        $event=Event::where('_id',$event_id)->first();
        $event->update($new_event_details);
     
        $tickets=$this->updateTicket($new_event_details,$event);
        return $event;
    }

    public function deleteEvent($event_id){
        
        $event=Event::find($event_id)->first();
        $event->tickets()->delete();
        $event->delete();
        return $event;

    }

    public function getEventById($event_id){
        $event=Event::find($event_id);
        return $event; 
    }

    public function fetchAllEvents()
    {
        $events =Event::all();
        return $events;
    }


    //ticket Methods

    public function createTickets($tickets_data, $event_id){
       
            for($i=0;$i<sizeof($tickets_data['tickets']);$i++){
                
                $ticket=Ticket::create([
                'name' => $tickets_data['tickets'][$i]['name'],
                'type' => $tickets_data['tickets'][$i]['type'],
                'quantity' => $tickets_data['tickets'][$i]['quantity'],
                'price' => $tickets_data['tickets'][$i]['price'],
                'sale_starts_from' => $tickets_data['tickets'][$i]['sale_starts_from'],
                'sale_ends_at' => $tickets_data['tickets'][$i]['sale_ends_at'],
                'description' => $tickets_data['tickets'][$i]['description'],
                'message_to_attendee' => $tickets_data['tickets'][$i]['message_to_attendee'],
                'status' => $tickets_data['tickets'][$i]['status'],
                'event_id'=>$event_id,
                ]);
            }

        
    }


 
    public function updateTicket($event_details,$event)
    {
        $event->tickets()->delete();
      
        
        $new_updated_tickets=$this->createTickets($event_details,$event->id);
        // return $new_updated_tickets;

    }



    //Event Registration methods
    public function createEventRegistration($registration_details){
        $registration=Registration::create($registration_details);

        $ticket=Ticket::find($registration_details['ticket_id']);
        if($ticket->type == 'paid')
        {
            $registration->payment_status='pending';
            $registration->save();
            $registration_payment=Cashfree::paymentGateway()->createOrder(
                [
                    'order_id'=> $registration->id,
                    'order_amount'=>$ticket->price,
                    'order_currency'=>'INR',
                    'customer_details'=>[
                            'customer_id'=>'35354354354384',
                            'customer_name'=>$registration_details['participant_name'],
                            'customer_email'=>$registration_details['participant_email'],
                            'customer_phone'=>str($registration_details['participant_phone']),
    
                    ]
                ]);
                return $registration_payment;
    
        }
        $ticket->quantity=$ticket->quantity-1;
        $ticket->save();
        return $registration;

    }

    public function publicFetchAllEvents(){

        $events=Event::with('tickets')->get();
        return $events;
    }

    public function publicGetEventById($event_id){

        $event=Event::with('tickets')->where($event_id)->first();
        return $event;
    }

    public function registrationPaymentConfirmation($registration_id,$ticket_id){

        $get_order_details_from_cashfree=Cashfree::paymentGateway()->getOrder($registration_id);
        // dd($get_order_details_from_cashfree);
        $registration=Registration::where('_id',$get_order_details_from_cashfree->order_id)->first();
        // dd($registration);
        if($get_order_details_from_cashfree->order_status == "PAID" )
        {
            // dd($get_order_details_from_cashfree);
           if($registration->payment_status === 'pending')
           {
            // dd($registration);
            $registration->payment_status='paid';
            // dd($ticket_id);
            $registration->save();
            $ticket=Ticket::find($ticket_id);
            $ticket->quantity=$ticket->quantity-1;
            $ticket->save();
            // $registration->update([
            //     'payment_status'=>'paid',
            // ]);
            // $registration->save();

           }
        }
        return $registration;

    }
}

