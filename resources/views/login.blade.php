<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@4.4.0/dist/css/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default ">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ route('login') }}">
                            @csrf
                            <fieldset>
                                <a href="{{ route('google.login') }}" class="btn btn-danger btn-block">
                                    Login with Google</a>
                                <a href="{{ route('github.login') }}" class="btn btn-primary btn-block">
                                    Login with GitHub</a> <br>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="email" type="email"
                                        autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password"
                                        value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Submit</button><br>
                                <a href="{{ route('registeration') }}" class="btn btn-info btn-block">Register Here</a><br>

                                <!-- Google -->

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
