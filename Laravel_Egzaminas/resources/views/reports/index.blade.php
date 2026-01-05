@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ataskaita pagal periodą</h1>

    <form method="GET" action="{{ route('reports.index') }}" class="mb-3">
        <input type="date" name="from" value="{{ request('from', $from) }}">
        <input type="date" name="to" value="{{ request('to', $to) }}">

        <button class="btn btn-primary">Filtruoti</button>

        <a class="btn btn-danger"
           href="{{ route('reports.pdf', ['from' => request('from', $from), 'to' => request('to', $to)]) }}">
            Atsisiųsti PDF
        </a>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Kategorija</th>
                <th>Suma</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
                <tr>
                    <td>{{ $t->date }}</td>
                    <td>{{ $t->category->name }}</td>
                    <td>{{ number_format($t->amount, 2, '.', ' ') }} €</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Duomenų nėra</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
