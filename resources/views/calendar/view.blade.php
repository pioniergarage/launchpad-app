@extends('layouts.master')

@section('title', 'Reservierung')
@section('subtitle', '')

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Reservierung</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div width="100%" height="10%" style="padding-top: 7px; padding-bottom: 5px; background: #0190c3;">
                <h2 class="center">Raumreservierung Launchpad</h2>
                <p class="center">E-Mail: <b>reservations@pioniergarage.de</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Passwort: <b>reservation</b></p>
                <p class="center">(Nutze den Standardbenutzer um eine Reservierung vorzunehmen.)</p>
            </div>
            <iframe src="http://www.skedda.com/account/login?" width="100%" height="90%"></iframe>
        </div>
    </div>
@endsection