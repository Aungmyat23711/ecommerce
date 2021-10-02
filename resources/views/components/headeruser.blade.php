<!DOCTYPE html>
<head>
    <title>User Header</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class='bg-white'>
    <div >
<nav class="navbar navbar-expand-lg navbar-light " style='background:lightblue;'>
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Features</a>
      <a class="nav-item nav-link" href="#">Pricing</a>
      @if(Session::has('user'))
      <a class="nav-item nav-link" href="/logoutuser">Logout</a>
      <a class="nav-item nav-link" href="/myorder">Order</a>
      @else
      <a class="nav-item nav-link" href="/loginuser">Login</a>
      <a class="nav-item nav-link" href="/viewregistery">Registeration</a>
      @endif
      <?php
      use App\Http\Controllers\indexcontroller;
      $total=0;
      if(Session::has('user'))
      {
         $total=indexcontroller::cartItem();
      }
      ?>
     
    </div>
  </div>
  <form class="form-inline">
     <a class="nav-item nav-link" href='/cartlist'><h5 style='padding-top:10px;'><i class='fas fa-shopping-cart'></i>
     <span class='badge badge-light'>{{$total}}</span></h5>
    </a>
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav> 
</div>

<div class='container' style='padding-top:50px;'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='card' style='background:linear-gradient(lightblue,white)'>
            <h1 class='text-center'><span >Hello
                @if(Session::has('user'))
                {{Session::get('user')['name']}}
                @else
                {{Session::get('')}}
                @endif
                </span></h1>
            </div>
        </div>
    </div>
    </div><br><br><br>
</body>
</html>