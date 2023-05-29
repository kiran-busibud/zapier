<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Meilisearch\Client;
use Illuminate\Support\Facades\Log;

class IndexPost implements ShouldQueue
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
    public function handle(PostCreated $event): void
    {
        Log::info('log',[$event->post]);

        $client = new Client(env('MEILISEARCH_HOST'), env('MEILISEARCH_KEY'));

        $client->index('test_index7')->updateDocuments([(array)$event->post]);
    }
}
