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
        $body['query'] = 'fad';
        $body['keys']=['ticket_title','ticket_description','customer_nicename'];
        return $body;
    }

    public function search(Request $request)
    {
     
        $body = $request->all();
        $body = $this->addPayload($body);
        $tickets = $this->meilisearchClient->index('test_index3')->search('sainia', [
            'showMatchesPosition' => true
          ]);

        // dd($tickets);

        $query = $body['query'];
        $keys = $body['keys'];

        
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

          return response()->json(['tickets'=>(array)$tickets],200);
        //   return response()->json(['request'=>$request->all()],200);

    }
}
