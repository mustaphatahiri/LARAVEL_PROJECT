@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp

<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        background-color: #000;
        font-family: 'Poppins', sans-serif;
    }

    .full-viewport {
        width: 100vw;
        height: 100vh;
        overflow: hidden;
    }

    .pdf-viewer {
        width: 100%;
        height: 100%;
        border: none;
    }

    .btn-back {
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 9999;
        background-color: #e74c3c;
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: bold;
        text-decoration: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        transition: background 0.3s, transform 0.3s;
    }

    .btn-back:hover {
        background-color: #c0392b;
        transform: scale(1.05);
    }

    .error-message {
        color: white;
        text-align: center;
        padding-top: 50px;
        font-size: 1.5rem;
    }
</style>

<div class="full-viewport">
    @if($scannedReport && Storage::disk('public')->exists($scannedReport->file_path))
        <a href="{{ route('tech.demandes') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
        <iframe class="pdf-viewer" src="{{ asset('storage/' . $scannedReport->file_path) }}"></iframe>
    @else
        <div class="error-message">
            Le fichier n'est pas disponible ou n'a pas été téléchargé.
            <br><br>
            <a href="{{ route('tech.demandes') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    @endif
</div>
@endsection
