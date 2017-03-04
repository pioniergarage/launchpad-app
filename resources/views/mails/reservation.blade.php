<h2>E-Mail von der LaunchpadApp erhalten!</h2>
<h3>Neue Reservierungsanfrage</h3>

<p>
    Name: {{ $Name }}<br>
    Mail: {{ $Mail }}<br>
    Raum:
    <?php if($Raum == 'R1'){
        echo 'Konferenzraum';
    }elseif ($Raum == 'R2'){
        echo 'Tisch 1 - Coworking Space';
    }elseif ($Raum == 'R3'){
        echo 'Tisch 2 - Coworking Space';
    }else{
        echo 'Raumfehler';
    }?>
    <br>
    Datum : {{ $Datum }}<br>
    Von: {{ $Von }}<br>
    Bis: {{ $Bis }}<br>
    Anmerkungen: {{ $Anmerkungen }}
</p>
