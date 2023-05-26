<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TicketIndexService;

class IndexRandomTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:index-random-tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $ticketIndexService;

    public function __construct(TicketIndexService $ticketIndexService)
    {
        parent::__construct();
        $this->ticketIndexService = $ticketIndexService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->ticketIndexService->indexRandomTickets(100000);
    }
}
