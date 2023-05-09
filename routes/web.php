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

Route::get('/login',[LoginController::class,'authenticate']);

Route::post('/products',[ProductController::class,'getProductsByUserId']);


Route::post('/sessiontoken',function(Request $request){
    $username = $request->all()['username'];
    $user = User::where('name', $username)->first();

    if($user)
    {
        return response()->json(['userId' => $user->id]);
    }
    else{
        response()->json(['error' => 'Unauthorized'], 401);
    }
});

Route::post('/productsFromEmail',[ProductController::class, 'postProductsByUserId']);

Route::post('/login1',[LoginController::class,'login']);

Route::post('/ticket',function(Request $request){
    $tickets = $request->all();

    foreach($tickets as $ticket)
    {
        Log::info('ticket',[$ticket]);
    }

    return response()->json(['ticket' => 'success'], 200);

});