<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\TicketController;
use App\Models\Post;
use MeiliSearch\Endpoints\Indexes;
use Illuminate\Database\Eloquent\Builder;
use MeiliSearch\Client;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json(['userId' => '$user->id']);
});

Route::get('/login', [LoginController::class, 'authenticate']);

Route::post('/products', [ProductController::class, 'getProductsByUserId']);


Route::post('/sessiontoken', function (Request $request) {
    $username = $request->all()['username'];
    $user = User::where('name', $username)->first();

    if ($user) {
        return response()->json(['userId' => $user->id]);
    } else {
        response()->json(['error' => 'Unauthorized'], 401);
    }
});

Route::post('/productsFromEmail', [ProductController::class, 'postProductsByUserId']);

Route::get('/login1', [LoginController::class, 'login']);

// Route::post('/ticket', function (Request $request) {
//     $ticket = $request->all();

//     foreach ($ticket as $key => $value) {
//         Log::info($key, [$value]);
//     }

//     return response()->json(['ticket' => 'success'], 200);

// });

Route::get('ticket', function (Request $request) {

    Log::info('request', [$request->all()]);
    $tickets = [];

    $ticket_count = rand(1, 10);
    for ($i = 0; $i < $ticket_count; $i++) {
        $ticket = [
            "id" => rand(1, 100),
            "ticket_name" => "name",
            "ticket_description" => "ticket_description",
            "ticket_title" => "ticket_title",
            "ticket_brand" => "ticket_brand",
            "ticket_date" => "ticket_date"
        ];

        $tickets[] = $ticket;
    }

    return response()->json($tickets, 200);
});

Route::post('/brand', function (Request $request) {
    $brand = $request->all();

    foreach ($brand as $key => $value) {
        Log::info($key, [$value]);
    }

    return response()->json(['brand' => 'success'], 200);

});

Route::post('/message', function (Request $request) {
    $message = $request->all();

    foreach ($message as $key => $value) {
        Log::info($key, [$value]);
    }

    return response()->json(['message' => 'success'], 200);

});

Route::get('/sample_dynamic', function (Request $request) {
    return response()->json(['field1' => 'dynamic_field', 'field2' => 'dynamic_field2'], 200);

});

Route::get('/user', function (Request $request) {
    return response()->json([['id' => 0, 'user_name' => 'msvk', 'email' => 'kiran@gmail.com']], 200);
});

Route::get('/message', function (Request $request) {
    return response()->json([['id' => 0, 'description' => 'hi, this is kiran']], 200);
});

Route::get('/brand', function (Request $request) {
    return response()->json([['id' => 0, 'brand' => 'brand']], 200);
});

Route::post('/ticket', [TicketController::class, 'postTicket']);

Route::get('/meilisearch_test', function (Request $request) {
    $post = Post::search('title1', function (Indexes $meilisearch, $query, $options) {
        $options['filters'] = 'title="title1"';
        return $meilisearch->search($query, $options);
    })->get();

    dd($post);
});


Route::get('/meilisearch_test1', function (Request $request) {
    $results = null;

    // if($query = $request->get('query')){

    //     $results = Post::search($query, function ($meilisearch, $query, $options){
    //         $options['filters'] = 'title = "title1"';

    //         return $meilisearch->search($query, $options);
    //     })

    //         ->get();

    //     dd($results);
    // }

    $query = "title1";

    $results = Post::search($query, function ($meilisearch, $query, $options) {
        // $options['filter'] = [['title = "title1"','title = "test title"'],'description = "test description"'];
        $options['attributesToHighlight'] = ["overview"];
        $options['showMatchesPosition'] = true;
        // $options['limit'] = 1;

        return $meilisearch->search($query, $options);
    })

        // ->query(fn (Builder $query) => $query->with('_matchesPosition'))
        ->get();

    dd($results);
});


Route::get('/meilisearch_test2', function (Request $request) {

    $host = env('MEILISEARCH_HOST', 'http://localhost:7700');
    $key = env('MEILISEARCH_KEY');
    $client = new Client($host, $key);

    $results = $client->index('posts_index')->search('title1', [
        'attributesToHighlight' => ['overview'],
        'showMatchesPosition' => true
    ]);

    dd($results);
});

Route::get('/tickets', [TicketController::class, 'getAllTickets']);