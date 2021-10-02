
<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
</script>
</head>
<body>
  <?php ?>
<div style='position:fixed;overflow:hidden;'>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style='position:fixed;width:100%;'>
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  @if(Session::has('admin'))
  <div class="collapse navbar-collapse" id="navbarNav"> 
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">Dashboard </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/viewtype">Type</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/series">Series</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/viewseriesurl">List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="/userorder">Userorder</a>
      </li>
    </ul>
  </div>
  <form class="form-inline">
  <ul class="navbar-nav">
  <a class="nav-link " href="logout">Logout</a>
  <a class="nav-link " href="vpn">VPN</a>
  </ul>
  </form>
  @else
  <div class="collapse navbar-collapse" id="navbarNav"> 
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Dashboard </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Type</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Series</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="#">List</a>
      </li>
      
    </ul>
  </div>
  <form class="form-inline">
  <ul class="navbar-nav">
  <a class="nav-link " href="login">Login</a>
  <a class="nav-link " href="useradd">Registeration</a>
  </ul>
  </form>
@endif
</nav></div>
<br><br>
    <div class='container' style='padding-top:50px;'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='card' style='background:linear-gradient(lightblue,white)'>
            <h1 class='text-center'><span >Hello
                @if(Session::has('admin'))
                {{Session::get('admin')['name']}}
                @else
                {{Session::get('')}}
                @endif
                </span></h1>
            </div>
        </div>
    </div>
    </div><br>
</body>
</html>
