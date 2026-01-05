<!doctype html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <title>Ataskaita</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #000; }
        h1 { margin: 0 0 8px 0; }
        .meta { margin-bottom: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 14px; }
        th, td { border: 1px solid #ccc; padding: 6px; }
        th { background: #f2f2f2; text-align: left; }
        .right { text-align: right; }
    </style>
</head>
<body>

<h1>Ataskaita pagal periodą</h1>

<div class="meta">
    Periodas: <strong>{{ $from ?? '—' }}</strong> – <strong>{{ $to ?? '—' }}</strong>
</div>

<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Kategorija</th>
            <th class="right">Suma</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transactions as $t)
            <tr>
                <td>{{ $t->date }}</td>
                <td>{{ $t->category->name }}</td>
                <td class="right">{{ number_format($t->amount, 2, '.', ' ') }} €</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Duomenų nėra</td>
            </tr>
        @endforelse
    </tbody>
</table>

<h3>Suminė pagal kategorijas</h3>

<table>
    <thead>
        <tr>
            <th>Kategorija</th>
            <th class="right">Iš viso</th>
        </tr>
    </thead>
    <tbody>
        @forelse($byCategory as $row)
            <tr>
                <td>{{ $row->category->name }}</td>
                <td class="right">{{ number_format($row->total, 2, '.', ' ') }} €</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">Duomenų nėra</td>
            </tr>
        @endforelse
    </tbody>
</table>

<h3>Analizė</h3>
<ul>
    <li>Min: {{ number_format($stats->min_amount ?? 0, 2, '.', ' ') }} €</li>
    <li>Max: {{ number_format($stats->max_amount ?? 0, 2, '.', ' ') }} €</li>
    <li>Vidurkis: {{ number_format($stats->avg_amount ?? 0, 2, '.', ' ') }} €</li>
</ul>

</body>
</html>
