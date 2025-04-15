<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PVReceptionController extends Controller
{
    /**
     * Afficher tous les PVs.
     */
    public function index()
    {
        $pvs = DB::table('pv_reception')->orderByDesc('date_reception')->get();
        return view('enginieur.pv.pv_reception', compact('pvs'));
    }

    /**
     * Ajouter un PV.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ingenieur' => 'required|string',
            'date_reception' => 'required|date',
            'description_machine' => 'required|string',
            'etat_machine' => 'required|string',
            'remarques' => 'nullable|string',
        ]);

        DB::table('pv_reception')->insert($request->only([
            'ingenieur', 'date_reception', 'description_machine', 'etat_machine', 'remarques'
        ]));

        return redirect()->route('enginieur.pv')->with('success', 'PV ajouté avec succès.');
    }

    /**
     * Voir un PV spécifique.
     */
    public function show($id)
    {
        $pv = DB::table('pv_reception')->where('id', $id)->first();

        if (!$pv) {
            return redirect()->route('enginieur.pv')->with('error', 'PV introuvable.');
        }

        return view('enginieur.pv.voir_pv', compact('pv'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit($id)
    {
        $pv = DB::table('pv_reception')->where('id', $id)->first();

        if (!$pv) {
            return redirect()->route('enginieur.pv')->with('error', 'PV introuvable.');
        }

        return view('enginieur.pv.modifier_pv', compact('pv'));
    }

    /**
     * Enregistrer les modifications.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ingenieur' => 'required|string',
            'date_reception' => 'required|date',
            'description_machine' => 'required|string',
            'etat_machine' => 'required|string',
            'remarques' => 'nullable|string',
        ]);

        DB::table('pv_reception')->where('id', $id)->update([
            'ingenieur' => $request->ingenieur,
            'date_reception' => $request->date_reception,
            'description_machine' => $request->description_machine,
            'etat_machine' => $request->etat_machine,
            'remarques' => $request->remarques,
        ]);

        return redirect()->route('enginieur.pv')->with('success', 'PV mis à jour avec succès.');
    }

    /**
     * Supprimer un PV.
     */
    public function destroy($id)
    {
        DB::table('pv_reception')->where('id', $id)->delete();
        return redirect()->route('enginieur.pv')->with('success', 'PV supprimé avec succès.');
    }
}
