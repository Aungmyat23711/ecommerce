<x-headeruser/>
<div class='container' style='padding:50px;top:0;'>
    <div class='row'>
        <div class='col-md-6'>
              <img src='{{asset("images/".$product["photo"])}}' width='250' height='320'><br><br>
        </div>
        <div class='col-md-6' style='padding-top:50px;left:0;'>
         <h2>{{$product['name']}}</h2>
         <h3>{{$product['type']}}</h3>
         <h4>{{$product['genre']}}</h4>
         <form action='/addtocart' method='post'>
         @csrf
            <input type='hidden' name='product_id' value='{{$product["id"]}}'>
            <button class='btn btn-danger' type='submit'>Buy now</button>
         </form>   
         
        </div>
    </div>
</div>
<div>
<div class='' style='overflow:hidden;'>
    
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style='background:#117a8b;'>
  <div class="carousel-inner">
      @foreach($pdt as $ite)
    <div class="carousel-item {{$ite->id==1? 'active':''}}">
      <a href='{{$ite->id}}' >
      <img src="{{asset('images/'.$ite->photo)}}" alt="{{$ite->type}}" width='250' height='320'>
      <div class="carousel-caption d-none d-md-block " style='color:#545b62'>
    <h1>{{$ite->name}}</h1>
    <p>{{$ite->genre}}</p>
  </div>
    </div>
</a>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>
</div>


