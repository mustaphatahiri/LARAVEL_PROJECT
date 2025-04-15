@extends('layouts.app')
@include('includes.navbar3')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
   body {
    background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                      url("{{ asset('image/bg1.png') }}");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding-top: 120px;
    color: #fff;
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    min-height: 100vh;
}

.container {
    max-width: 800px;
    margin: auto;
    padding: 40px 20px;
}

.form-container {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(8px);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    position: relative;
    animation: fadeIn 0.8s ease-in-out;
}

h3 {
    color: #e67e22;
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
    font-size: 1.8rem;
    text-transform: uppercase;
    position: relative;
}

h3::after {
    content: "";
    display: block;
    height: 3px;
    width: 60px;
    background: #e67e22;
    margin: 12px auto 0;
    border-radius: 2px;
}

label {
    font-weight: 600;
    color: #34495e;
    display: block;
    margin-bottom: 6px;
}

.form-control, .form-select {
    border-radius: 10px;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
    padding: 12px 15px;
    border: 2px solid #ddd;
    font-size: 1rem;
    color: #2c3e50;
}

.form-control:focus,
.form-select:focus {
    border-color: #197BBF;
    box-shadow: 0 0 10px rgba(25, 123, 191, 0.2);
    outline: none;
}

.btn-submit {
    background: #e67e22;
    color: white;
    font-weight: 600;
    width: 100%;
    padding: 14px;
    border-radius: 10px;
    border: none;
    margin-top: 20px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-submit:hover {
    background: #cf711f;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.btn-back {
    position: absolute;
    top: 20px;
    left: 20px;
    background: #e74c3c;
    color: white;
    padding: 10px 16px;
    border-radius: 10px;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(231, 76, 60, 0.2);
}

.btn-back:hover {
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
    .form-container {
        padding: 30px 20px;
    }

    h3 {
        font-size: 1.5rem;
    }

    .navbar h2 {
        font-size: 1.3rem;
    }

    .btn-back {
        font-size: 0.85rem;
        padding: 8px 12px;
    }
}

</style>

<div class="container">
    <div class="form-container position-relative">
        <a href="{{ route('enginieur.check.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Retour</a>

        <h3 style="color: 15cda4;"><i style="color: 15cda4;" class="fas fa-edit"></i> Modifier la Vérification</h3>

        <form method="POST" action="{{ route('enginieur.check.update', $check->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nom du Vérificateur</label>
                <input type="text" name="verificateur" class="form-control" value="{{ $check->verificateur }}" required>
            </div>

            <div class="mb-3">
                <label>Date de Vérification</label>
                <input type="date" name="date_verification" class="form-control" value="{{ $check->date_verification }}" required>
            </div>

            <div class="mb-3">
                <label>Éléments Vérifiés</label>
                <textarea name="elements_verifies" class="form-control" rows="3" required>{{ $check->elements_verifies }}</textarea>
            </div>

            <div class="mb-3">
                <label>Statut de Vérification</label>
                <select name="statut_verification" class="form-select" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Conforme" {{ $check->statut_verification == 'Conforme' ? 'selected' : '' }}>Conforme</option>
                    <option value="Non Conforme" {{ $check->statut_verification == 'Non Conforme' ? 'selected' : '' }}>Non Conforme</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Remarques</label>
                <textarea name="remarques" class="form-control" rows="2">{{ $check->remarques }}</textarea>
            </div>

            <button style="background-color: 15cda4;" type="submit" class="btn btn-submit"><i class="fas fa-save"></i> Enregistrer</button>
        </form>
    </div>
</div>
@endsection
