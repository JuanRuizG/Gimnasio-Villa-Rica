<?php

namespace App\Http\Controllers;

use App\Client;
use App\Events\ClientWasRegister;
use App\Exports\ClientsExport;
use App\Http\Requests\{ClientStoreRequest,ClientUpdateRequest};
use App\Mail\NotificationsMembership\ExpirationMembershipClient;
use App\Mail\NotificationsMembership\MembershipClient;
use App\Mail\NotificationsMembership\RememberMembershipClient;
use App\TypeMonthly;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('typemonthlies')
            ->identification(request('identification'))
            ->keyIdentification(request('key_identification'))
            ->paginate(10);

        return view('clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_monthly = TypeMonthly::pluck('name','id');
        return view('clients.create',compact('type_monthly'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        $client = Client::create($request->validated());
        $client->expiration_date = $this->updateTypeMonthly($client);
        $client->price = $this->updatePrice($client);

        $client->save();
        $pdf = PDF::loadView('reports.membership.invoice',compact('client'));

        event(new ClientWasRegister($client,$pdf));

        notify()->success('Cliente Creado con exito');

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $type_monthly = TypeMonthly::pluck('name','id');
        return view('clients.edit',compact('client','type_monthly'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->update($request->validated());
        $client->expiration_date = $this->updateTypeMonthly($client);
        $client->price = $this->updatePrice($client);
        $client->save();

        notify()->success('Cliente Actualizado con exito');

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        notify()->success('Cliente eliminado con exito');

        return back();
    }

    public function download()
    {
        return Excel::download(new ClientsExport, 'listado-clientes.xlsx');
    }

    private function updateTypeMonthly($client)
    {
        $type = TypeMonthly::find($client->type_monthlies_id);
        $month = $client->initial_date;
        $expiration = $client->expiration_date;
        if ($type->name == 'Mensual')
            $expiration = Carbon::parse($month)->addMonth(1);
        else if ($type->name == 'Quincenal')
            $expiration = Carbon::parse($month)->addWeek(2);
        else if ($type->name == 'Semanal')
            $expiration = Carbon::parse($month)->addWeek(1);
        else if ($type->name == 'Sesion')
            $expiration = Carbon::parse($month)->addDays(1);

        return $expiration;
    }

    private function updatePrice($client)
    {
        $type = TypeMonthly::find($client->type_monthlies_id);
        $value = $client->price;
        if ($type->name == 'Mensual')
            $value = $type->value;
        else if ($type->name == 'Quincenal')
            $value = $type->value;
        else if ($type->name == 'Semanal')
            $value = $type->value;
        else if ($type->name == 'Sesion')
            $value = $type->value;

        return $value;
    }

    public function renovationMembership()
    {
        return view('clients.renovations.form');
    }

    public function renovationMembershipContact(Request $request)
    {
        $clientFound = Client::where('identification',$request->get('identification'))->exists();

        if ($clientFound) {
            $client = Client::where('identification',$request->get('identification'))->first();
            return view('clients.renovations.contact')
                ->with('client',$client);
        } else
            return redirect()->route('clients.create')
                ->with('info','Cliente no existente por favor registrelo');
    }

    public function renovationMembershipContactStore(Request $request)
    {
        $datos = $request->validate([
            'price' => 'required|integer',
            'days' => 'required|integer|min:1'
        ],[
            'price.required' => 'El precio es obligatorio',
            'price.integer' => 'El precio debe ser numerico',
            'days.required' => 'La cantidad de dias es obligatorio',
            'days.integer' => 'La cantidad de dias debe ser numerico',
            'days.min' => 'La cantidad de dias debe ser minimo 1',
        ]);
        $client = Client::where('identification',$request->client_identification)->first();

        $client->price += $datos['price'];
        $client->expiration_date = Carbon::parse($client->expiration_date)->addDays($datos['days']);
        $client->save();

        notify()->success('Actualizacion de renovacion cliente Creado con exito');

        return redirect()->route('clients.index');
    }

    public function rememberMembershipClientNotification($client)
    {
        $today = Carbon::now();
        $date = $client->expiration_date;
        $exitsMembership = $today->diffInDays(Carbon::parse($date));

        if ($exitsMembership == 5) {
            Mail::to($client->email)->send(new RememberMembershipClient($client));
        } else if ($exitsMembership == 0)
        {
            Mail::to($client->email)->send(new ExpirationMembershipClient($client));
        }
    }
}
