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
        background: #f3f4f6;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        max-width: 800px;
        min-height: 100vh;
        margin: 0 auto;
        padding-top: 120px;
        padding-bottom: 50px;
    }

    .form-container {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .form-container h3 {
        color: #3498db;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 25px;
        text-align: center;
    }

    .form-group {
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

    .btn-back {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #e74c3c;
        color: white;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-back:hover {
        background: #c0392b;
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .container {
            padding: 100px 20px 50px;
        }

        .form-container {
            padding: 25px;
        }
    }
</style>

<div class="container">
    <div class="form-container">
        <a href="{{ route('tech.demandes') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>

        <h3><i class="fas fa-upload"></i> Uploader le Rapport Scanné</h3>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('tech.reports.storeUpload', $id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Choisir un fichier (PDF/PNG/JPG):</label>
                <input type="file" class="form-control" name="file" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>

            <button type="submit" class="btn btn-primary btn-custom">
                <i class="fas fa-upload"></i> Uploader
            </button>
        </form>
    </div>
</div>
@endsection
