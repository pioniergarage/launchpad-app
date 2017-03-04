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
    <!-- form customization -->
    <link rel="stylesheet" href="{{ asset('/dist/css/form_style.css') }}">
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
                       <div>
                           <a href="#" id="opener"><button type="button" class="btn btn-block btn-danger reservation-btn">Hier reservieren</button></a>
                       </div>

                        <div>
                            <iframe id="reservation-frame" src="https://pioniergarage.skedda.com/booking" width="100%" height="100%"></iframe>
                        </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div id="lightbox" class="row form-lightbox">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">Reservierungsanfrage</h3>
                </div>
                <div class="box-body">

                    <!-- error log -->
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    {{ Form::open(array('route' => 'reservation-request', 'class' => 'form')) }}

                        <!-- CSRF Protection -->
                        <?php echo Form::token(); ?>

                        <!-- name -->
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null,
                                array('class'=>'form-control',
                                      'placeholder'=>'Bitte gib Deinen Namen ein',
                                      'id' => 'name')) !!}
                        </div>
                        <!-- mail address -->
                        <div class="form-group">
                            {!! Form::label('mail', 'Mail') !!}
                            {!! Form::email('mail', null,
                                array('class'=>'form-control',
                                      'placeholder'=>'Bitte gib Deine Mail-Adresse ein',
                                      'id' => 'mail')) !!}
                        </div>

                        <!-- choice of space-->
                        <div class="form-group">
                            {!! Form::label('choiceOfSpace', 'Raumwahl') !!}

                            {!! Form::select('choiceOfSpace',
                                array('R1' => 'Konferenzraum',
                                        'R2' => 'Tisch 1 - Coworking Space',
                                        'R3' => 'Tisch 2 - Coworking Space',
                                ),
                                'R1',
                                array('class' => 'form-control select2 select2-hidden-accessible',
                                        'id' => 'choiceOfSpace',
                                        'style' => 'width: 100%;',
                                        'tabindex' => '-1',
                                        'aria-hidden' => 'true'
                                )
                            )  !!}
                        </div>

                        <!-- Date -->
                        <div class="form-group">
                            {!! Form::label('reservationdate', 'Datum') !!}

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!! Form::text('reservationdate', null,
                                array('class'=>'form-control pull-right',
                                      'id' => 'reservationdate')) !!}
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <div class="col-sm-6 form-input-field-left">
                            <!-- starting time -->
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    {!! Form::label('startingtime', 'Von') !!}

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        {!! Form::text('startingtime', null,
                                        array('class'=>'form-control',
                                            'id' => 'startingtime')) !!}
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                        </div>

                        <div class="col-sm-6 form-input-field-right">
                            <!-- end time -->
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    {!! Form::label('endtime', 'Bis') !!}

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        {!! Form::text('endtime', null,
                                           array('class'=>'form-control',
                                            'id' => 'endtime')) !!}
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('additional-information', 'Weitere Amerkungen') !!}

                            {!! Form::textarea('additional-information', null,
                                   array('class'=>'form-control',
                                    'id' => 'additional-information',
                                    'size' => '1x2',
                                    'placeholder' => 'Hier ist Platz f&uuml;r Anmerkungen ...',
                                    'style' => 'resize: vertical;')) !!}
                        </div>

                        <!-- button -->
                        {!! Form::submit('Absenden',
                                   array('class'=>'btn btn-block btn-danger',
                                    'style' => 'font-weight: bold;')) !!}

                        {{ Form::close() }}
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
            autoclose: true,
            format: 'dd.mm.yyyy',
            language : "de",
            todayHighlight : true,
            weekStart : 1,
            todayBtn: true,
            startDate: new Date(),
        });

        //Timepicker
        $("#startingtime").timepicker({
            showInputs: false,
            showMeridian: false,
        });
        $("#endtime").timepicker({
            showInputs: false,
            showMeridian: false,
        });
    });
</script>
<script>
    //form popup script

    var opener = document.getElementById("opener");

    opener.onclick = function(){

        var lightbox = document.getElementById('lightbox'),
            dimmer = document.createElement("div");

        dimmer.style.height = window.innerHeight + 'px';
        dimmer.className = 'dimmer';

        dimmer.onclick = function(){
            document.body.removeChild(this);
            lightbox.style.visibility = 'hidden';
        }

        document.body.appendChild(dimmer);

        lightbox.style.visibility = 'visible';

        setFormPosition();


        return false;
    }

    function setFormPosition() {

        var lightbox = document.getElementById('lightbox');

        var lightbox_width = window.innerWidth*0.8;

        lightbox.style.width = lightbox_width + 'px';
        lightbox.style.marginLeft = -lightbox_width/2 + 'px';

        //lightbox.style.marginTop = -lightbox_width/2 + 'px';

    }

    //resize lightbox when window is resized
    window.addEventListener('resize', setFormPosition);
</script>

@endsection