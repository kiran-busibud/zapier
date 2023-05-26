<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use Illuminate\Http\Request;
use App\Keys\TicketKeys;
use App\Repositories\UserRepository;
use App\Services\TicketService;
use Meilisearch\Client;
use Meilisearch\Meilisearch;

class TicketIndexService
{
    private $ticketRepository;

    private $userRepository;
    private $ticketService;
    private $meilisearchClient;

    public function __construct()
    {
        $this->ticketRepository = new TicketRepository();
        $this->userRepository = new UserRepository();
        // $this->ticketService = new TicketService();

    }

    public function getTicketData()
    {
        $tickets = $this->ticketService->getTicketDatatForIndexing();

        // $customers = $this->
    }

    public function getTicketsArray($tickets)
    {
        $ticketsArray = [];
        foreach($tickets as $key=>$value)
        {
            $ticketsArray[] = $value;
        }

        return $ticketsArray;
    }

    public function indexTickets()
    {
        $tickets = $this->ticketRepository->getAllTickets();

        $tickets = $this->getTicketsArray($tickets);

        $host = env('MEILISEARCH_HOST');
        $key = env('MEILISEARCH_KEY');
        
        $this->meilisearchClient = new Client($host,$key);

        $this->meilisearchClient->index('test_index4')->updateDocuments($tickets);
    }
}