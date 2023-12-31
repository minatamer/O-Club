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
                <a class="nav-link " href="http://127.0.0.1:8000/admin/manageusers">Manage Users</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link " href="http://127.0.0.1:8000/admin/manageprojectsandservices" >Manage Projects/Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href= "http://127.0.0.1:8000/admin/managebriefs">Manage Briefs</a>
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
                <a class="nav-link" href="{{ route('signOut') }}">Sign Out</a>
            </li>
        </ul>
    </div>
</nav>
<br>

<h3 style="color: white; border-style: solid;">List of all the Briefs: </h3>
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
    <div style="width:20%; float:left;">
  <div class="card">
       <div class="card-header">Approve Brief</div>
        <div class="card-body">
          <form action="{{route('approveBrief-Admin')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="briefID">Brief ID</label>
                            <input type="text" name="briefID" id="briefID" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Approve</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:20%; position:relative; left:20px; float:left; ">
  <div class="card">
       <div class="card-header">Deny Brief <br>(Note: You will have to manually cancel the corresponding Calendly event)</div>
        <div class="card-body">
          <form action="{{route('denyBrief-Admin')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="briefID2">Brief ID</label>
                            <input type="text" name="briefID2" id="briefID2" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Deny</button>
                    </form>
                </div>
            </div>
</div>





</body>


</html>