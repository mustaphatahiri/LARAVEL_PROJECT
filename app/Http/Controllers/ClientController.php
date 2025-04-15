<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index'); // صفحة الفورم
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'client' => 'required|string',
            'ville' => 'required|string',
            'appareil' => 'required|string',
            'services' => 'required|string',
            'sn' => 'required|string',
            'problem' => 'required|string',
        ]);

        DB::table('demande_interv')->insert([
            'Date' => $request->date,
            'Client/Organisme' => $request->client,
            'Ville' => $request->ville,
            'appareil' => $request->appareil,
            'services' => $request->services, // فقط إذا أضفته
            'serial_number' => $request->sn,
            'problem' => $request->problem
        ]);
        

        return redirect()->back()->with('success', 'Votre demande a été envoyée avec succès.');
    }
}

