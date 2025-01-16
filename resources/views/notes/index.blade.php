<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes des Élèves</title>
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
        }

        h1 {
            color: #4a4e69;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        input {
            padding: 10px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #9a8c98;
            box-shadow: 0 0 5px rgba(154, 140, 152, 0.5);
            outline: none;
        }

        button {
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #4a4e69;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #22223b;
        }

        table {
            width: 80%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            overflow: hidden;
            border-radius: 8px;
        }

        th, td {
            padding: 12px 20px;
            text-align: center;
            font-size: 1rem;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4a4e69;
            color: #fff;
            font-weight: bold;
        }

        tr.even {
            background-color: black; 
            color: white; 
        }

        tr.odd {
            background-color: white; 
        }

        .green { background-color: #44a774; color: white; }
        .orange { background-color: #fb8b23; color: white; }
        .red { background-color: #f26969; color: white; }

        .footer {
            margin-top: 40px;
            font-size: 0.9rem;
            color: #aaa;
        }

        p {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <h1>Notes des Élèves</h1>

    <form action="{{ route('show') }}" method="GET">
        <input type="text" name="txtRech" value="{{ old('txtRech') }}" placeholder="Rechercher un élève...">
        <button type="submit">Rechercher</button>
    </form>

    @if(session()->has('result'))
        @php $notes = session('result'); @endphp
    @endif

    @if(isset($notes) && count($notes) > 0)
        <table>
            <tr>
                <th>Nom</th>
                <th>Note</th>
            </tr>
            @foreach($notes as $nom => $note)
                <tr class="{{ isset($decorate) && $decorate ? ($loop->even ? 'even' : 'odd') : '' }}">
                    <td @if(isset($colorier))
                            class="{{ $note > 10 ? 'green' : ($note >= 8 ? 'orange' : 'red') }}"
                        @endif>{{ $nom }}</td>
                    <td @if(isset($colorier))
                            class="{{ $note > 10 ? 'green' : ($note >= 8 ? 'orange' : 'red') }}"
                        @endif>{{ $note }}</td>
                </tr>
            @endforeach
        </table>
    @elseif(isset($notes) && count($notes) == 0)
        <p> Cet élève ne figure pas dans le tableau </p>
    @endif
</body>
</html>
