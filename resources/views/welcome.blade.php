<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
        <a class="navbar-brand" href="#">Launchpad App</a>
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </nav>

        <div class="container" style="margin-top: 75px">
            <div class="content">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Mitglied</th>
                        <th>Score</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ranking as $rank)
                    <tr>
                        <td>{{ $rank['username'] }}</td>
                        <td>{{ $rank['score'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <hr>

                <form method="post">
                    {!! csrf_field() !!}
                    <textarea title="Nachricht" name="message" class="form-control"></textarea>
                    <button type="submit" class="btn btn-primary">Speichern</button>
                </form>
            </div>
        </div>
    </body>
</html>
