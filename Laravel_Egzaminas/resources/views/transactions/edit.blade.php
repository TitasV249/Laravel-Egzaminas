@extends('layouts.app')
@section('content')
<div class="container">
<h1>Redaguoti įrašą</h1>
<form method="POST" action="{{ route('transactions.update', $transaction) }}">
@csrf @method('PUT')
<div class="mb-3">
<label>Kategorija</label>
<select name="category_id" class="form-control">
@foreach($categories as $category)
<option value="{{ $category->id }}" @selected($transaction->category_id == $category->id)>
{{ $category->name }} ({{ $category->type }})
</option>
@endforeach
</select>
</div>
<div class="mb-3">
<label>Suma</label>
<input type="number" step="0.01" name="amount" value="{{ $transaction->amount }}" class="form-control">
</div>
<div class="mb-3">
<label>Data</label>
<input type="date" name="date" value="{{ $transaction->date }}" class="form-control">
</div>
<div class="mb-3">
<label>Aprašymas</label>
<textarea name="description" class="form-control">{{ $transaction->description }}</textarea>
</div>
<button class="btn btn-success">Atnaujinti</button>
</form>
</div>
@endsection