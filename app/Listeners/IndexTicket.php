<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Meilisearch\Client;
use App\Models\Ticket;

class IndexTicket implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {   
       
    }

    /**
     * Handle the event.
     */
    public function handle(TicketCreated $event): void
    {
        $client = new Client(env('MEILISEARCH_HOST'), env('MEILISEARCH_KEY'));

        $client->index('test_index7')->updateDocuments([$event->ticket->toArray()]);
    }
}
