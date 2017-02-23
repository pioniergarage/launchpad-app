@extends('layouts.master')

@section('title', 'Reservierung')
@section('subtitle', ' ')

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
                    <p class="center">E-Mail: <b>reservations@pioniergarage.de</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Passwort: <b>reservation</b></p>
                    <p class="center">(Nutze den Standardbenutzer um eine Reservierung vorzunehmen.)</p>
                    <div>
                        <iframe onload="iframeLoaded()" id="reservation-frame" src="http://www.skedda.com/account/login?" width="100%" height="90%" height: 100%; border: none"></iframe>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <script>
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
@endsection