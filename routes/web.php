<?php

use App\Jobs\ProcessRenovationPdf;
use App\Mail\NotificationsMembership\ExpirationMembershipClient;
use App\Mail\NotificationsMembership\RememberMembershipClient;
use Carbon\Carbon;

Route::get('validation',function(){
    $today = Carbon::now()->addDays(26);
    $client = App\Client::first();
    $date = $client->expiration_date;
    $exitsMembership = $today->diffInDays(Carbon::parse($date));
    if ($exitsMembership == 5) {
        Mail::to($client->email)->send(new RememberMembershipClient($client));
        return "Mensaje recordatorio enviado de con exito";
    } else if ($exitsMembership == 0)
    {
        Mail::to($client->email)->send(new ExpirationMembershipClient($client));
        return "Mensaje de expiracion enviado con exito";
    }
});

Route::get('/list-pdf',function(){
    dispatch(new ProcessRenovationPdf);
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/pdf',function(){
    //gjinneth57@gmail.com
    $client = \App\Client::find(18);
    $pdf = PDF::loadView('reports.membership.invoice',compact('client'))->setPaper('a4', 'landscape')->output();

    Storage::disk('public')->put("archivo-{$client->name}.pdf",$pdf);

    return 'PDF Guardado correctamente';
    // return $pdf->stream();
});

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/','login');

Route::get('clients/renovation','ClientController@renovationMembership')
    ->name('clients.renovation.membership');

Route::get('clients/renovation/contact','ClientController@renovationMembershipContact')
    ->name('clients.renovation.membership.contact');

Route::post('clients/renovation/contact','ClientController@renovationMembershipContactStore')
    ->name('clients.renovation.membership.contact.store');

Auth::routes(['register' => false]);
Route::resource('clients', 'ClientController');
Route::get('download-excel','ClientController@download')->name('clients.download');
