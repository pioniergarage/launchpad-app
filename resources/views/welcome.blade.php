@extends('layouts.master')

@section('content')
    <h1>Launchpad Dashboard</h1>
    <h2>Das aktuelle Ranking</h2>

    <div class="row">
        <div class="col-md-8">
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
                            <a href="{!! action('DashboardController@userDetail', ['id' => $rank->user->id]) !!}">
                                {{ $rank->user->name }}
                            </a>
                        </td>
                        <td>{{ $rank->score }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            Die letzten Props:
            <ul>
            @foreach($props as $prop)
                <li>
                    {{ $prop->receiver->real_name }}<br>
                    <small>{{ $prop->activity }} ({{ $prop->created_at->diffForHumans() }})</small>
                </li>
            @endforeach
            </ul>
        </div>
    </div>

    <p>
        <a class="btn btn-primary" href="{!! action('DashboardController@slack') !!}">
            Import from Slack
        </a>
    </p>
@endsection