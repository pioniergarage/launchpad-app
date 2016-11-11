<section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset('/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>Frederic Tausch</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="header">Hauptmenü</li>
        <!-- Optionally, you can add icons to the links -->
        <li>
            <a href="{{ asset('/') }}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{!! action('OpeningTimeController@index') !!}">
                <i class="fa fa-clock-o"></i>
                <span>Öffnungszeiten</span>
            </a>
        </li>
        <!-- external links -->
        <li class="header">Externe Links</li>
        <li>
            <a href="https://github.com/pioniergarage/launchpad-app" target="_blank">
                <i class="fa fa-external-link"></i>
                <span>Launchpad App auf Github</span>
            </a>
        </li>
        <li>
            <a href="https://pioniergarage.de/launchpad" target="_blank">
                <i class="fa fa-external-link"></i>
                <span>Offizielle Launchpad-Seite</span>
            </a>
        </li>
        <li>
            <a href="https://pioniergarage.de" target="_blank">
                <i class="fa fa-external-link"></i>
                <span>PionierGarage</span>
            </a>
        </li>
        <li>
            <a href="https://goo.gl/maps/5XKF2QPHTpL2" target="_blank">
                <i class="fa fa-external-link"></i>
                <span>Anfahrt</span>
            </a>
        </li>
    </ul>
    <!-- /.sidebar-menu -->
</section>