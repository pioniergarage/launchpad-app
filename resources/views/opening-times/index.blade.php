@extends('layouts.master')

@section('title', 'Öffnungszeiten')
@section('subtitle', 'Wann war und ist das Launchpad offen?')

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ asset('/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Öffnungszeiten</li>
    </ol>
@endsection

@section('content')
    @include('layouts.partials.autoreloadalert')

    <div class="row">
        <div class="col-md-8">
            @foreach($openingTimes as $day => $daysOpeningTimes)
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-clock-o"></i>
                        <h3 class="box-title">{{ $day }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Offen</th>
                                <th>Dauer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($daysOpeningTimes as $oTime)
                                <tr>
                                    <td>{{ $oTime->open_at->format('H:i') }} - {{ $oTime->close_at ? $oTime->close_at->format('H:i') : 'noch offen'}}</td>
                                    <td>{{ $oTime->open_at->diffInHours($oTime->close_at) }}h</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            @endforeach
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