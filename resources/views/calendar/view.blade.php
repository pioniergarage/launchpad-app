@extends('layouts.master')

@section('title', 'Reservierung')
@section('subtitle', ' ')

@section('stylesheets')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/select2.min.css') }}">
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

                    <!-- choice of space-->
                    <div class="form-group">
                        <label>Raumwahl</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            <option selected="selected">Konferenzraum</option>
                            <option>Tisch 1 - Coworking Space</option>
                            <option>Tisch 2 - Coworking Space</option>
                            <option disabled="disabled">Coworking Space</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="form-group">
                        <label>Datum:</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="form-control pull-right" id="datepicker" type="text">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>Zeitraum:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input class="form-control pull-right" id="reservationtime" type="text">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->


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
<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });



        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
</script>

<!-- Select2 -->
<script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection