<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Keys\TicketKeys;

class TicketService
{

    private $ticketKeys;

    public function __construct(TicketKeys $ticketKeys)
    {
        $this->ticketKeys = $ticketKeys;
    }
    public function getRequestBody(Request $request)
    {
        $ticket_keys = $this->ticketKeys->getKeys();

        $request_data = $request->all();

        $body = [];

        foreach($ticket_keys as $key)
        {
            if(isset($request_data[$key]))
            {
                $body[$key] = $request_data[$key];
            }
        }
        
        return $body;
    }

    public function brandExists($brand)
    {
        return true;
    }

    public function validateTicketData($ticketData)
    {
        if(isset($ticketData['to']))
        {
            foreach($ticketData['to'] as $brand)
            {
                if(!$this->brandExists($brand))
                {
                    return false;
                }
            }
        }

        return true;
    }

    public function postTicket(Request $request)
    {
        $body = $this->getRequestBody($request);

        if($this->validateTicketData($body))
        {
            return response()->json([['ticket_id'=>0]],200);
        }
        else{
            return response()->json(400);
        }
    }
}