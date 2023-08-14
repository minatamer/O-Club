<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Super Admin</title>
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
    <a class="navbar-brand" >Super Admin Console </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item ">
                <a class="nav-link " href="http://127.0.0.1:8000/superadmin">Team Calendar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="http://127.0.0.1:8000/superadmin/manageusers">Manage Users</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="http://127.0.0.1:8000/superadmin/manageadmins" >Manage Admins</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="http://127.0.0.1:8000/superadmin/manageprojectsandservices" >Manage Projects/Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href= "http://127.0.0.1:8000/superadmin/managebriefs">Manage Briefs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href= "http://127.0.0.1:8000/superadmin/manageaccountmanagers">Manage AccountManagers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href= "http://127.0.0.1:8000/superadmin/viewfeedback">View Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href= "http://127.0.0.1:8000/superadmin/viewproblems">View Problems</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('signOut') }}">Sign Out</a>
            </li>
        </ul>
    </div>
</nav>
<br>

<h3 style="color: white; border-style: solid;">List of all the Users: </h3>
    <div>
    <table class="table table-bordered bg-white">
  <thead>
    <tr>
      <th scope="col">user_id</th>
      <th scope="col">username</th>
      <th scope="col">password</th>
      <th scope="col">email</th>
      <th scope="col">mobile</th>
      <th scope="col">manager</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <td>{{$user->user_id}}</td>
      <td>{{$user->username}}</td>
      <td>{{Crypt::decrypt($user->password)}}</td>
      <td>{{Crypt::decrypt($user->email)}}</td> 
      <td>{{$user->mobile}}</td>
      <td>{{$user->manager}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>

    </div>
    <div style="width:20%; float:left; ">
  <div class="card">
       <div class="card-header">View User Data</div>
        <div class="card-body">
          <form action="{{route('viewUserData')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="userID">User ID</label>
                            <input type="text" name="userID" id="userID" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">View</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:20%; float:left; ">
  <div class="card">
       <div class="card-header">Add User</div>
        <div class="card-body">
          <form action="{{ route('addUser') }}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label> 
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:20%; float:left; ">
  <div class="card">
       <div class="card-header">Delete User</div>
        <div class="card-body">
          <form action="{{ route('deleteUser') }}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="userID2">User ID</label>
                            <input type="text" name="userID2" id="userID2" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:20%; float:left; ">
  <div class="card">
       <div class="card-header">Assign Manager to User</div>
        <div class="card-body">
          <form action="{{ route('assignManager') }}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="userID3">User ID</label>
                            <input type="text" name="userID3" id="userID3" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Manager Email</label>
                            <div>
        <label for="dropdown">Type email of a Manager from the following choices:</label>
        <!-- Dropdown Menu -->
        <select id="dropdown" name="dropdown">
        @foreach ($managers as $manager)
            <option value="option">{{$manager->email}}</option>
        @endforeach
            <!-- You can add more options here -->
        </select>
    </div>
                            <input type="text" name="managerEmail" id="managerEmail" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
</div>



</body>


</html>