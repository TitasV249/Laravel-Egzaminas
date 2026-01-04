@extends('layouts.app')

@section('content')
<div class="container py-4 px-4">

    <h1 class="mb-4">➕ Naujas įrašas</h1>

    @if($categories->isEmpty())
        <div class="alert alert-warning">
            ⚠️ Nėra sukurtų kategorijų.
            <a href="{{ route('categories.index') }}">Sukurti kategorijas</a>
        </div>
    @endif

    <form method="POST" action="{{ route('transactions.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Kategorija</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- pasirinkti --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }} ({{ $category->type === 'income' ? 'Pajamos' : 'Išlaidos' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Suma (€)</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Data</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Aprašymas</label>
            <input type="text" name="description" class="form-control">
        </div>

        <button class="btn btn-success">
            💾 Išsaugoti
        </button>

        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
            ⬅ Atgal
        </a>
    </form>

</div>
@endsection
