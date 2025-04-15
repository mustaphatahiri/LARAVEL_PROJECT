@extends('layouts.app')
@include('includes.navbar3')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    html,
body {
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
    padding: 40px 20px 80px;
}

.form-container {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(8px);
    padding: 40px;
    border-radius: 20px;
    margin-top: 155px;

    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    position: relative;
    animation: fadeIn 0.8s ease-in-out;
}

.form-container h3 {
    color: #76d00a;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 30px;
    text-align: center;
    font-size: 1.8rem;
    position: relative;
}

.form-container h3::after {
    content: "";
    display: block;
    height: 3px;
    width: 50px;
    background: #e67e22;
    margin: 12px auto 0;
    border-radius: 2px;
}

.form-group label {
    font-weight: 600;
    color: #34495e;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    padding: 12px 15px;
    font-size: 1rem;
    border-radius: 10px;
    border: 2px solid #ddd;
    width: 100%;
    background: #fdfdfd;
    box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
    transition: 0.3s;
    color: #2c3e50;
}

.form-control:focus {
    border-color: #197BBF;
    box-shadow: 0 0 10px rgba(25, 123, 191, 0.25);
    outline: none;
    background: #fff;
}

.btn-custom {
    background: #76d00a;
    color: white;
    font-weight: bold;
    padding: 14px;
    font-size: 1rem;
    border: none;
    border-radius: 12px;
    width: 100%;
    margin-top: 20px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-transform: uppercase;
}

.btn-custom:hover {
    background: #76d00a;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.back-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    background: #e74c3c;
    color: white;
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
    box-shadow: 0 3px 10px rgba(231, 76, 60, 0.2);
}

.back-btn:hover {
    background: #c0392b;
    transform: scale(1.05);
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
    .form-container {
        padding: 25px;
    }

    .btn-custom {
        font-size: 0.95rem;
    }

    .navbar h2 {
        font-size: 1.3rem;
    }
}

</style>

<div class="container">
    <div class="form-container">
        <a href="{{ route('enginieur.pv') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Retour</a>
        <h3><i class="fas fa-edit"></i> Modifier le PV</h3>

        <form method="POST" action="{{ route('enginieur.pv.update', $pv->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nom de l'Ingénieur</label>
                <input type="text" name="ingenieur" class="form-control" value="{{ $pv->ingenieur }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Date de Réception</label>
                <input type="date" name="date_reception" class="form-control" value="{{ $pv->date_reception }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Description de la Machine</label>
                <textarea name="description_machine" class="form-control" rows="3" required>{{ $pv->description_machine }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>État de la Machine</label>
                <select name="etat_machine" class="form-control" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Fonctionnelle" {{ $pv->etat_machine === 'Fonctionnelle' ? 'selected' : '' }}>Fonctionnelle</option>
                    <option value="Non Fonctionnelle" {{ $pv->etat_machine === 'Non Fonctionnelle' ? 'selected' : '' }}>Non Fonctionnelle</option>
                </select>
            </div>

            <div class="form-group mb-4">
                <label>Remarques</label>
                <textarea name="remarques" class="form-control" rows="3">{{ $pv->remarques }}</textarea>
            </div>

            <button type="submit" class="btn btn-custom"><i class="fas fa-save"></i> Enregistrer les modifications</button>
        </form>
    </div>
</div>
@endsection