<?php 

namespace App\Keys;

class TicketKeys
{
    private $keys;

    public function __construct()
    {
        $this->keys = [
            "from",
            "to",
            "description",
            "cc",
            "bcc",
        ];
    }

    public function getKeys()
    {
        return $this->keys;
    }
}