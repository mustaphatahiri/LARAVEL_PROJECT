@extends('layouts.app')
@include('includes.navbar3')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
        url("{{ asset('image/bg1.png') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding-top: 100px;
        /* Match this to actual navbar height */

        color: #fff;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        min-height: 100vh;
    }

    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(6px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        padding: 10px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000;
        min-height: 70px;
    }

    .navbar img {
        height: 50px;
        object-fit: contain;
    }

    .navbar h2 {
        font-size: 1.6rem;
        color: #197BBF;
        font-weight: bold;
        margin: 0 auto;
        text-align: center;
        flex-grow: 1;
    }

    .navbar form {
        margin: 0;
    }

    .btn-logout {
        background: #e74c3c;
        color: white;
        font-size: 0.95rem;
        padding: 8px 18px;
        border-radius: 25px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .btn-logout:hover {
        background-color: #c0392b;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .container {
        margin-top: 230px;
        width: 100%;
        height: 100%;
        padding: 40px 20px 60px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .report-container {
        width: 100%;
        max-width: 900px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(8px);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        position: relative;
        text-align: center;
        animation: fadeIn 1s ease-in-out;
    }

    .report-container h3 {
        color: #76d00a;
        margin-bottom: 30px;
        font-size: 1.8rem;
        font-weight: 700;
        text-transform: uppercase;
        position: relative;
    }

    .report-container h3::after {
        content: "";
        display: block;
        height: 3px;
        width: 60px;
        background: #e67e22;
        margin: 12px auto 0;
        border-radius: 2px;
    }

    .report-group {
        text-align: left;
        margin-bottom: 20px;
    }

    .report-group label {
        font-weight: 600;
        color: #2c3e50;
        display: block;
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .report-data {
        background: #ecf0f1;
        padding: 14px 18px;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: bold;
        color: #34495e;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .report-data:hover {
        background: #dfe6e9;
    }

    .btn-back {
        display: inline-block;
        margin-top: 30px;
        background: #76d00a;
        color: white;
        font-size: 1.1rem;
        padding: 14px 28px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-back:hover {
        background: #76d00a;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {
        .container {
            margin-top: 150px;
            padding: 20px;
        }

        .report-container {
            padding: 30px 20px;
        }

        .report-container h3 {
            font-size: 1.5rem;
        }

        .btn-back {
            width: 100%;
            font-size: 1rem;
        }
    }
</style>

<div class="container">
    <div class="report-container">
        <h3><i class="fas fa-file-alt"></i> Détails du PV de Réception</h3>

        <div class="report-group">
            <label>Nom de l'Ingénieur :</label>
            <div class="report-data">{{ $pv->ingenieur }}</div>
        </div>

        <div class="report-group">
            <label>Date de Réception :</label>
            <div class="report-data">{{ $pv->date_reception }}</div>
        </div>

        <div class="report-group">
            <label>Description de la Machine :</label>
            <div class="report-data">{{ $pv->description_machine }}</div>
        </div>

        <div class="report-group">
            <label>État de la Machine :</label>
            <div class="report-data">{{ $pv->etat_machine }}</div>
        </div>

        <div class="report-group">
            <label>Remarques :</label>
            <div class="report-data">{{ $pv->remarques }}</div>
        </div>

        <a href="{{ route('enginieur.pv') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
</div>
@endsection