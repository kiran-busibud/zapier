<?php

namespace App\Models;

use App\Events\TicketUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\TicketCreated;

class Ticket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'hl_ticket';

    protected $dispatchesEvents = [
        'created' => TicketCreated::class,
        'saved' => TicketUpdated::class,
    ];

}
