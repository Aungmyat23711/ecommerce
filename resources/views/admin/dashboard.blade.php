<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<x-header/>
<div class="container">
      <div class='row'> 
           <div class='col-md-4'>
            <div class='card'>
              <div class='card-header' style='background:linear-gradient(#6495ed,#00ffff);'>
              <span style='color:#4b0082;'><font size='6'><i class='fas fa-list'></i> Type</font><span>
              </div>

              <div class='card-footer' style='background:#e6e6fa;'>
              <a href='viewtype' style='text-decoration:none;color:white;'><button type="button" class="btn btn-primary">
  View Info <span class="badge badge-light">
        <?php
          $connection=mysqli_connect('localhost','root','','series');
          $query='select * from types';
          $go_query=mysqli_query($connection,$query);
          $num=mysqli_num_rows($go_query);
          echo $num;

        ?>
  </span>
  <span class="sr-only">unread messages</span>
</button></a>    
              </div>
             
            </div>

            </div>

           <div class='col-md-4'>
           <div class='card'>
              <div class='card-header' style='background:linear-gradient(#0000cd,#f5f5f5);'>
              <span><font size='6'><i class='fas fa-video'></i> Series</font><span>
              </div>

              <div class='card-footer bg-primary'>
              <a href='viewseriesurl' style='text-decoration:none;color:white;'><button type="button" class="btn btn-secondary">
  View Info <span class="badge badge-light">
        <?php
          $connection=mysqli_connect('localhost','root','','series');
          $query='select * from series';
          $go_query=mysqli_query($connection,$query);
          $num=mysqli_num_rows($go_query);
          echo $num;

        ?>
  </span>
  <span class="sr-only">unread messages</span>
</button>  </a>  
              </div>
             
            </div>
           </div>

           <div class='col-md-4'>
           <div class='card'>
              <div class='card-header' style='background:linear-gradient(#f4a460,#b0e0e6);'>
              <span><font size='6'><i class='fas fa-user'></i> Users</font><span>
              </div>

              <div class='card-footer bg-warning'>
              <a href='userurl' style='text-decoration:none;color:white'><button type="button" class="btn btn-info">
  View Info <span class="badge badge-light">
        <?php
          $connection=mysqli_connect('localhost','root','','series');
          $query='select * from types';
          $go_query=mysqli_query($connection,$query);
          $num=mysqli_num_rows($go_query);
          echo $num;

        ?>
  </span>
  <span class="sr-only">unread messages</span>
</button> </a>   
              </div>
             
            </div>
           </div>

      </div> 
</div>

</body>
</html>