@extends('layouts.master')

@section('content')
<table class="table">
    <thead>
    <tr>
        <th>Mitglied</th>
        <th>Score</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ranking as $rank)
    <tr>
        <td><a href="{!! action('DashboardController@userDetail', ['username' => $rank->username]) !!}">{{ $rank->username }}</a></td>
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