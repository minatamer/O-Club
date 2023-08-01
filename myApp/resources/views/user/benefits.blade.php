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
                <a class="nav-link " href="http://127.0.0.1:8000/user">Home</a>
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
                <a class="nav-link active" href="http://127.0.0.1:8000/user/benefits">Benefits</a>
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
<br> 

<h3 style="color: white;">Your Benefits: </h3>
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

    <div style="width:30%; float:left;">
  <div class="card">
       <div class="card-header">Redeem a Benefit: </div>
        <div class="card-body">
          <form action="{{ route('redeemBenefit') }}" method="post">
                    {{csrf_field()}}

                        <div class="form-group">
                            <label for="benefit">Type the id of the benefit you want</label>
                            <input type="text" name="benefit" id="benefit" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Redeem</button>
                    </form>
                </div>
            </div>
</div>
    

    </body>


</html>