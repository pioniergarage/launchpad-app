@extends('layouts.master')

@section('content')
<h1>Launchpad Ranking</h1>
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

<h2 style="margin-top: 50px">Add new ranking</h2>
<form method="post">
    {!! csrf_field() !!}
    <textarea title="Nachricht" name="message" class="form-control" rows="10"></textarea>
    <p>
        <button type="submit" class="btn btn-primary form-control">Speichern</button>
    </p>
</form>
@endsection