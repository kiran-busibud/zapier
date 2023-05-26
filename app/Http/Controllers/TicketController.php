<?php

namespace App\Http\Controllers;

use App\Repositories\TicketRepository;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    private $ticketService;
    private $ticketRepository;

    public function __construct(TicketService $ticketService, TicketRepository $ticketRepository)
    {
        $this->ticketService = $ticketService;
        $this->ticketRepository = $ticketRepository;
    }

    public function postTicket(Request $request)
    {
        return $this->ticketService->postTicket($request);
    }

    public function getAllTickets(Request $request)
    {
        $tickets = $this->ticketRepository->getAllTickets();
        dd($tickets);
    }
}

//to,from, description,cc,bcc
