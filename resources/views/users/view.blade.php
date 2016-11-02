@extends('layouts.master')

@section('content')
<h1>{{ $user->name }}</h1>
<p>
    <a href="{!! action('DashboardController@index') !!}">back to overview</a>
</p>

<table class="table">
    <thead>
    <tr>
        <th>Aktivität</th>
        <th>Datum</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user->receivedProps as $props)
        <tr>
            <td>{{ $props->activity }}</td>
            <td>{{ $props->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection