<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>O-Club</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <style>
        body {
          background-image: url('background2.png');
          background-repeat: no-repeat;
          background-size: cover;
          background-color: grey;
        }
        </style>

    </head>

    <body>


<body>
<div class="home-title">
        <h1 class="mb-3">O-club</h1>
        <h4>Affiliate Marketing Project</h4>
    </div>

<div class="about-us">
    <h3>O-club helps affiliates to earn a commission for marketing our products
     or services. The affiliate simply contacts us, then promotes the product and
     earns a piece of the profit from each sale they make including various benefits.</h3>

    </div>

    <div class="container mt-2" >
        <div class="login" >
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Login</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-secondary">Login</button>
                                <a href="#" class="btn btn-link">Forgot Password</a>
                                <a href="#" class="btn btn-link">Not a user?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
   
    </body>
</html>
