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
                <a class="nav-link active" href="http://127.0.0.1:8000/admin/manageprojectsandservices" >Manage Projects/Services</a>
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
                <a class="nav-link" href="{{ route('signOut') }}">Sign Out</a>
            </li>
        </ul>
    </div>
</nav>
<br>

<h3 style="color: white; border-style: solid;">All the Projects/Services: </h3>
@foreach ($projects as $project)
<div class="container mt-5">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Name: {{$project->name}}  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Project ID: {{$project->prod_id}} </h5>
      <p class="card-text">{{$project->description}}</p>
    </div>
  </div>
</div>
@endforeach
    <div style="width:20%;  ">
  <div class="card">
       <div class="card-header">Add Project</div>
        <div class="card-body">
          <form action="{{route('addProject-Admin')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label> 
                            <input type="text" rows="4" name="description" id="description" class="form-control" required>
                        </div>


                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:20%; ">
  <div class="card">
       <div class="card-header">Delete Project</div>
        <div class="card-body">
          <form action="{{route('deleteProject-Admin')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="projID">Project ID</label>
                            <input type="text" name="projID" id="projID" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:40%;">
  <div class="card">
       <div class="card-header">Edit Project</div>
        <div class="card-body">
          <form action="{{route('editProject-Admin')}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                            <label for="projID">Project ID</label>
                            <input type="text" name="projID" id="projID" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">New Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">New Description</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
</div>





</body>


</html>