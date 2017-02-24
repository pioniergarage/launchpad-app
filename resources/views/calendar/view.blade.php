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
@endsection

@section('scripts')
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
@endsection