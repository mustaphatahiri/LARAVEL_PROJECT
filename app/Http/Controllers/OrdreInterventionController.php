<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdreInterventionController extends Controller
{
    /**
     * Afficher tous les ordres.
     */
    public function index()
    {
        $items = DB::table('ordre_intervention')->orderByDesc('date_ordre')->get();
        return view('enginieur.ordre_intervention', compact('items'));
    }

    /**
     * Enregistrer un nouvel ordre.
     */
    public function store(Request $request)
    {
        $request->validate([
            'responsable' => 'required',
            'date_ordre' => 'required|date',
            'description_tache' => 'required',
            'technicien' => 'required',
            'priorite' => 'required',
            'date_limite' => 'required|date',
            'remarques' => 'nullable',
        ]);

        DB::table('ordre_intervention')->insert([
            'responsable' => $request->responsable,
            'date_ordre' => $request->date_ordre,
            'description_tache' => $request->description_tache,
            'technicien' => $request->technicien,
            'priorite' => $request->priorite,
            'date_limite' => $request->date_limite,
            'remarques' => $request->remarques,
        ]);

        return redirect()->back()->with('success', 'Ordre ajouté avec succès.');
    }

    /**
     * Afficher les détails d’un ordre.
     */
    public function show($id)
    {
        $ordre = DB::table('ordre_intervention')->find($id);

        if (!$ordre) {
            return redirect()->route('enginieur.ordre.index')->with('error', 'Ordre introuvable.');
        }

        return view('enginieur.ordre.show', compact('ordre'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit($id)
    {
        $ordre = DB::table('ordre_intervention')->find($id);

        if (!$ordre) {
            return redirect()->route('enginieur.ordre.index')->with('error', 'Ordre introuvable.');
        }

        // 👇 nom personnalisé pour éviter conflit مع autre edit.blade.php
        return view('enginieur.ordre.ordre_modifier', compact('ordre'));
    }

    /**
     * Mettre à jour l’ordre.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'responsable' => 'required',
            'date_ordre' => 'required|date',
            'description_tache' => 'required',
            'technicien' => 'required',
            'priorite' => 'required',
            'date_limite' => 'required|date',
            'remarques' => 'nullable',
        ]);

        DB::table('ordre_intervention')->where('id', $id)->update([
            'responsable' => $request->responsable,
            'date_ordre' => $request->date_ordre,
            'description_tache' => $request->description_tache,
            'technicien' => $request->technicien,
            'priorite' => $request->priorite,
            'date_limite' => $request->date_limite,
            'remarques' => $request->remarques,
        ]);

        return redirect()->route('enginieur.ordre.index')->with('success', 'Ordre modifié avec succès.');
    }

    /**
     * Supprimer un ordre.
     */
    public function destroy($id)
    {
        DB::table('ordre_intervention')->where('id', $id)->delete();
        return redirect()->route('enginieur.ordre.index')->with('success', 'Ordre supprimé avec succès.');
    }
}
