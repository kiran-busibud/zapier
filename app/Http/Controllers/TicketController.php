<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    private $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function postTicket(Request $request)
    {
        return $this->ticketService->postTicket($request);
    }
}

//to,from, description,cc,bcc
