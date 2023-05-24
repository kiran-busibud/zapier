<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'hl_ticket';

    public function searchableAs(): string
    {
        return 'tickets';
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();
 
        return $array;
    }
}
