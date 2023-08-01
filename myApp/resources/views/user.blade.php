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
          
        }
        </style>

    </head>
    <body>
    
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" >Welcome {{ session('username') }} </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item ">
                <a class="nav-link active" href="http://127.0.0.1:8000/user/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://127.0.0.1:8000/user/projectsandservices">Projects and Services</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="http://127.0.0.1:8000/user/bookameeting">Book a Meeting</a>
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
                <a class="nav-link" href="http://127.0.0.1:8000/">Sign Out</a>
            </li>
        </ul>
    </div>
</nav>
<br>

    <h3 style="color: white; border-style: solid;">Your Slots & Projects: </h3>
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
    <h3 style="color: white; border-style: solid;">Manage your Slots:</h3>

    <div style="width:30%; ">
  <div class="card">
       <div class="card-header">Cancel a slot </div>
        <div class="card-body">
          <form action="{{ route('cancelSlot') }}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="slot">Type the id of the slot that you want to cancel</label>
                            <input type="text" name="slot" id="slot" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Cancel Slot</button>
                    </form>
                </div>
            </div>
            <div style=" position:relative">
  <div class="card">
       <div class="card-header">Edit a Slot's Brief/Description</div>
        <div class="card-body">
          <form action="{{ route('editSlot') }}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="slotID">Type Slot ID</label>
                            <input type="text" name="slotID" id="slotID" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="newDescription">New Description:</label>
                            <textarea class="form-control" id="newDescription" name="newDescription" rows="4" placeholder="Your new Description" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
</div>
</div>


<br>
    <h3 style="color: white; border-style: solid;">Your Profile: </h3>
    <div class="card" style="width: 30rem;">
  <div class="card-header">
    Your Profile:
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Username:  {{ session('username') }}</li>
    @foreach ($users as $user)
    <li class="list-group-item">Password: {{$user->password}}</li>
    <li class="list-group-item">Email: {{$user->email}} </li>
    <li class="list-group-item">Mobile: {{$user->mobile}} </li>
    <li class="list-group-item">Manager:  {{$user->manager}}</li>
    @endforeach
  </ul>

  
</div>
<br>
<h3 style="color: white; border-style: solid;">Settings: </h3>
 <div style="width:30%; float:left; ">
  <div class="card">
       <div class="card-header">Change Password</div>
        <div class="card-body">
          <form action="{{ route('changePassword') }}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:30%; float:left; ">
  <div class="card">
       <div class="card-header">Change/Put Mobile Number</div>
        <div class="card-body">
          <form action="{{ route('changeMobile') }}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="mobile">Mobile Number</label>
                            <input type="text" name="mobile" id="mobile" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
</div>




    </body>


</html>