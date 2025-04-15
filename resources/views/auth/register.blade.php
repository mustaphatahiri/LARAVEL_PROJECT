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
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('image/bg5.png') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .signup-container {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        padding: 40px;
        width: 400px;
        color: #0D47A1;
        text-align: center;
        animation: fadeIn 1s ease-in-out;
        margin-top: 100px;
    }

    .form-group {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group label {
        font-weight: bold;
        color: #0D47A1;
        width: 100%;
    }

    .form-group input, .form-group select {
        flex: 1;
        background: rgba(255, 255, 255, 0.7);
        border: none;
        color: #0D47A1;
        padding: 12px;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .form-group input:focus, .form-group select:focus {
        background: rgba(255, 255, 255, 0.9);
        outline: none;
        box-shadow: 0px 0px 10px rgba(13, 71, 161, 0.4);
    }

    .password-container {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .password-container input {
        width: 48%;
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
        font-size: 1rem;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
</style>

<div class="signup-container">
    <h3>S'inscrire</h3>

    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <ul style="list-style: none; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Nom complet" required>
        </div>

        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <div class="password-container">
                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                <input type="password" class="form-control" name="confirmPass" placeholder="Confirmer le mot de passe" required>
            </div>
        </div>

        <div class="form-group">
            <select class="form-select" name="role" required>
                <option selected disabled>Personnel médical :</option>
                <option value="client">Médecin</option>
                <option value="Tech">Technicien</option>
                <option value="Inge">Ingénieur Biomédical</option>
            </select>
        </div>

        <button type="submit" class="btn-primary">S'inscrire</button>

        <p class="text-muted mt-3">Avez-vous déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
    </form>
</div>
@endsection
