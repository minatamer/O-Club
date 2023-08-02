<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin</title>
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
    
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" >Admin Console </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item ">
                <a class="nav-link " href="http://127.0.0.1:8000/admin">Team Calendar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="http://127.0.0.1:8000/admin/manageusers">Manage Users</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="http://127.0.0.1:8000/admin/manageprojectsandservices" >Manage Projects/Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href= "http://127.0.0.1:8000/admin/managebriefs">Manage Briefs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href= "http://127.0.0.1:8000/admin/manageaccountmanagers">Manage AccountManagers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href= "http://127.0.0.1:8000/admin/viewfeedback">View Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href= "http://127.0.0.1:8000/admin/viewproblems">View Problems</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000">Sign Out</a>
            </li>
        </ul>
    </div>
</nav>
<br>
<h3 style="color: white; border-style: solid;">User Profile: </h3>
    <div class="card" style="width: 30rem;">
  <div class="card-header">
    User Profile:
  </div>
  <ul class="list-group list-group-flush">
    @foreach ($users as $user)
    <li class="list-group-item">Username:  {{ $user->username}}</li>
    <li class="list-group-item">Password: {{$user->password}}</li>
    <li class="list-group-item">Email: {{$user->email}} </li>
    <li class="list-group-item">Mobile: {{$user->mobile}} </li>
    <li class="list-group-item">Manager:  {{$user->manager}}</li>
    @endforeach
  </ul>
</div>

<h3 style="color: white; border-style: solid;">User's Slots & Projects: </h3>
    <div>
    <table class="table table-bordered bg-white">
  <thead>
    <tr>
      <th scope="col">meeting_id</th>
      <th scope="col">project</th>
      <th scope="col">description</th>
      <th scope="col">date</th>
      <th scope="col">status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($briefs as $brief)
    <tr>
      <td>{{$brief->brief_id}}</td>
      <td>{{$brief->project}}</td>
      <td style="max-width: 150px; word-wrap: break-word;">{{$brief->description}}</td>
      <td>{{$brief->date}}</td> 
      <td>{{$brief->status}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>

    </div>

    <h3 style="color: white;">User's Benefits: </h3>
    <div>
    <table class="table table-bordered bg-white">
  <thead>
    <tr>
      <th scope="col">benefit_id</th>
      <th scope="col">name</th>
      <th scope="col">description</th>
      <th scope="col">redeemed</th>
      <th scope="col">user_id</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($benefits as $benefit)
    <tr>
      <td>{{$benefit->benefit_id}}</td>
      <td>{{$benefit->name}}</td>
      <td>{{$benefit->description}}</td>
      <td>{{$benefit->redeemed}}</td> 
      <td>{{$benefit->user_id}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>

    </div>

    <h3 style="color: white; border-style: solid;">Feedback from the User: </h3>
@foreach ($feedbacks as $feedback)
<div class="container mt-5">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Title: {{$feedback->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User ID: {{$feedback->user_id}} </h5>
      <p class="card-text">{{$feedback->description}}</p>
    </div>
  </div>
</div>
@endforeach
<br>

<h3 style="color: white; border-style: solid;">Problems reported the User: </h3>
@foreach ($problems as $problem)
<div class="container mt-5">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Title: {{$problem->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User ID: {{$problem->user_id}} </h5>
      <p class="card-text">{{$problem->description}}</p>
    </div>
  </div>
</div>
@endforeach

<br>
<h3 style="color: white;">User's Financial History: </h3>
    <div>
    <table class="table table-bordered bg-white">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">date</th>
      <th scope="col">amount</th>
      <th scope="col">sender</th>
      <th scope="col">receiver</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($senders as $sender)
    <tr>
      <td>{{$sender->id}}</td>
      <td>{{$sender->date}}</td>
      <td>{{$sender->amount}}</td>
      <td>{{$sender->sender}}</td> 
      <td>{{$sender->receiver}}</td>
    </tr>
    @endforeach
    @foreach ($receivers as $receiver)
    <tr>
      <td>{{$receiver->id}}</td>
      <td>{{$receiver->date}}</td>
      <td>{{$receiver->amount}}</td>
      <td>{{$receiver->sender}}</td> 
      <td>{{$receiver->receiver}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>

    </div>
    



</body>


</html>