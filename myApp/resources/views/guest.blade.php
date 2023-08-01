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
    
</head>
<body>
    <h1>Want to be part of the Affiliate Marketing Program?</h1>
    <h3>Fill out the details below to become a user</h3>
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

   
</body>
</html>