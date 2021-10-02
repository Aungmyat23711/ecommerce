@extends('ecommerce/user/master')
@section('content')
<div class="container my-2" style="padding-top: 100px;">
    <h1 class="list" onclick="openpanel()"><i class="fas fa-list"></i></h1>
    <div class="sidepanel" id="showpanel">
        <h3 class="hoverli" onclick="closepanel()"><i class="fas fa-times"></i></h3><br>
       <ul style="text-decoration: none;list-style:none;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <ul>
                <li><a href="/userinterface">all</a></li>
              @foreach ($category as $cat)
                  
                      
                      <li><a href="/filter/{{$cat->id}}">{{$cat->category}}</a></li>
                       @endforeach
                  </ul>
             
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Something</a>
        </li>
       </ul>
    </div>
    <div class="row" >
        @foreach ($product as $item)
        <div class="col-sm-3" style="margin-bottom: 10px;">
            <div class="card">
                <div class="card-header">
                    <img src="{{asset('image/'.$item->photo)}}" style="height:150px;" class="img-fluid">
                </div>
                <div class="card-body">
                    <span><p>{{$item->category}}</p></span>
                    <h5>{{$item->product}}</h5>
                    <h5>{{$item->price}}</h5>
                    <span class="badge">{{$item->qty}} Units</span>
                    <form action="/addcart" method="post">
                        @csrf
                      <input type="number" class="shownum" name="qty" value="1" min="1" max="{{$item->qty}}">
                      <label for="qty">Qty</label>
                </div>
                <div class="card-footer">
                    <div class="justify-content-center" style="padding-left:60px;">
                            <input type="hidden" name="product_id" value="{{$item->id}}">
                            <button class="btn-sm btn-success" type="submit">add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
         @endforeach 
    </div>   
</div>
<span class="nav justify-content-center sticky-bottom">{{$product->links()}}</span> <br><br>
@endsection
<style>
    .sidepanel{
        width: 0px;
  position: fixed;
  z-index: 1;
  height: 250px;
  top: 0;
  left: 0;
  background-color: rgb(176, 226, 160);
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 10px;
  margin-top: 55px;
    }
    .list{
        position:fixed;
        z-index: 1;
        top: 0;
        left: 10px;
        padding-top:60px;
    }
    .list:hover{
        color: rgb(173, 211, 245);
    }
    .hoverli:hover{
        color:red; 
        text-decoration: none;
    }
    .hoverli{
      margin-left: 100px;
      top: 0;
      position: absolute;
    }
    .w-5{
        display: none;
        
    }
    .nav div{
        margin: 10px;
    }
    .pl-2, .px-2 {
    padding-left: 0.5rem !important;
    display: none;
}
input, select, optgroup, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    max-width: 50px;
}
.navbar{
       background-color: rgb(176, 219, 74);
   }
   .navbar-brand{
       color: rgb(178, 185, 77)
   }
   .nav-link{
       color: rgb(68, 88, 88);
   }
   .nav-link:hover{
       color: lemonchiffon;
   }
</style>
<script>
    function openpanel()
    {
        document.getElementById('showpanel').style.width='200px';
    }
    function closepanel()
    {
        document.getElementById('showpanel').style.width='0'
    }
   
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
      
</script>