@extends('layouts.app')
@section('content')
<div class="container">
<h1>Ataskaita pagal periodą</h1>


<form method="GET" class="mb-3">
<input type="date" name="from" value="{{ $from }}">
<input type="date" name="to" value="{{ $to }}">
<button class="btn btn-primary">Filtruoti</button>
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
@foreach($transactions as $t)
<tr>
<td>{{ $t->date }}</td>
<td>{{ $t->category->name }}</td>
<td>{{ $t->amount }} €</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection