@extends('layouts.master')

@section('content')
<h1>{{ $username }}</h1>
<p>
    <a href="{!! action('DashboardController@index') !!}">back to overview</a>
</p>

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
@endsection