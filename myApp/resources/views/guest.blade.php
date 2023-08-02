<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('{{ asset('background2.png') }}');
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
    <h1 style="color: white; text-align:center">Want to be part of the Affiliate Marketing Program?</h1>
    <h3 style="color: white; text-align:center">Fill out the details below to become a user</h3>

            <div class="col-md-5" style="text-align:center; position=relative; left:30%">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Request an Account</h5>
                    </div>
                    <div class="card-body">
                    <form method="post" action="{{route('saveUserAccount')}}">
                    {{csrf_field()}}
                    <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>
        <br>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>
        <br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <br>

        <button type="submit">Submit</button>
    </form>
                    </div>
                </div>
            </div>
   
</body>
</html>