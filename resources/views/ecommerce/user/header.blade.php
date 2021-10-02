
<nav class="navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/userinterface">Home</a>
        </li>
        @if(Session::has('user'))
        <li class="nav-item">
          <a class="nav-link" href="/logoutform">logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/showorderlist">myorder</a>
        </li>
        @else
        <li class="nav-item ">
            <a class="nav-link" href="/loginform">login</a>
        </li>
        @endif
      </ul>
      <div style="margin-right:20px;">
        <?php 
        use App\Http\Controllers\ecommercecontroller;
        $total=0;
        if(Session::has('user'))
        {
          $total=ecommercecontroller::cartcount(); 
        }
        ?>
        <a href="/addcartlist" style="text-decoration: none;">
          <i class="fas fa-shopping-cart" style="margin-right: 0px;"></i>
          <span class="badge badge-light">{{$total}}</span>
        </a>
      </div>
      
      <div class="card" style="margin-right:20px;">
        @if(Session::has('user'))
        <span >User::{{Session::get('user')['name']}}</span>
        @else
        {{Session::get('')}}   
        @endif
      </div>
      <form class="form-inline my-2 my-lg-0" action="/search" method="post">
        @csrf
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" style="max-width:150px;">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      
    </div>
  </nav>
  