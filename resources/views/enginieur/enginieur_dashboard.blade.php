@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
    body {
    background: linear-gradient(to right, #f3f4f6, #e3f2fd);
    font-family: 'Poppins', sans-serif;
    padding-top: 170px;
    margin: 0;
    color: #333;
}
.best-title {
    font-size: 2.5rem;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 30px;
    background: linear-gradient(90deg, #197BBF, #2ecc71, #f39c12);
    background-size: 300%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: shineText 3s ease-in-out infinite;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.05);
}

@keyframes shineText {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}


.container {
    max-width: 750px;
    margin: auto;
    padding: 0 15px;
}

.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
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
    font-weight: 600;
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
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
}

.btn-logout:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(231, 76, 60, 0.4);
}

.main-container {
    background: #ffffff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
    animation: fadeIn 0.8s ease-in-out;
    text-align: center;
}

.main-container h2 {
    font-size: 2.2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 25px;
}

.btn-custom {
    font-size: 1.1rem;
    padding: 14px 32px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
}

.btn-custom i {
    margin-right: 10px;
}

.btn-outline-success {
    border: 2px solid #2ecc71;
    color: #2ecc71;
}

.btn-outline-success:hover {
    background: #2ecc71;
    color: white;
    transform: translateY(-3px);
}

.btn-outline-primary {
    border: 2px solid #3498db;
    color: #3498db;
}

.btn-outline-primary:hover {
    background: #3498db;
    color: white;
    transform: translateY(-3px);
}

.btn-outline-warning {
    border: 2px solid #f39c12;
    color: #f39c12;
}

.btn-outline-warning:hover {
    background: #f39c12;
    color: white;
    transform: translateY(-3px);
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 576px) {
    .navbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 20px;
    }

    .main-container {
        padding: 30px 20px;
    }

    .main-container h2 {
        font-size: 1.7rem;
    }

    .btn-custom {
        width: 100%;
        margin-bottom: 15px;
    }
}

</style>

<!-- Custom Navbar -->
<nav class="navbar">
    <img src="{{ asset('image/logo.png') }}" alt="Medical Systems Logo">
    <h2><i class="fas fa-cogs"></i> Ingénieur Section</h2>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</button>
    </form>
</nav>

<!-- Main Content -->
<div class="container">
    <div class="main-container">
    <h2 class="best-title">Bienvenue dans votre espace</h2>

        <div class="d-flex justify-content-center flex-wrap gap-4">
            <a href="{{ route('enginieur.ordre.index') }}" class="btn btn-custom btn-outline-success">
                <i class="fas fa-tasks"></i> Ordre d'intervention
            </a>

            <a href="{{ route('enginieur.pv') }}" class="btn btn-custom btn-outline-primary">
                <i class="fas fa-file-alt"></i> PV de réception
            </a>

            <a href="{{route('enginieur.check.index')}}" class="btn btn-custom btn-outline-warning">
                <i class="fas fa-check-square"></i> Check-list
            </a>
        </div>
    </div>
</div>
@endsection