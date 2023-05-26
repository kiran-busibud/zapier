<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use Illuminate\Http\Request;
use App\Keys\TicketKeys;
use App\Repositories\UserRepository;
use App\Services\TicketService;
use Meilisearch\Client;
use Meilisearch\Meilisearch;
use Faker\Factory as Faker;

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
        foreach ($tickets as $key => $value) {
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

        $this->meilisearchClient = new Client($host, $key);

        $this->meilisearchClient->index('test_index4')->updateDocuments($tickets);
    }

    public function indexRandomTickets($count = 0)
    {
        $tickets = [];

        $faker = Faker::create();

        for ($i = 1; $i <= $count; $i++) {
            $ticket['id'] = $i;
            $ticket['ticket_title'] = $faker->sentence;
            $ticket['ticket_description'] = $faker->paragraph;
            $ticket['customer_nicename'] = $faker->name;
            $ticket['meta_data'] = $faker->sentence;

            $tickets[] = $ticket;
        }

        $host = env('MEILISEARCH_HOST');
        $key = env('MEILISEARCH_KEY');

        $this->meilisearchClient = new Client($host, $key);

        $this->meilisearchClient->index('test_index6')->updateDocuments($tickets);
    }
}