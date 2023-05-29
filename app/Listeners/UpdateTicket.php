<?php

namespace App\Listeners;

use App\Events\TicketUpdated;
use App\Services\TicketIndexService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;
use Meilisearch\Client;

class UpdateTicket implements ShouldQueue
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
    public function handle(TicketUpdated $event): void
    {
        Log::info('hi',[$event->ticket->id]);
        $this->meilisearchClient->index('test_index3')->deleteDocument($event->ticket->id);

        $this->ticketIndexService->indexTickets([$event->ticket->id]);
    }
}
