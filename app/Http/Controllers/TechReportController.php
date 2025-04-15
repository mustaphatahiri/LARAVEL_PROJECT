<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechReportController extends Controller
{
    public function write($id)
    {
        $demande = DB::table('demande_interv')->where('id', $id)->first();

        if (!$demande) {
            return redirect()->route('tech.demandes')->with('error', 'Demande introuvable.');
        }

        return view('tech.reports.write', compact('demande'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'article' => 'required|string',
            'intervenant' => 'required|string',
            'maintenance' => 'required|string',
            'date_intervention' => 'required|date',
            'lieu' => 'required|string',
            'intervention_description' => 'required|string',
            'intervention_result' => 'required|string',
            'remarks' => 'required|string',
        ]);

        DB::table('intervention_reports')->insert([
            'id' => $id,
            'Article' => $request->article,
            'Intervenant' => $request->intervenant,
            'Maintenance' => $request->maintenance,
            'Date d\'intervention' => $request->date_intervention,
            'Lieu' => $request->lieu,
            'intervention_description' => $request->intervention_description,
            'intervention_result' => $request->intervention_result,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('tech.demandes')->with('success', 'Rapport enregistré avec succès.');
    }

    public function view($id)
    {
        $report = DB::table('intervention_reports')->where('id', $id)->first();

        if (!$report) {
            return redirect()->route('tech.demandes')->with('error', 'Rapport introuvable.');
        }

        return view('tech.reports.view', compact('report'));
    }

    public function upload($id)
    {
        return view('tech.reports.upload', compact('id'));
    }

    public function storeUpload(Request $request, $id)
    {
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');

            $path = $file->storeAs('uploads', $id . '_' . time() . '_' . $file->getClientOriginalName(), 'public');

            DB::table('rapport_scanné')->insert([
                'demande_id' => $id,
                'file_path' => $path,
                'uploaded_at' => now()
            ]);

            return redirect()->route('tech.demandes')->with('success', 'Rapport scanné téléchargé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Le fichier n\'est pas valide.');
        }
    }

    public function scanned($id)
    {
        $scannedReport = DB::table('rapport_scanné')->where('demande_id', $id)->first();

        if (!$scannedReport) {
            return redirect()->route('tech.demandes')->with('error', 'Rapport scanné introuvable.');
        }

        return view('tech.reports.scanned', compact('scannedReport', 'id'));
    }

    /**
     * Modifier un rapport.
     */
    public function edit($id)
    {
        $report = DB::table('intervention_reports')->where('id', $id)->first();

        if (!$report) {
            return redirect()->route('tech.interventions')->with('error', 'Rapport introuvable.');
        }

        return view('tech.reports.edit', compact('report'));
    }

    /**
     * Mettre à jour un rapport.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'article' => 'required|string',
            'intervenant' => 'required|string',
            'maintenance' => 'required|string',
            'date_intervention' => 'required|date',
            'lieu' => 'required|string',
            'intervention_description' => 'required|string',
            'intervention_result' => 'required|string',
            'remarks' => 'required|string',
        ]);

        DB::table('intervention_reports')->where('id', $id)->update([
            'Article' => $request->article,
            'Intervenant' => $request->intervenant,
            'Maintenance' => $request->maintenance,
            'Date d\'intervention' => $request->date_intervention,
            'Lieu' => $request->lieu,
            'intervention_description' => $request->intervention_description,
            'intervention_result' => $request->intervention_result,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('tech.interventions')->with('success', 'Rapport mis à jour avec succès.');
    }

    /**
     * Supprimer un rapport.
     */
    public function destroy($id)
    {
        DB::table('intervention_reports')->where('id', $id)->delete();

        return redirect()->route('tech.interventions')->with('success', 'Rapport supprimé.');
    }
}
