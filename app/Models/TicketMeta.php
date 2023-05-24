<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMeta extends Model
{
    use HasFactory;

    protected $table = 'hl_ticket_meta';


    public function searchableAs(): string
    {
        return 'ticket_meta';
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();
 
        return $array;
    }
}
