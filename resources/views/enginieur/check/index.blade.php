@extends('layouts.app')
@include('includes.navbar3')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("{{ asset('image/bg1.png') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Poppins', sans-serif;
        padding-top: 120px;
    }

    .table th {
        background-color: #15cda4;
        color: white;
    }

    .btn-back {
        background-color: #6c757d;
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
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('enginieur.dashboard') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    <h4 class="text-center text-white mt-3">{{ now()->format('Y-m-d / h:i:s A') }}</h4>

    <div class="search-container">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <button class="btn btn-success my-3" onclick="document.getElementById('addForm').classList.toggle('d-none')">
    <i class="fas fa-plus-circle"></i> Ajouter
</button>

<div id="addForm" class="d-none p-3 border rounded bg-light">
    <form method="POST" action="{{ route('enginieur.check.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <input type="text" name="verificateur" class="form-control" placeholder="Nom du Vérificateur" required>
            </div>
            <div class="col-md-6">
                <input type="date" name="date_verification" class="form-control" required>
            </div>
            <div class="col-md-12">
                <textarea name="elements_verifies" class="form-control" placeholder="Éléments Vérifiés" rows="3" required></textarea>
            </div>
            <div class="col-md-12">
                <select name="statut_verification" class="form-select" required>
                    <option value="">-- Statut de Vérification --</option>
                    <option value="Conforme">Conforme</option>
                    <option value="Non Conforme">Non Conforme</option>
                </select>
            </div>
            <div class="col-md-12">
                <textarea name="remarques" class="form-control" placeholder="Remarques Supplémentaires" rows="2"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Soumettre</button>
    </form>
</div>

    <div class="table-container mt-4 bg-white rounded shadow p-3">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vérificateur</th>
                    <th>Date</th>
                    <th>Éléments</th>
                    <th>Statut</th>
                    <th>Remarques</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->verificateur }}</td>
                        <td>{{ $item->date_verification }}</td>
                        <td>{!! nl2br(e($item->elements_verifies)) !!}</td>
                        <td>{{ $item->statut_verification }}</td>
                        <td>{{ $item->remarques }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('enginieur.check.show', $item->id) }}" class="btn btn-info btn-action"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('enginieur.check.edit', $item->id) }}" class="btn btn-warning btn-action"><i class="fas fa-edit"></i></a>

                                <!-- Trigger Modal -->
                                <button type="button" class="btn btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="modalLabel{{ $item->id }}"><i class="fas fa-exclamation-triangle"></i> Confirmer la suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer cette vérification ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form method="POST" action="{{ route('enginieur.check.destroy', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('.table tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
