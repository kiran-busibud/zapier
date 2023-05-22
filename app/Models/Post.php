<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    public function searchableAs(): string
    {
        return 'posts_index';
    }

    public function toSearchableArray(): array
    {
        $array = $this->toArray();
 
        return $array;
    }
}
