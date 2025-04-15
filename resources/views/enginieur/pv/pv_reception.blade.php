@extends('layouts.app')
@section('content')

@include('includes.navbar3')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url("{{ asset('image/bg1.png') }}");
        backdrop-filter: blur(2px);
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Poppins', sans-serif;
        padding-top: 100px;
    }

    .table th {
        background-color: #76d00a;
        color: white;
    }

    .btn-warning {
        color: white;
    }

    .btn-back {
        background-color: #34495e;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        border-radius: 8px;
        transition: 0.2s ease;
    }

    .btn-action i {
        margin: 0;
    }

    .search-container {
        display: flex;
        justify-content: center;
        margin: 30px 0;
    }

    #searchInput {
        width: 100%;
        max-width: 500px;
        border-radius: 25px;
        padding: 12px 20px;
        font-size: 1rem;
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: white;
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
        margin: 0;
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
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('enginieur.dashboard') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <h4 class="text-center text-white">{{ now()->format('Y-m-d / h:i:s A') }}</h4>

    <div class="search-container my-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par ingénieur ou état...">
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-success mb-3 text-white" onclick="document.getElementById('addForm').classList.toggle('d-none')">
        <i class="fas fa-plus-circle"></i> Ajouter
    </button>

    <!-- Formulaire ajout -->
    <div id="addForm" class="d-none p-3 border rounded bg-light">
        <form method="POST" action="{{ route('enginieur.pv.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6"><input type="text" name="ingenieur" class="form-control" placeholder="Nom de l'ingénieur" required></div>
                <div class="col-md-6"><input type="date" name="date_reception" class="form-control" required></div>
                <div class="col-md-12"><textarea name="description_machine" class="form-control" placeholder="Description de la machine" rows="3" required></textarea></div>
                <div class="col-md-6">
                    <select name="etat_machine" class="form-select" required>
                        <option value="">-- État de la machine --</option>
                        <option value="Fonctionnelle">Fonctionnelle</option>
                        <option value="Non Fonctionnelle">Non Fonctionnelle</option>
                    </select>
                </div>
                <div class="col-md-12"><textarea name="remarques" class="form-control" placeholder="Remarques supplémentaires" rows="2"></textarea></div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Soumettre</button>
        </form>
    </div>

    <!-- Table -->
    <div class="table-container mt-4 bg-white rounded shadow p-3">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ingénieur</th>
                    <th>Date</th>
                    <th>Machine</th>
                    <th>État</th>
                    <th>Remarques</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pvs as $pv)
                <tr>
                    <td>{{ $pv->id }}</td>
                    <td>{{ $pv->ingenieur }}</td>
                    <td>{{ $pv->date_reception }}</td>
                    <td>{{ $pv->description_machine }}</td>
                    <td>{{ $pv->etat_machine }}</td>
                    <td>{{ $pv->remarques }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('enginieur.pv.show', $pv->id) }}" class="btn btn-info btn-action"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('enginieur.pv.edit', $pv->id) }}" class="btn btn-warning btn-action"><i class="fas fa-edit"></i></a>
                            <!-- Trigger Button -->
                            <button type="button" class="btn btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pv->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <!-- Modal de confirmation -->
                <div class="modal fade" id="deleteModal{{ $pv->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $pv->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalLabel{{ $pv->id }}">
                                    <i class="fas fa-exclamation-triangle"></i> Confirmer la suppression
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer ce PV ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form method="POST" action="{{ route('enginieur.pv.destroy', $pv->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('.table tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
@endsection