@extends('layouts.app')
@include('includes.navbar2')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

<style>
    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url("{{ asset('image/bg1.png') }}");
        backdrop-filter: blur(2px);
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Poppins', sans-serif;
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
    .container h1 {
        color: white;
        text-align: center;
    padding-right: 120px;
    }
    .table-container {
        margin-top: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        background-color: white;
        padding: 20px;
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
        margin-bottom: 15px;
    }

    #searchInput {
        width: 100%;
        max-width: 400px;
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

    .btn-back {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background-color: #5a6268;
        transform: scale(1.05);
    }

    .btn-action {
        font-size: 1rem;
        padding: 6px;
        border-radius: 50%;
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
        <div>
            <a href="{{ route('tech.dashboard') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
        <h1 class=" flex-grow-1">Demandes d'intervention</h1>
    </div>

    <h4 style="color: white;" class="text-center mt-3">{{ \Carbon\Carbon::now()->format('Y-m-d / h:i:s A') }}</h4>

    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par Client, Ville, Appareil...">
    </div>

    <div class="table-container">
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Client Id</th>
                    <th>Date</th>
                    <th>Client/Organisme</th>
                    <th>Ville</th>
                    <th>Appareil</th>
                    <th>S.N</th>
                    <th>Problème</th>
                    <th>État</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->Date }}</td>
                    <td>{{ $item->{'Client/Organisme'} }}</td>
                    <td>{{ $item->Ville }}</td>
                    <td>{{ $item->appareil }}</td>
                    <td>{{ $item->serial_number }}</td>
                    <td>{{ $item->problem }}</td>
                    <td class="fw-bold text-success">{{ $item->state }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('tech.reports.write', $item->id) }}" class="btn btn-primary btn-action" title="Écrire Rapport">
                                <i class="fas fa-pen"></i>
                            </a>

                            <a href="{{ route('tech.reports.view', $item->id) }}"
                                class="btn btn-info btn-action" title="Voir le Rapport">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('tech.reports.upload', $item->id) }}"
                                class="btn btn-success btn-action" title="Uploader Rapport Scanné">
                                <i class="fas fa-upload"></i>
                            </a>
                            <a href="{{ route('tech.reports.scanned', $item->id) }}"
                                class="btn btn-warning btn-action" title="Voir le Rapport Scanné">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="9">Aucune demande trouvée.</td>
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
            let columns = row.querySelectorAll('td');
            let match = false;
            columns.forEach(function(column) {
                if (column.textContent.toLowerCase().includes(searchValue)) {
                    match = true;
                }
            });
            row.style.display = match ? '' : 'none';
        });
    });
</script>
@endsection