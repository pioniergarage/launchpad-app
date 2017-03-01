@extends('layouts.master')

@section('title', 'Reservierung')
@section('subtitle', ' ')

@section('stylesheets')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset('/plugins/timepicker/bootstrap-timepicker.min.css') }}">
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Reservierung</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                        <div class="col-md-6 col-lg-4">
                            E-Mail: <b>reservations@pioniergarage.de</b>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            Passwort: <b>reservation</b>
                        </div>
                        <div class="col-sm-12" style="padding-bottom: 20px;">
                            (Nutze den Standardbenutzer um eine Reservierung vorzunehmen.)
                        </div>
                        <div>
                            <iframe id="reservation-frame" src="http://www.skedda.com/account/login?" width="100%" height="100%"></iframe>
                        </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">Reservierungsanfrage</h3>
                </div>
                <div class="box-body">

                    <!-- name -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input class="form-control" id="name" placeholder="Bitte gib Deinen Namen ein" type="text">
                    </div>
                    <!-- mail address -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mail</label>
                        <input class="form-control" id="mail" placeholder="Bitte gib Deine Mail-Adresse ein" type="email">
                    </div>

                    <!-- choice of space-->
                    <div class="form-group">
                        <label>Raumwahl</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="selected">Konferenzraum</option>
                            <option>Tisch 1 - Coworking Space</option>
                            <option>Tisch 2 - Coworking Space</option>
                            <option disabled="disabled">Coworking Space (nicht komplett reservierbar)</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="form-group">
                        <label>Datum:</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="form-control pull-right" id="reservationdate" type="text">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- time Picker -->
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Time picker:</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input id="startingtime" type="text" class="form-control">

                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<!-- Select2 -->
<script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<script>
    // adjust iframe
    var buffer = 20; //scroll bar buffer
    var iframe = document.getElementById('reservation-frame');

    function pageY(elem) {
        return elem.offsetParent ? (elem.offsetTop + pageY(elem.offsetParent)) : elem.offsetTop;
    }

    function resizeIframe() {
        var height = document.documentElement.clientHeight;
        height -= pageY(document.getElementById('reservation-frame'))+ buffer ;
        height = (height < 0) ? 0 : height;
        document.getElementById('reservation-frame').style.height = height + 'px';
    }

    // .onload doesn't work with IE8 and older.
    if (iframe.attachEvent) {
        iframe.attachEvent("onload", resizeIframe);
    } else {
        iframe.onload=resizeIframe;
    }

    window.onresize = resizeIframe;

</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        $('#reservationdate').datepicker({
            autoclose: true
        });

        //Timepicker
        $("#startingtime").timepicker({
            showInputs: false,
            showMeridian: false,
        });
        $("#endtime").timepicker({
            showInputs: false
        });
    });
</script>

@endsection