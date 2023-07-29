<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>O-Club</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        

    </head>
    <body>
    
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">O-Club</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="bookameeting">Book a Meeting</a>
            </li>
        </ul>
    </div>
</nav>
<br>
<br> 
<div class="meeting-details" id="meeting-details">
<form action="{{ route('submitMeeting') }}" method="post">
    {{csrf_field()}}
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control col-md-3" id="username" name="username" placeholder="Enter your username" >
        </div>

        <div class="form-group">
            <label for="datetime">Date and Time</label>
            <input type="datetime-local" class="form-control col-md-3" id="datetime" name="datetime">
        </div>

        <div class="form-group">
            <label for="projectSummary">Project Summary</label>
            <textarea class="form-control col-md-3" id="projectSummary" name="projectSummary" rows="5" placeholder="Enter your project summary"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        
    </form>
</div>
    

    </body>


</html>