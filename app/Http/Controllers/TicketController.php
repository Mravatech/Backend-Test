<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\TicketType;
use Validator;

class TicketController extends Controller
{
    //

    public function index()
    {
    	$ticket = Ticket::all();
    	return response()->json(['success' => $ticket], 200);
    }

    public function add(Request $request)
    {	
    	$validator = Validator::make($request->all(), [ 
            'name' 			=> 'required', 
            'email' 		=> 'required|email', 
            'content' 		=> 'required', 
            'phone' 		=> 'required', 
            'ticket_type' 	=> 'required',
        ]);

		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
    	$ticket 				= new Ticket;
    	$ticket->name 			= $request->name;
    	$ticket->email	 		= $request->email;
    	$ticket->content 		= $request->content;
    	$ticket->phone_number 	= $request->phone;
    	$ticket->ticket_type 	= $request->ticket_type;

        if($ticket->save()){
        	return response()->json(['success' => $ticket], 200);
        }else{
        	return response()->json(['error' => 'error while updating','status' => 302]); 
        }

    }

    public function update(Request $request)
    {	$validator = Validator::make($request->all(), [ 
            'name' 			=> 'required', 
            'email' 		=> 'required|email', 
            'content' 		=> 'required', 
            'phone' 		=> 'required', 
            'ticket_type' 	=> 'required',
        ]);

		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
    	$ticket 				= Ticket::find($request->id);
    	$ticket->name 			= $request->name;
    	$ticket->email	 		= $request->email;
    	$ticket->content 		= $request->content;
    	$ticket->phone_number 	= $request->phone;
    	$ticket->ticket_type 	= $request->ticket_type;
        if($ticket->save()){
        	return response()->json(['success' => $ticket], 200); 
        }else{
        	return response()->json(['error' => 'error while updating'], 200); 
        }

    }

    public function delete(Request $request)
    {	
    	$validator = Validator::make($request->all(), [ 
            'id' 			=> 'required', 
        ]);

		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }


    	$ticket 				= Ticket::find($request->id);
    	if($ticket){
    		$ticket->delete();
    		return response()->json(['success' => $ticket], 200); 
    	}else{
    		return response()->json(['error' => 'Error while deleting'], 302); 
    	}
        

    }

    public function addTicketType(Request $request)
    {
    	$validator = Validator::make($request->all(), [ 
            'name' 			=> 'required', 
        ]);

		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
		$ticketType 	   = new TicketType;
        $ticketType->name  = $request->name;

        if($ticketType->save()){

        	return response()->json(['success' => $ticketType], 200);

        }else{

        	return response()->json(['error' => 'error while adding','status' => 302]); 
        }
    }

    public function updateTicketType(Request $request)
    {
    	$validator = Validator::make($request->all(), [ 
            'id' 			=> 'required', 
            'name' 			=> 'required', 
        ]);

		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        if(TicketType::find($request->id)){
        	$ticketType    		= TicketType::find($request->id);
        	$ticketType->name  	= $request->name;

	        if($ticketType->save()){
	        	return response()->json(['success' => $ticketType], 200);
	        }else{
	        	return response()->json(['error' => 'error while updating','status' => 302]); 
	        }
	    }else{
	    	return response()->json(['error' => 'Data does not exist','status' => 302]);
	    }
    }
}
