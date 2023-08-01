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
<div class="home-title">
        <h1 class="mb-3">O-club</h1>
        <h4>Affiliate Marketing Project</h4>
    </div>
<br>
<br>

    <h3 style="color:white; text-align:center">Forgot Password</h3>
    <h4 style="color:white;">Simply enter your email associated with your account and press submit. You will be sent an email 
        with a temporary password that you can sign in right away with and then change it whenever you want.
    </h4>

    <div style="width:30%; float:left; left:35%; position:relative; ">
  <div class="card">
       <div class="card-header">Enter Email</div>
        <div class="card-body">
          <form action="{{ route('getTempPassword') }}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Get code</button>
                    </form>
                </div>
            </div>
</div>


</body>
   

</html>
