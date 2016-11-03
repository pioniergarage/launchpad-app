@extends('layouts.master')

@section('content')
    <h1>Launchpad Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            @if(\App\OpeningTime::getLast() && \App\OpeningTime::getLast()->isOpen())
                <p class="text-success">
                    Das Launchpad ist geöffnet seit {{ \App\OpeningTime::getLast()->created_at->toTimeString() }}
                </p>
                <img class="img-responsive" src="/img/status/open.png" alt="Launchpad ist geöffnet">
            @else
                <img class="img-responsive" src="/img/status/closed.png" alt="Launchpad ist geschlossen">
            @endif
        </div>
        <div class="col-md-4">
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


    <hr>
    <p>
        <a class="btn btn-primary" href="{!! action('DashboardController@slack') !!}">
            Rankings aus Slack importieren
        </a>
    </p>
@endsection