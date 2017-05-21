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
    <div class="alert alert-info">
        <strong>Hier</strong>
        kannst du Teile des Launchpads für dich Reservieren. Dabei hast du die Möglichkeit, bis zu zwei Tische im Coworking Space oder den Konferenzraum für bis zu 4 Stunden zu reservieren. Ab 17.00 Uhr kannst du zusätzlich den kompletten Coworking Space reservieren.
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body">
                        <div>
                            <iframe id="reservation-frame" src="https://pioniergarage.skedda.com/" width="100%" height="100%"></iframe>
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

        //iframe min height 700px
        if(height < 700){
            height = 700;
        }else{
            height = height;
        }

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