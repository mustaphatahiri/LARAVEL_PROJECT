@extends('layouts.app')
@include('includes.navbar2')
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
    color: #fff;
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    min-height: 100vh;
}

.container {
    max-width: 750px;
    margin: 50px auto;
}

.form-container {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(8px);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    position: relative;
    text-align: center;
    animation: fadeIn 0.7s ease-in-out;
}

.form-container h3 {
    color: #3498db;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 30px;
    font-size: 1.8rem;
    position: relative;
}

.form-container h3::after {
    content: "";
    display: block;
    width: 50px;
    height: 3px;
    background: #3498db;
    margin: 10px auto 0;
    border-radius: 2px;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 6px;
    display: block;
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    font-size: 1rem;
    border-radius: 10px;
    border: 2px solid #ddd;
    box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.03);
    transition: 0.3s;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 10px rgba(52, 152, 219, 0.3);
    outline: none;
}

.btn-custom {
    width: 100%;
    padding: 14px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 10px;
    border: none;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background: #3498db;
    color: white;
}

.btn-primary:hover {
    background: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.back-btn {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #e74c3c;
    color: white;
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3);
}

.back-btn:hover {
    background: #c0392b;
    transform: scale(1.05);
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

    .form-container h3 {
        font-size: 1.5rem;
    }

    .back-btn {
        font-size: 0.8rem;
        padding: 8px 12px;
    }
}

</style>

<div class="container">
    <div class="form-container">
        <a href="{{ route('tech.demandes') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Retour</a>

        <h3><i class="fas fa-file-alt"></i> Rapport d'Intervention</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding: 0; list-style: none;">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('tech.reports.store', $demande->id) }}">
            @csrf

            <div class="form-group">
                <label>Article :</label>
                <input type="text" class="form-control" name="article" placeholder="Entrez l'article" required>
            </div>

            <div class="form-group">
                <label>Intervenant :</label>
                <input type="text" class="form-control" name="intervenant" placeholder="Nom de l'intervenant" required>
            </div>

            <div class="form-group">
                <label>Maintenance :</label>
                <input type="text" class="form-control" name="maintenance" placeholder="Type de maintenance" required>
            </div>

            <div class="form-group">
                <label>Date d'Intervention :</label>
                <input type="date" class="form-control" name="date_intervention" required>
            </div>

            <div class="form-group">
                <label>Lieu :</label>
                <input type="text" class="form-control" name="lieu" placeholder="Lieu de l'intervention" required>
            </div>

            <div class="form-group">
                <label>Description :</label>
                <textarea class="form-control" name="intervention_description" rows="3" placeholder="Décrivez l'intervention" required></textarea>
            </div>

            <div class="form-group">
                <label>Résultat :</label>
                <select class="form-control" name="intervention_result" required>
                    <option value="">Sélectionner un résultat</option>
                    <option value="Réparé">Réparé</option>
                    <option value="En cours de réparation">En cours de réparation</option>
                    <option value="Reformé">Reformé</option>
                </select>
            </div>

            <div class="form-group">
                <label>Remarques :</label>
                <textarea class="form-control" name="remarks" rows="3" placeholder="Ajoutez vos remarques" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-custom">
                <i class="fas fa-paper-plane"></i> Soumettre
            </button>
        </form>
    </div>
</div>
@endsection
