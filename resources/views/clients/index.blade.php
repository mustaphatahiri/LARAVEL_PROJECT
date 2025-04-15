@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body {
        background: linear-gradient(to right, #f3f4f6, #e3f2fd);
        font-family: 'Poppins', sans-serif;
        padding-top: 120px;
    }

    .container {
        max-width: 750px;
        margin: 50px auto;
    }

    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000;
    }

    .navbar img {
        height: 50px;
    }

    .navbar h2 {
        font-size: 1.8rem;
        color: #197BBF;
        font-weight: bold;
        margin: 0;
    }

    .btn-logout {
        background: #e74c3c;
        color: white;
        font-size: 1rem;
        padding: 8px 20px;
        border-radius: 25px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .btn-logout:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
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
        text-align: left;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        display: block;
        margin-bottom: 5px;
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

    .btn-custom {
        padding: 12px 20px;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 8px;
        width: 100%;
        margin-top: 10px;
        transition: all 0.3s;
        background: #3498db;
        border: none;
        color: white;
    }

    .btn-custom:hover {
        background: #2980b9;
        transform: scale(1.03);
    }

    .alert {
        font-size: 1rem;
        font-weight: bold;
        border-radius: 8px;
        text-align: center;
        padding: 10px;
    }
</style>

<nav class="navbar">
    <img src="{{ asset('image/logo.png') }}" alt="Medical Systems Logo">
    <h2><i class="fas fa-user-md"></i> Médecin Section</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-logout">
            <i class="fas fa-sign-out-alt"></i> Déconnexion
        </button>
    </form>
</nav>

<div class="container">
    <div class="form-container">
        <h3><i class="fas fa-file-medical"></i> Créer une Demande d'Intervention</h3>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('clients.store') }}">
            @csrf
            <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" class="form-control" name="date" required>
            </div>

            <div class="form-group">
                <label for="client">Client :</label>
                <input type="text" class="form-control" name="client" placeholder="Nom du client" required>
            </div>

            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" class="form-control" name="ville" placeholder="Ville du client" required>
            </div>

            <div class="form-group">
                <label for="appareil">Appareil :</label>
                <input type="text" class="form-control" name="appareil" placeholder="Type d'appareil" required>
            </div>

            <div class="form-group">
                <label for="services">Services :</label>
                <input type="text" class="form-control" name="services" placeholder="Type de service" required>
            </div>

            <div class="form-group">
                <label for="sn">Numéro de Série (SN) :</label>
                <input type="text" class="form-control" name="sn" placeholder="Numéro de série" required>
            </div>

            <div class="form-group">
                <label for="problem">Problème :</label>
                <textarea class="form-control" name="problem" rows="3" placeholder="Décrivez le problème" required></textarea>
            </div>

            <button type="submit" class="btn-custom"><i class="fas fa-paper-plane"></i> Envoyer</button>
        </form>
    </div>
</div>
@endsection