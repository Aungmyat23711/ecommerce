<x-headeruser/>
<div class='container '>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style='background:#117a8b;'>
  <div class="carousel-inner">
      @foreach($data as $ite)
    <div class="carousel-item {{$ite->id==1? 'active':''}}">
      <a href='detail/{{$ite->id}}' >
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
@foreach($data as $ite)
<div class='container'>
<div style='float:left;padding:50px;'>
<a href='detail/{{$ite->id}}'>
<img src="{{asset('images/'.$ite->photo)}}" width='250' height='320'>
</a>
</div>
</div>
@endforeach

