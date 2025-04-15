@extends('layouts.app')
@include('includes.navbar3')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
   html, body {
    height: 100%;
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                      url("{{ asset('image/bg1.png') }}");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: #fff;
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
}

.container {
    max-width: 900px;
    padding: 40px 20px;
    margin: 0 auto 60px;
    padding-top: 166px;
    animation: fadeIn 1s ease-in-out;
}

.report-container {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(8px);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    position: relative;
}

.report-container h3 {
    color: #15cda4;
    margin-bottom: 30px;
    font-weight: 700;
    text-align: center;
    text-transform: uppercase;
    font-size: 1.8rem;
    position: relative;
}

.report-container h3::after {
    content: "";
    display: block;
    height: 3px;
    width: 60px;
    background: #15cda4;
    margin: 12px auto 0;
    border-radius: 2px;
}

.report-group {
    text-align: left;
    margin-bottom: 20px;
}

.report-group label {
    font-weight: 600;
    color: #34495e;
    display: block;
    margin-bottom: 5px;
    font-size: 1rem;
}

.report-data {
    background: #ecf0f1;
    padding: 14px 18px;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: bold;
    color: #2c3e50;
    box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
}

.btn-back-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.btn-back {
    background: #15cda4;
    color: white;
    font-size: 1.1rem;
    padding: 14px 28px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
}


.btn-back:hover {
    background: #15cda4;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(6px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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

@media (max-width: 768px) {
    .report-container {
        padding: 30px 20px;
    }

    .report-container h3 {
        font-size: 1.5rem;
    }

    .btn-back {
        width: 100%;
        text-align: center;
    }

    .navbar h2 {
        font-size: 1.3rem;
    }
}


    
</style>

<div class="container">
    <div class="report-container">
        <h3><i class="fas fa-clipboard-check"></i> Détails de la Vérification</h3>

        <div class="report-group">
            <label>Vérificateur :</label>
            <div class="report-data">{{ $check->verificateur }}</div>
        </div>

        <div class="report-group">
            <label>Date de Vérification :</label>
            <div class="report-data">{{ $check->date_verification }}</div>
        </div>

        <div class="report-group">
            <label>Éléments Vérifiés :</label>
            <div class="report-data">{!! nl2br(e($check->elements_verifies)) !!}</div>
        </div>

        <div class="report-group">
            <label>Statut de Vérification :</label>
            <div class="report-data">{{ $check->statut_verification }}</div>
        </div>

        <div class="report-group">
            <label>Remarques :</label>
            <div class="report-data">{{ $check->remarques }}</div>
        </div>

        <div class="btn-back-wrapper">
    <a href="{{ route('enginieur.check.index') }}" class="btn-back">
        <i class="fas fa-arrow-left me-2"></i> Retour
    </a>
</div>

    </div>
</div>
@endsection
