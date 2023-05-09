<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;


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

Route::post('/ticket', function (Request $request) {
    $ticket = $request->all();

    foreach ($ticket as $key => $value) {
        Log::info($key, [$value]);
    }

    return response()->json(['ticket' => 'success'], 200);

});

Route::get('ticket', function (Request $request) {

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