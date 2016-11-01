@extends('layouts.master')

@section('content')
<h1>{{ $username }}</h1>

<table class="table">
    <thead>
    <tr>
        <th>Datum</th>
        <th>Score</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rankings as $rank)
        <tr>
            <td>{{ $rank->created_at }}</td>
            <td>{{ $rank->score }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<hr>

<form method="post">
    {!! csrf_field() !!}
    <textarea title="Nachricht" name="message" class="form-control"></textarea>
    <button type="submit" class="btn btn-primary">Speichern</button>
</form>
@endsection