<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes des Élèves</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            color: #4a90e2;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        input {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            outline: none;
            transition: 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input:focus {
            border-color: #4a90e2;
            box-shadow: 0 2px 5px rgba(74, 144, 226, 0.3);
        }

        button {
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #4a90e2;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #357ab7;
        }

        table {
            width: 80%;
            margin-top: 30px;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
            font-size: 1.1rem;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4a90e2;
            color: white;
            font-weight: bold;
        }

        /* Black and white row alternating */
        tr:nth-child(even) {
            background-color: #000;
            color: #fff;
        }

        tr:nth-child(odd) {
            background-color: #fff;
            color: #333;
        }

        .green { background-color: #44a774; color: white; }
        .orange { background-color: #fb8b23; color: white; }
        .red { background-color: #f26969; color: white; }

        p {
            margin-top: 20px;
            padding: 15px;
            background-color: #ffcc00;
            border-radius: 5px;
            font-weight: bold;
            color: #333;
        }

        .footer {
            margin-top: 50px;
            font-size: 0.9rem;
            color: #777;
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
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notes as $nom => $note)
                    <tr>
                        <td @if(isset($colorier))
                                class="{{ $note > 10 ? 'green' : ($note >= 8 ? 'orange' : 'red') }}"
                            @endif>{{ $nom }}</td>
                        <td @if(isset($colorier))
                                class="{{ $note > 10 ? 'green' : ($note >= 8 ? 'orange' : 'red') }}"
                            @endif>{{ $note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(isset($notes) && count($notes) == 0)
        <p>Cet élève ne figure pas dans le tableau.</p>
    @endif
</body>
</html>
