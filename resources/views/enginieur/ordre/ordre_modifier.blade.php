@extends('layouts.app')
@include('includes.navbar3')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        color: #ffffff;
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        min-height: 100vh;
    }

    .container {
        max-width: 750px;
        margin: 50px auto;
        padding: 20px;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(8px);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        text-align: center;
        position: relative;
        animation: fadeIn 0.8s ease-in-out;
    }

    .form-container h3 {
        color: #197BBF;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 30px;
        font-size: 1.8rem;
        position: relative;
    }

    .form-container h3::after {
        content: "";
        display: block;
        height: 3px;
        width: 50px;
        background: #197BBF;
        margin: 12px auto 0;
        border-radius: 2px;
    }

    .form-group {
        margin-bottom: 25px;
        text-align: left;
    }

    .form-group label {
        font-weight: 600;
        color: #34495e;
        margin-bottom: 8px;
        display: block;
        font-size: 1rem;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        font-size: 1rem;
        border-radius: 10px;
        border: 2px solid #ddd;
        background: #fdfdfd;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
        color: #2c3e50;
    }

    .form-control:focus {
        border-color: #197BBF;
        box-shadow: 0 0 10px rgba(25, 123, 191, 0.25);
        outline: none;
        background: #ffffff;
    }

    .btn-custom {
        padding: 14px 20px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 10px;
        width: 100%;
        margin-top: 15px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background: #3498db;
        border: none;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
    }

    .btn-primary:hover {
        background: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.35);
    }

    .back-btn {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #e74c3c;
        color: white;
        padding: 10px 18px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(231, 76, 60, 0.2);
    }

    .back-btn:hover {
        background: #c0392b;
        transform: scale(1.05);
        box-shadow: 0 5px 16px rgba(231, 76, 60, 0.35);
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
        .form-container {
            padding: 30px 20px;
        }

        .btn-custom {
            font-size: 0.95rem;
        }

        .form-container h3 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container">
    <div class="form-container">
        <a href="{{ route('enginieur.ordre.index') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Retour</a>
        <h3><i class="fas fa-edit"></i> Modifier l'Ordre</h3>

        <form method="POST" action="{{ route('enginieur.ordre.update', $ordre->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nom du Responsable</label>
                <input type="text" name="responsable" class="form-control" value="{{ $ordre->responsable }}" required>
            </div>

            <div class="form-group">
                <label>Date de l'Ordre</label>
                <input type="date" name="date_ordre" class="form-control" value="{{ $ordre->date_ordre }}" required>
            </div>

            <div class="form-group">
                <label>Description de la Tâche</label>
                <textarea name="description_tache" class="form-control" rows="3" required>{{ $ordre->description_tache }}</textarea>
            </div>

            <div class="form-group">
                <label>Nom du Technicien</label>
                <input type="text" name="technicien" class="form-control" value="{{ $ordre->technicien }}" required>
            </div>

            <div class="form-group">
                <label>Priorité</label>
                <select name="priorite" class="form-control" required>
                    <option value="">-- Sélectionner la priorité --</option>
                    <option value="Haute" {{ $ordre->priorite == 'Haute' ? 'selected' : '' }}>Haute</option>
                    <option value="Moyenne" {{ $ordre->priorite == 'Moyenne' ? 'selected' : '' }}>Moyenne</option>
                    <option value="Basse" {{ $ordre->priorite == 'Basse' ? 'selected' : '' }}>Basse</option>
                </select>
            </div>

            <div class="form-group">
                <label>Date Limite</label>
                <input type="date" name="date_limite" class="form-control" value="{{ $ordre->date_limite }}" required>
            </div>

            <div class="form-group">
                <label>Remarques Supplémentaires</label>
                <textarea name="remarques" class="form-control" rows="3">{{ $ordre->remarques }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-custom">
                <i class="fas fa-save"></i> Enregistrer les modifications
            </button>
        </form>
    </div>
</div>
@endsection