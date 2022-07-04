<?php

namespace App\Exports;

use App\Client;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientsExport implements FromView
{
    public function view(): View
    {
        return view('exports.clients.resume', [
            'clients' => Client::with('typemonthlies')->get()
        ]);
    }
}
