<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    private $notes = [
        "Mohamed Alaoui" => "16",
        "Ahmed Bennani" => "14",
        "Rachida kich" => "6",
        "Aicha Saaoudi" => "19",
        "Noura Alaoui" => "7",
        "Samar Rhaoussi" => "13",
        "Aicha Siraj" => "10",
        "Samiha Hakim" => "09",
        "Mohamed Rami" => "17",
        "Sami Tazi" => "7",
        "Noura Tazi" => "14"
    ];

    public function index()
    {
        $notes = $this->notes;
        arsort($notes);
        return view('notes.index', compact('notes'));
    }

    public function statistiques()
    {
        $notes = $this->notes;
        arsort($notes);
        return view('notes.index', ['notes' => $notes, 'colorier' => true]);
    }

    public function show(Request $request)
    {
        $search = $request->input('txtRech');
        $result = array_filter($this->notes, function($key) use ($search) {
            return stripos($key, $search) !== false;
        }, ARRAY_FILTER_USE_KEY);

        return view('notes.index', ['notes' => $result]);
    }


    public function decorate()
    {
        $notes = $this->notes;
        arsort($notes); 
        return view('notes.index', ['notes' => $notes, 'decorate' => true]); 
    }

}