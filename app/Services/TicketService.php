<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use Illuminate\Http\Request;
use App\Keys\TicketKeys;

class TicketService
{

    private $ticketKeys;
    private $ticketRepository;

    public function __construct()
    {
        $this->ticketKeys = new TicketKeys();
        $this->ticketRepository = new TicketRepository();
        
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

    public function getIds($tickets)
    {
        $ticketIds = [];
        foreach($tickets as $ticket){
            $ticketIds[] = $ticket->id;
        }
        return $ticketIds;
    }

    public function getTicketDatatForIndexing()
    {
        $tickets = $this->ticketRepository->getAllTickets();

        $ids = $this->getIds($tickets);
    }
}