<div class="box box-solid">
    <div class="box-header with-border">
        <i class="fa fa-clock-o"></i>
        <h3 class="box-title">Öffnungszeiten</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body text-center">
        @if(\App\OpeningTime::getLast() && \App\OpeningTime::getLast()->isOpen())
            <p class="text-success">
                Das Launchpad ist seit {{ \App\OpeningTime::getLast()->open_at->format('H:i') }} Uhr geöffnet.
            </p>
            <p>
                <a href="{!! action('DoorController@changeStatus') !!}" class="btn btn-default">schließen</a>
            </p>
            <img class="" src="/img/status/open.png" alt="Launchpad ist geöffnet">
        @else
            <p class="text-danger">
                Das Launchpad ist seit {{ \App\OpeningTime::getLast()->close_at->format('H:i') }} Uhr geschlossen.
            </p>
            <p>
                <a href="{!! action('DoorController@changeStatus') !!}" class="btn btn-default">öffnen</a>
            </p>
            <img class="" src="/img/status/closed.png" alt="Launchpad ist geschlossen">
        @endif
    </div>
    <!-- /.box-body -->
</div>

<p class="text-muted">
    Öffnungszeiten werden mithilfe des Klickers am Eingang festgestellt. Ist die Tür offen, aber die Ampel rot? Geh zum Klicker und zeige anderen, dass offen ist.
</p>