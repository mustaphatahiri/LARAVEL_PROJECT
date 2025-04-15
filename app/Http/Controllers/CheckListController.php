<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckListController extends Controller
{
    /**
     * Afficher la liste des vérifications.
     */
    public function index()
    {
        $items = DB::table('check_list')->orderByDesc('date_verification')->get();
        return view('enginieur.check.index', compact('items'));
    }

    /**
     * Enregistrer une nouvelle vérification.
     */
    public function store(Request $request)
    {
        $request->validate([
            'verificateur' => 'required|string|max:255',
            'date_verification' => 'required|date',
            'elements_verifies' => 'required|string',
            'statut_verification' => 'required|string',
            'remarques' => 'nullable|string',
        ]);

        DB::table('check_list')->insert([
            'verificateur' => $request->verificateur,
            'date_verification' => $request->date_verification,
            'elements_verifies' => $request->elements_verifies,
            'statut_verification' => $request->statut_verification,
            'remarques' => $request->remarques,
        ]);

        return redirect()->back()->with('success', 'Vérification ajoutée avec succès.');
    }

    /**
     * Afficher les détails d'une vérification.
     */
    public function show($id)
    {
        $check = DB::table('check_list')->find($id);
    
        if (!$check) {
            return redirect()->route('enginieur.check.index')->with('error', 'Vérification introuvable.');
        }
    
        return view('enginieur.check.show', compact('check'));
    }
    

    /**
     * Formulaire de modification.
     */
    public function edit($id)
    {
        $check = DB::table('check_list')->find($id);
    
        if (!$check) {
            return redirect()->route('enginieur.check.index')->with('error', 'Vérification introuvable.');
        }
    
        return view('enginieur.check.edit', compact('check'));
    }
    

    /**
     * Mettre à jour la vérification.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'verificateur' => 'required|string|max:255',
            'date_verification' => 'required|date',
            'elements_verifies' => 'required|string',
            'statut_verification' => 'required|string',
            'remarques' => 'nullable|string',
        ]);

        DB::table('check_list')->where('id', $id)->update([
            'verificateur' => $request->verificateur,
            'date_verification' => $request->date_verification,
            'elements_verifies' => $request->elements_verifies,
            'statut_verification' => $request->statut_verification,
            'remarques' => $request->remarques,
        ]);

        return redirect()->route('enginieur.check.index')->with('success', 'Vérification mise à jour avec succès.');
    }

    /**
     * Supprimer une vérification.
     */
    public function destroy($id)
    {
        DB::table('check_list')->where('id', $id)->delete();
        return redirect()->route('enginieur.check.index')->with('success', 'Vérification supprimée avec succès.');
    }
}
