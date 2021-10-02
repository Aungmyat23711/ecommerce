@extends('/ecommerce/user/master')
@section('content')
<div class="container-fluid my-1" style="padding-top: 80px;">
    <div class="row" style="border: 1px solid white;">
        @foreach ($product as $item)
        <div class="col-md-4" style="padding-left:100px;padding-top:50px; ">
              <img src="{{asset('image/'.$item->photo)}}" style="max-height: 120px;" class="img-fluid">
        </div>
        <div class="col-md-4" style="padding-left:50px; padding-top:50px;">
            <span class="badge badge-info">{{$item->category}}</span>
            <h1>{{$item->product}}</h1>
            <h3>{{$item->price}} KS</h3>
            <h5>QTY <span class="text-info">{{$item->cartqty}}</span></h5>
            {{-- <p>qty - {{$item->qty}}</p> --}}
      </div>
      <div class="col-md-4" style="padding-left:100px; ">
        <a href='/removeaddcart/{{$item->cart_id}}'><button class="btn btn-danger" style="margin-top:90px;">Remove</button></a>
  </div>
        @endforeach
    </div>
    
</div>
<div align='start' style="padding-left: 50px; margin-bottom:30px;">
       <button class="btn btn-danger"><a href="/addordernow" style="text-decoration: none;color:white;">Order Now</a></button>
       <button class="btn btn-success"><a href="/userinterface" style="text-decoration: none;color:white;">Go Shop</a></button>
    </div>
@endsection