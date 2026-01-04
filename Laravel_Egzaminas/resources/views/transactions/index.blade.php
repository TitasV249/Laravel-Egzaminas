@extends('layouts.app')
@section('content')
<div class="container">
<h1>Įrašai</h1>
<a href="{{ route('transactions.create') }}" class="btn btn-primary mb-3">+ Naujas įrašas</a>


<table class="table table-bordered">
<thead>
<tr>
<th>Data</th>
<th>Kategorija</th>
<th>Suma</th>
<th>Aprašymas</th>
<th>Veiksmai</th>
</tr>
</thead>
<tbody>
@foreach($transactions as $transaction)
<tr>
<td>{{ $transaction->date }}</td>
<td>{{ $transaction->category->name }}</td>
<td>{{ $transaction->amount }} €</td>
<td>{{ $transaction->description }}</td>
<td>
<a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-warning">Redaguoti</a>
<form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display:inline">
@csrf @method('DELETE')
<button class="btn btn-sm btn-danger">Trinti</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection