@extends('layouts.app')
@include('includes.navbar3')

@section('content')
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
    }

    .search-container {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    #searchInput {
        max-width: 400px;
        border-radius: 25px;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .container {
        margin-top: 30px;
    }

    .table-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
        padding: 20px;
    }

    .table th {
        background-color: #197BBF;
        color: white;
        white-space: nowrap;
    }

    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .btn-back {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    h1,
    h4 {
        color: #fff;
        font-weight: bold;
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
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('enginieur.dashboard') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <h4 class="text-center mt-3">{{ now()->format('Y-m-d / h:i:s A') }}</h4>

    <div class="search-container">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un responsable, technicien...">
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-success mb-3" onclick="document.getElementById('addForm').classList.toggle('d-none')">
        <i class="fas fa-plus-circle"></i> Ajouter
    </button>

    <!-- Formulaire ajout -->
    <div id="addForm" class="d-none p-3 border rounded bg-light">
        <form method="POST" action="{{ route('enginieur.ordre.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6"><input type="text" name="responsable" class="form-control" placeholder="Nom du Responsable" required></div>
                <div class="col-md-6"><input type="date" name="date_ordre" class="form-control" required></div>
                <div class="col-md-12"><textarea name="description_tache" class="form-control" placeholder="Description de la Tâche" rows="3" required></textarea></div>
                <div class="col-md-6"><input type="text" name="technicien" class="form-control" placeholder="Nom du Technicien" required></div>
                <div class="col-md-6">
                    <select name="priorite" class="form-select" required>
                        <option value="">-- Priorité --</option>
                        <option value="Haute">Haute</option>
                        <option value="Moyenne">Moyenne</option>
                        <option value="Basse">Basse</option>
                    </select>
                </div>
                <div class="col-md-6"><input type="date" name="date_limite" class="form-control" required></div>
                <div class="col-md-12"><textarea name="remarques" class="form-control" placeholder="Remarques Supplémentaires" rows="2"></textarea></div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Soumettre</button>
        </form>
    </div>

    <!-- Table -->
    <div class="table-container mt-4">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Responsable</th>
                    <th>Date</th>
                    <th>Tâche</th>
                    <th>Technicien</th>
                    <th>Priorité</th>
                    <th>Date Limite</th>
                    <th>Remarques</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->responsable }}</td>
                    <td>{{ $item->date_ordre }}</td>
                    <td>{{ $item->description_tache }}</td>
                    <td>{{ $item->technicien }}</td>
                    <td>{{ $item->priorite }}</td>
                    <td>{{ $item->date_limite }}</td>
                    <td>{{ $item->remarques }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('enginieur.ordre.show', $item->id) }}" class="btn btn-info btn-action" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('enginieur.ordre.edit', $item->id) }}" class="btn btn-warning btn-action" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('enginieur.ordre.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <!-- Trigger Button -->
                                <button type="button" class="btn btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <!-- Modal de confirmation -->
                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalLabel{{ $item->id }}"><i class="fas fa-exclamation-triangle"></i> Confirmer la suppression</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer cet ordre d’intervention ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form method="POST" action="{{ route('enginieur.ordre.destroy', $item->id) }}">
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