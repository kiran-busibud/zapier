<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\TicketCreated;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'hl_ticket';

    protected $dispatchesEvents = [
        'created' => TicketCreated::class,
    ];
}
