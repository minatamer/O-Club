<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>User</title>
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
          color: white;
        }
        </style>
        

    </head>
    <body>
    
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" >Welcome {{ session('username') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item ">
                <a class="nav-link " href="http://127.0.0.1:8000/user">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000/user/projectsandservices">Projects and Services</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link active" href="http://127.0.0.1:8000/user/bookameeting">Book a Meeting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000/user/moneytransaction">Money Transaction</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000/user/financialhistory">Financial History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000/user/benefits">Benefits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000/user/problem">Report Problem</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000/user/feedback">Report Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000">Sign Out</a>
            </li>
            
        </ul>
    </div>
</nav>
<br>
<h3>To book a meeting with the team you will need to fill the following spaces to fill a brief and then book a meeting using calendly 
    and the team will either accept/reject your brief.
</h3>
<br> 


<div class="meeting-details" id="meeting-details">
<form action="{{ route('submitMeeting') }}" method="post">
    {{csrf_field()}}
        <div class="form-group">
            <label for="datetime">Date and Time</label>
            <input type="datetime-local" class="form-control col-md-3" id="datetime" name="datetime" required>
        </div>

        <div>
        <label for="dropdown">Type name of a Project/Service from the following choices:</label>
        <!-- Dropdown Menu -->
        <select id="dropdown" name="dropdown">
        @foreach ($projects as $project)
            <option value="option">{{$project->name}}</option>
        @endforeach
            <!-- You can add more options here -->
        </select>
    </div>

            <input type="text" class="form-control col-md-3" id="project" name="project" required>


    
   

        <div class="form-group">
            <label for="projectSummary">Project Summary (check the Projects and Services tab)</label>
            <textarea class="form-control col-md-3" id="projectSummary" name="projectSummary" rows="5" placeholder="Enter your project summary" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        
    </form>
</div>
    

    </body>

 

</html>