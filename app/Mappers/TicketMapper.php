<?php

namespace App\Mappers;

class TicketMapper
{
    public function mapTicketsWithMetaData($tickets,$ticketsMetaData)
    {

        $ticketsWithMeta = [];
        foreach($tickets as $ticket)
        {
            $ticketsWithMeta[$ticket->id]['id']=$ticket->id;
            $ticketsWithMeta[$ticket->id]['ticket_title']=$ticket->ticket_title;
            $ticketsWithMeta[$ticket->id]['ticket_description']=$ticket->ticket_description;
            $ticketsWithMeta[$ticket->id]['customer_nicename']=$ticket->customer_nicename;
            $ticketsWithMeta[$ticket->id]['meta_data']=" ";

        }

        foreach($ticketsMetaData as $metaData)
        {
            $ticketsWithMeta[$metaData->ticket_id]['meta_data'] .= $metaData->meta_value . " ";
        }

        return $ticketsWithMeta;
    }
}