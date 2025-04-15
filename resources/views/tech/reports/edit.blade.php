@extends('layouts.app')
@include('includes.navbar2')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body {
        background: #f3f4f6;
        font-family: 'Poppins', sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
        url("{{ asset('image/bg1.png') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .container {
        max-width: 750px;
        margin: 50px auto;
    }

    .form-container {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
    }

    .form-container h3 {
        color: #3498db;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 25px;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
        text-align: left;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        font-size: 1rem;
        border-radius: 8px;
        border: 2px solid #ddd;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
        outline: none;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        display: block;
        margin-bottom: 5px;
    }

    .btn-custom {
        padding: 12px 20px;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 8px;
        width: 100%;
        margin-top: 10px;
        transition: all 0.3s;
    }

    .btn-primary {
        background: #3498db;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
        transform: scale(1.03);
    }

    .back-btn {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #e74c3c;
        color: white;
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        transition: 0.3s;
    }

    .back-btn:hover {
        background: #c0392b;
        transform: scale(1.05);
    }
</style>

<div class="container">
    <div class="form-container">
        <a href="{{ route('tech.interventions') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Retour</a>
        <h3><i class="fas fa-edit"></i> Modifier le Rapport</h3>

        <form method="POST" action="{{ route('tech.reports.update', $report->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="Article">Article</label>
                <input type="text" class="form-control" name="article" value="{{ old('article', $report->Article) }}" required>
            </div>

            <div class="form-group">
                <label for="Intervenant">Intervenant</label>
                <input type="text" class="form-control" name="intervenant" value="{{ old('intervenant', $report->Intervenant) }}" required>
            </div>

            <div class="form-group">
                <label for="Maintenance">Maintenance</label>
                <input type="text" class="form-control" name="maintenance" value="{{ old('maintenance', $report->Maintenance) }}" required>
            </div>

            <div class="form-group">
                <label for="Date d'intervention">Date d'Intervention</label>
                <input type="date" class="form-control" name="date_intervention" value="{{ old('date_intervention', $report->{"Date d'intervention"} ) }}" required>
            </div>

            <div class="form-group">
                <label for="Lieu">Lieu</label>
                <input type="text" class="form-control" name="lieu" value="{{ old('lieu', $report->Lieu) }}" required>
            </div>

            <div class="form-group">
                <label for="intervention_description">Description</label>
                <textarea class="form-control" name="intervention_description" rows="3" required>{{ old('intervention_description', $report->intervention_description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="intervention_result">Résultat</label>
                <select class="form-control" name="intervention_result" required>
                    <option value="">-- Sélectionnez un résultat --</option>
                    <option value="Réparé" {{ old('intervention_result', $report->intervention_result) === 'Réparé' ? 'selected' : '' }}>Réparé</option>
                    <option value="En cours de réparation" {{ old('intervention_result', $report->intervention_result) === 'En cours de réparation' ? 'selected' : '' }}>En cours de réparation</option>
                    <option value="Reformé" {{ old('intervention_result', $report->intervention_result) === 'Reformé' ? 'selected' : '' }}>Reformé</option>
                </select>
            </div>

            <div class="form-group">
                <label for="remarks">Remarques</label>
                <textarea class="form-control" name="remarks" rows="3" required>{{ old('remarks', $report->remarks) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-custom"><i class="fas fa-save"></i> Mettre à jour</button>
        </form>
    </div>
</div>
@endsection