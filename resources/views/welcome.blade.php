@extends('layouts.master')

@section('title', 'Dashboard')
@section('subtitle', 'Everything at a glance')

@section('content')
    @include('layouts.partials.autoreloadalert')

    <div class="row">
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
                                    <a href="{!! action('SlackUserController@show', ['user' => $rank->user]) !!}">
                                        {{ $rank->user->getName() }}
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

            <p class="text-muted">Das Ranking basiert auf allen Props seit Beginn der Launchpad-Zeitrechnung. Es zeigt die fleißigsten Helfer.</p>
        </div>

        <div class="col-md-4">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-star"></i>
                    <h3 class="box-title">Die letzten Props</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul>
                        @foreach($props as $prop)
                            <li>
                                {{ $prop->receiver->getName() }}<br>
                                <small>{{ $prop->activity }} ({{ $prop->created_at->diffForHumans() }})</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>

            <p class="text-muted">
                Um Arbeit zu würdigen im #general-Channel des Launchpad-Slack einfach <code>props @username Aufräumen</code> posten.
            </p>
        </div>

        <div class="col-md-4">
            @include('opening-times.partials.trafficlights')
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Autoreload feature -->
    <script>
        $(document).ready(function () {
            setInterval(function () {
                window.location.reload(false);
            }, 60000); // once per minute
        });
    </script>
@endsection