@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📊 Finansų apžvalga</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pajamos</h5>
                    <p class="fs-3">{{ number_format($income, 2) }} €</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Išlaidos</h5>
                    <p class="fs-3">{{ number_format($expense, 2) }} €</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Likutis</h5>
                    <p class="fs-3">{{ number_format($balance, 2) }} €</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Veiksmo mygtukai --}}
    <div class="d-flex gap-2">
        <a href="{{ route('transactions.create') }}" class="btn btn-success">
            ➕ Pridėti pajamą / išlaidą
        </a>

        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
            📄 Visi įrašai
        </a>

        <a href="{{ route('reports.index') }}" class="btn btn-outline-primary">
            📊 Ataskaitos
        </a>
    </div>
</div>
@endsection
