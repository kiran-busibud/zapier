<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Meilisearch\Client;

class TicketSearchController extends Controller
{
    private $meilisearchClient;

    public function __construct()
    {
        $this->meilisearchClient = new Client(env('MEILISEARCH_HOST'),env('MEILISEARCH_KEY'));
    }

    public function addPayload($body)
    {
        $body['query'] = 'kira';
        $body['keys']=['ticket_title','ticket_description','customer_nicename'];
        return $body;
    }

    public function search(Request $request)
    {
     
        $body = $request->all();
        $body = $this->addPayload($body);

        $query = $body['query'];
        $keys = $body['keys'];

        $tickets = $this->meilisearchClient->index('test_index6')->search($query, [
            'showMatchesPosition' => true,
            'limit' => 30
          ]);

        // dd($tickets);

       

        
        if(!in_array('*', $keys)){
            $ticketsWithKeys = [];
            foreach($tickets as $ticket){
                $keyFound = false;
                foreach($keys as $key){
                    if(array_key_exists($key,$ticket['_matchesPosition'])){
                        $keyFound = true;
                    }
                }
                if($keyFound){
                    $ticketsWithKeys[] = $ticket;
                }
            }
            $tickets = $ticketsWithKeys;
        }

          return response()->json(['count'=>count($tickets),'tickets'=>(array)$tickets],200);
        //   return response()->json(['request'=>$request->all()],200);

    }
}
