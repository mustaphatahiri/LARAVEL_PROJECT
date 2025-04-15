@extends('layouts.app')
@include('includes.navbar2')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<style>
    body {
        background: linear-gradient(to right, #f3f4f6, #e3f2fd);
        font-family: Arial, sans-serif;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .table th {
        background-color: #4CAF50;
        color: white;
    }

    .btn:hover {
        transform: scale(1.05);
        background-color: #3498db;
        color: white;
    }

    .container {
        margin-top: 30px;
    }

    .table-container {
        margin-top: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        background-color: white;
        padding: 20px;
    }

    .btn-back {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background-color: #5a6268;
        transform: scale(1.05);
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

    #searchInput {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
        border-radius: 25px;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    #searchInput:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.5);
    }

    .btn-action {
        font-size: 0.9rem;
        padding: 6px 10px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        transition: all 0.3s ease-in-out;
    }

    .btn-action i {
        font-size: 1rem;
    }

    .btn-action:hover {
        transform: scale(1.1);
    }

    .gap-1 {
        gap: 8px;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('tech.dashboard') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
        <h1 class="text-center flex-grow-1">Rapports d'interventions</h1>

    </div>

    <h4 class="text-center mt-3">{{ \Carbon\Carbon::now()->format('Y-m-d / h:i:s A') }}</h4>

    <!-- Search Bar -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par Article, Intervenant, Maintenance...">
    </div>

    <div class="table-container">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Article</th>
                    <th>Intervenant</th>
                    <th>Maintenance</th>
                    <th>Date d'Intervention</th>
                    <th>Lieu</th>
                    <th>Description</th>
                    <th>Résultat</th>
                    <th>Remarques</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->Article }}</td>
                    <td>{{ $report->Intervenant }}</td>
                    <td>{{ $report->Maintenance }}</td>
                    <td>{{ $report->{"Date d'intervention"} }}</td>
                    <td>{{ $report->Lieu }}</td>
                    <td>{{ $report->intervention_description }}</td>
                    <td>{{ $report->intervention_result }}</td>
                    <td>{{ $report->remarks }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <!-- Edit -->
                            <a href="{{ route('tech.reports.edit', $report->id) }}" class="btn btn-warning btn-action">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete Trigger Button -->
                            <button type="button" class="btn btn-danger btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $report->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Modal for this report -->
                <div class="modal fade" id="deleteModal{{ $report->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $report->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalLabel{{ $report->id }}">
                                    <i class="fas fa-exclamation-triangle"></i> Confirmer la suppression
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer ce rapport ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form method="POST" action="{{ route('tech.reports.destroy', $report->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Oui, Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="10">Aucun rapport trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll('.table tbody tr');
        rows.forEach(function(row) {
            let match = Array.from(row.children).some(cell =>
                cell.textContent.toLowerCase().includes(searchValue)
            );
            row.style.display = match ? '' : 'none';
        });
    });
</script>
@endsection