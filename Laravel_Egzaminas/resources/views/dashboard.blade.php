@extends('layouts.app')
@section('content')
<div class="container">
<h1>Finansų suvestinė</h1>
<div class="row">
<div class="col">Pajamos: <b>{{ $income }} €</b></div>
<div class="col">Išlaidos: <b>{{ $expense }} €</b></div>
<div class="col">Likutis: <b>{{ $balance }} €</b></div>
</div>
</div>
@endsection