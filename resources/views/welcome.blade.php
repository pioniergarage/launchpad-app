@extends('layouts.master')

@section('title', 'Dashboard')
@section('subtitle', 'Everything at a glance')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-clock-o"></i>
                    <h3 class="box-title">Öffnungszeiten</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                    @if(\App\OpeningTime::getLast() && \App\OpeningTime::getLast()->isOpen())
                        <p class="text-success">
                            Das Launchpad ist geöffnet seit {{ \App\OpeningTime::getLast()->open_at->toTimeString() }}
                        </p>
                        <img class="" src="/img/status/open.png" alt="Launchpad ist geöffnet">
                    @else
                        <p class="text-danger">
                            Das Launchpad ist geschlossen seit {{ \App\OpeningTime::getLast()->close_at->toTimeString() }}
                        </p>
                        <img class="img-responsive" src="/img/status/closed.png" alt="Launchpad ist geschlossen">
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-table"></i>
                    <h3 class="box-title">Ranking</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
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
                <!-- /.box-body -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-text-width"></i>

                    <h3 class="box-title">Die letzten Props</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul>
                        @foreach($props as $prop)
                            <li>
                                {{ $prop->receiver->real_name }}<br>
                                <small>{{ $prop->activity }} ({{ $prop->created_at->diffForHumans() }})</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>


    <hr>
    <p>
        <a class="btn btn-primary" href="{!! action('DashboardController@slack') !!}">
            Rankings aus Slack importieren
        </a>
    </p>
@endsection