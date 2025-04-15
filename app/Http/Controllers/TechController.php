<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechController extends Controller
{
    // لوحة التحكم الرئيسية
    public function dashboard()
    {
        return view('tech.dashboard');
    }

    // عرض طلبات التدخل من جدول demande_interv
    public function demandes()
    {
        $demandes = DB::table('demande_interv')->get();

        return view('tech.demandes', compact('demandes'));
    }

    // عرض تقارير التدخل من جدول (مثل intervention_reports)
    public function interventions()
    {
        $reports = DB::table('intervention_reports')->get();
        return view('tech.interventions', compact('reports'));
    }
    
}
