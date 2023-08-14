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
                <a class="nav-link " href="http://127.0.0.1:8000/superadmin/manageusers">Manage Users</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link active" href="http://127.0.0.1:8000/superadmin/manageadmins" >Manage Admins</a>
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
@if (session()->has('error'))
        <div class="alert alert-danger" role="alert">{{session()->get('error')}}  </div>
        @endif

<h3 style="color: white; border-style: solid;">List of all the Admins: </h3>
    <div>
    <table class="table table-bordered bg-white" id="adminTable" name="adminTable">
  <thead>
    <tr>
      <th scope="col">admin_id</th>
      <th scope="col">username</th>
      <th scope="col">password</th>
      <th scope="col">email</th>
      <th scope="col">mobile</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($admins as $admin)
    <tr>
      <td>{{$admin->admin_id}}</td>
      <td>{{$admin->username}}</td>
      <td>{{Crypt::decrypt($admin->password)}}</td>
      <td>{{Crypt::decrypt($admin->email)}}</td> 
      <td>{{$admin->mobile}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>

    </div>

<div >
    <div style="width:20%;  display: inline-block ">
        <div class="card">
       <div class="card-header">Add Admin</div>
        <div class="card-body">
          <form action="{{route('addAdmin')}}" method="post">
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
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Admin</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:20%;  display: inline-block ">
  <div class="card">
       <div class="card-header">Delete Admin</div>
        <div class="card-body">
          <form action="{{route('deleteAdmin')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="adminID">Admin ID</label>
                            <input type="text" name="adminID" id="adminID" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Delete Admin</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:40%;  display: inline-block">
  <div class="card">
       <div class="card-header">Edit Admin</div>
        <div class="card-body">
          <form action="{{route('editAdmin')}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                            <label for="adminID">Admin ID</label>
                            <input type="text" name="adminID2" id="adminID2" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">New Email</label>
                            <input type="text" name="newEmail" id="newEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">New Mobile</label>
                            <input type="text" name="newMobile" id="newMobile" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Admin</button>
                    </form>
                </div>
            </div>
        </div>
</div>


<br>
<br>

<h3 style="color: white; border-style: solid;">List of all the Super Admins: </h3>

<div>
    <table class="table table-bordered bg-white" id="superAdminTable">
  <thead>
    <tr>
      <th scope="col">superadmin_id</th>
      <th scope="col">username</th>
      <th scope="col">password</th>
      <th scope="col">email</th>
      <th scope="col">mobile</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($superadmins as $superadmin)
    <tr>
      <td>{{$superadmin->superadmin_id}}</td>
      <td>{{$superadmin->username}}</td>
      <td>{{Crypt::decrypt($superadmin->password)}}</td>
      <td>{{Crypt::decrypt($superadmin->email)}}</td> 
      <td>{{$superadmin->mobile}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>

    </div>
   

    <div >
    <div style="width:20%;  display: inline-block ">
        <div class="card">
       <div class="card-header">Add Super Admin</div>
        <div class="card-body">
          <form action="{{route('addSuperAdmin')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="superAdminUsername">Username</label>
                            <input type="text" name="superAdminUsername" id="superAdminUsername" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="superAdminPassword">Password</label> 
                            <input type="password" name="superAdminPassword" id="superAdminPassword" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="superAdminEmail">Email</label>
                            <input type="text" name="superAdminEmail" id="superAdminEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="superAdminMobile">Mobile</label>
                            <input type="text" name="superAdminMobile" id="superAdminMobile" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Super Admin</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:20%;  display: inline-block ">
  <div class="card">
       <div class="card-header">Delete Super Admin</div>
        <div class="card-body">
          <form action="{{route('deleteSuperAdmin')}}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="superadminID">Super Admin ID</label>
                            <input type="text" name="superadminID" id="superadminID" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Delete Super Admin</button>
                    </form>
                </div>
            </div>
</div>

<div style="width:40%;  display: inline-block">
  <div class="card">
       <div class="card-header">Edit Super Admin</div>
        <div class="card-body">
          <form action="{{route('editSuperAdmin')}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                            <label for="superadminID2">Super Admin ID</label>
                            <input type="text" name="superadminID2" id="superadminID2" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="newSuperAdminEmail">New Email</label>
                            <input type="text" name="newSuperAdminEmail" id="newSuperAdminEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="newSuperAdminMobile">New Mobile</label>
                            <input type="text" name="newSuperAdminMobile" id="newSuperAdminMobile" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Super Admin</button>
                    </form>
                </div>
            </div>
        </div>
</div>




</body>


</html>