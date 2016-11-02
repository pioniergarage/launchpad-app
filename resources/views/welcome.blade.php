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
        <td>
            <a href="{!! action('DashboardController@userDetail', ['username' => $rank->username]) !!}">
                {{ \App\SlackUser::find($rank->username)->name }}
            </a>
        </td>
        <td>{{ $rank->score }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection