@extends('layouts.app')
@include('includes.navbar2')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                      url("{{ asset('image/bg1.png') }}");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-family: 'Poppins', sans-serif;
    color: #fff;
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    min-height: 100vh;
}

.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 40px 20px 60px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.report-container {
    width: 100%;
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(8px);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    position: relative;
    animation: fadeIn 0.8s ease-in-out;
    color: #2c3e50;
}

.report-container h3 {
    color: #76d00a;
    font-size: 1.8rem;
    font-weight: 700;
    text-transform: uppercase;
    text-align: center;
    margin-bottom: 30px;
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
    margin-bottom: 20px;
    text-align: left;
}

.report-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
    display: block;
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
    transition: 0.3s ease;
}

.report-data:hover {
    background-color: #dfe6e9;
}

.btn-back {
    display: inline-block;
    margin-top: 30px;
    background: #178fd9;
    color: white;
    font-size: 1.1rem;
    padding: 14px 28px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.btn-back:hover {
    background: #178fd9;
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

@media (max-width: 768px) {
    .container {
        padding: 20px;
        margin-top: 130px;
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
        <h3 style="color: #178fd9;"><i class="fas fa-file-alt"></i> Rapport d'Intervention</h3>

        <div class="report-group">
            <label>Article :</label>
            <div class="report-data">{{ $report->Article }}</div>
        </div>

        <div class="report-group">
            <label>Intervenant :</label>
            <div class="report-data">{{ $report->Intervenant }}</div>
        </div>

        <div class="report-group">
            <label>Maintenance :</label>
            <div class="report-data">{{ $report->Maintenance }}</div>
        </div>

        <div class="report-group">
            <label>Date d'Intervention :</label>
            <div class="report-data">{{ $report->{"Date d'intervention"} }}</div>
        </div>

        <div class="report-group">
            <label>Lieu :</label>
            <div class="report-data">{{ $report->Lieu }}</div>
        </div>

        <div class="report-group">
            <label>Description :</label>
            <div class="report-data">{{ $report->intervention_description }}</div>
        </div>

        <div class="report-group">
            <label>Résultat :</label>
            <div class="report-data">{{ $report->intervention_result }}</div>
        </div>

        <div class="report-group">
            <label>Remarques :</label>
            <div class="report-data">{{ $report->remarks }}</div>
        </div>
        <div class="text-center">

        <a href="{{ route('tech.demandes') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
        </div>
    </div>
</div>
@endsection
