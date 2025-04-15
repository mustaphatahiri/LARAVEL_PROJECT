@extends('layouts.app')

@include('includes.navbar')

@section('content')
<link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" />
<style>
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('{{ asset('image/bg5.png') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .login-container {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        backdrop-filter: blur(15px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        padding: 40px;
        width: 400px;
        color: #0D47A1;
        text-align: center;
        animation: fadeIn 1s ease-in-out;
        margin-top: 100px;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group label {
        font-weight: bold;
        color: #0D47A1;
    }

    .form-control,
    .form-select {
        background: rgba(255, 255, 255, 0.6);
        border: none;
        color: #0D47A1;
        padding: 12px;
        border-radius: 8px;
        width: 100%;
        transition: all 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
        background: rgba(255, 255, 255, 0.8);
        outline: none;
        box-shadow: 0px 0px 10px rgba(13, 71, 161, 0.4);
    }

    .btn-primary {
        background: #0D47A1;
        border: none;
        font-size: 1.2rem;
        padding: 12px;
        border-radius: 8px;
        transition: all 0.3s;
        width: 100%;
        cursor: pointer;
        color: white;
    }

    .btn-primary:hover {
        transform: scale(1.05);
        background: #1976D2;
    }

    .text-muted a {
        color: #FF5733;
        text-decoration: none;
        font-weight: bold;
    }

    .alert {
        padding: 12px 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-weight: bold;
        text-align: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 5px solid #28a745;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 5px solid #dc3545;
    }

    .alert-warning {
        background-color: #fff3cd;
        color: #856404;
        border-left: 5px solid #ffc107;
    }

    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border-left: 5px solid #17a2b8;
    }
</style>

<div class="login-container">
    <h3>Connexion</h3>

    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" class="form-control" name="username" placeholder="Entrez votre nom d'utilisateur" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe" required>
        </div>

        <div class="form-group">
            <label for="role">Choisissez votre statut :</label>
            <select class="form-select" name="role" required>
                <option selected disabled>Choisissez votre statut</option>
                <option value="client">Médecin</option>
                <option value="Tech">Technicien Biomédical</option>
                <option value="Inge">Ingénieur Biomédical</option>
            </select>
        </div>

        <button type="submit" class="btn-primary">Connexion</button>

        <p class="text-muted mt-3">Vous n'avez pas de compte ? <a href="{{ route('register') }}">S'inscrire</a></p>
    </form>
</div>
@endsection