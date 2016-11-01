<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
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
                        <td>{{ $rank['name'] }}</td>
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
