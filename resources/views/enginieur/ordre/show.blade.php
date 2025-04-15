@extends('layouts.app')
@include('includes.navbar3')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
   html,
body {
    background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                      url("{{ asset('image/bg1.png') }}");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    color: #ffffff;
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    min-height: 100vh;
}

.container {
    max-width: 1000px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}

.report-container {
    width: 100%;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(8px);
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    text-align: center;
    animation: fadeIn 1s ease-in-out;
}

.report-container h3 {
    color: #197BBF;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 1.8rem;
    margin-bottom: 40px;
    letter-spacing: 1px;
    position: relative;
}

.report-container h3::after {
    content: "";
    display: block;
    height: 4px;
    width: 60px;
    background: #197BBF;
    margin: 12px auto 0;
    border-radius: 2px;
}

.report-group {
    text-align: left;
    margin-bottom: 25px;
}

.report-group label {
    font-weight: 600;
    color: #34495e;
    display: block;
    margin-bottom: 8px;
    font-size: 1.05rem;
}

.report-data {
    background: #ecf0f1;
    padding: 16px 18px;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    color: #2c3e50;
    box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.report-data:hover {
    background: #e0e4e7;
}

.btn-retour {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #197BBF;
    color: #ffffff;
    font-size: 1.1rem;
    padding: 14px 28px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    max-width: 300px;
    margin: 40px auto 0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-retour i {
    margin-right: 10px;
    font-size: 1.1rem;
}

.btn-retour:hover {
    background: #155a8a;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
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
    .report-container {
        padding: 30px 20px;
    }

    .btn-retour {
        width: 100%;
        font-size: 1rem;
    }

    .report-container h3 {
        font-size: 1.5rem;
    }
}

</style>

<div class="container">
    <div class="report-container">
        <h3><i class="fas fa-clipboard-list"></i> Détails de l'Ordre</h3>

        <div class="report-group">
            <label>Nom du Responsable :</label>
            <div class="report-data">{{ $ordre->responsable }}</div>
        </div>

        <div class="report-group">
            <label>Date de l'Ordre :</label>
            <div class="report-data">{{ $ordre->date_ordre }}</div>
        </div>

        <div class="report-group">
            <label>Description de la Tâche :</label>
            <div class="report-data">{{ $ordre->description_tache }}</div>
        </div>

        <div class="report-group">
            <label>Technicien Assigné :</label>
            <div class="report-data">{{ $ordre->technicien }}</div>
        </div>

        <div class="report-group">
            <label>Priorité de l'Intervention :</label>
            <div class="report-data">{{ $ordre->priorite }}</div>
        </div>

        <div class="report-group">
            <label>Date Limite :</label>
            <div class="report-data">{{ $ordre->date_limite }}</div>
        </div>

        <div class="report-group">
            <label>Remarques Supplémentaires :</label>
            <div class="report-data">{{ $ordre->remarques }}</div>
        </div>

        <a href="{{ route('enginieur.ordre.index') }}" class="btn-retour mt-4">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>

    </div>
</div>
@endsection