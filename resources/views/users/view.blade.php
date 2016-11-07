@extends('layouts.master')

@section('title', $user->getName())
@section('subtitle', 'User detail')

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li>Users</li>
        <li class="active">{{ $user->getName() }}</li>
    </ol>
@endsection

@section('content')
    <h1>{{ $user->getName() }}</h1>
    <p>
        <a href="{!! action('DashboardController@index') !!}">back to overview</a>
    </p>

    <div class="row">
        <div class="col-md-5">
            <table class="table">
                <thead>
                <tr>
                    <th>Aktivität</th>
                    <th>Datum</th>
                </tr>
                </thead>
                <tbody>

                <?php
                    $data = array();
                    $score = array();
                    // create array
                ?>

                @foreach($user->receivedProps as $props)

                <?php
                    array_push($data, $props->created_at);
                    //save data to array
                    array_push($score, count($data));
                    // count array-length to get the current score
                ?>

                    <tr>
                        <td>{{ $props->activity }}</td>
                        <td>{{ $props->created_at }}</td>
                    </tr>
                @endforeach

                <?php dd($data); ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-7">
            <!-- Chart area -->
            @include('users.partials.chart')
        </div>
    </div>
@endsection