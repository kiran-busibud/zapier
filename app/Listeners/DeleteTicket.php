<?php

namespace App\Listeners;

use App\Events\TicketDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Meilisearch\Client;
use App\Services\TicketIndexService;

class DeleteTicket
{
    /**
     * Create the event listener.
     */
    private $meilisearchClient;
    private $ticketIndexService;
    public function __construct()
    {
        $this->meilisearchClient = new Client(env('MEILISEARCH_HOST'),env('MEILISEARCH_KEY'));
        $this->ticketIndexService = new TicketIndexService();
    }

    /**
     * Handle the event.
     */
    public function handle(TicketDeleted $event): void
    {
        $this->meilisearchClient->index('test_index3')->deleteDocument($event->ticket->id);
    }
}
