<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'hl_customers';

    public function searchableAs(): string
    {
        return 'customers';
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();
 
        return $array;
    }
}
