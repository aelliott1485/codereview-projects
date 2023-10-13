<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/merger', function() {
    $controller = new \App\Http\Controllers\OrgController();;
    return view('merger.list', $controller->merger());
});
Route::get('/merger2', function() {
    $controller = new \App\Http\Controllers\OrgController();;
    /*$CompaniesSameAddress = DB::table('orgs_main')
        ->select('name', 'code')
        ->whereIn('address', ['ISLEVDALVEJ 110'])
        ->where('code', 'LIKE', '64%')
        ->get();
    return $CompaniesSameAddress;*/
    return view('merger.list', $controller->mergerWithRelations());
});
