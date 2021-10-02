@extends('ecommerce/user/master')
@section('content')
<div class="container-fluid my-1" style="padding-top: 80px;">
    <div class="row" style="border: 1px solid white;">
        @foreach ($order as $item)
        <div class="col-md-4" style="padding-left:100px;padding-top:50px; ">
              <img src="{{asset('image/'.$item->photo)}}" style="max-height: 120px;" class="img-fluid">
        </div>
        <div class="col-md-4" style="padding-left:50px; padding-top:50px;">
            <span class="badge badge-info">{{$item->category}}</span>
            <h6><span style="color: rgb(136, 214, 240);">Name::   </span>{{$item->product}} KS</h6>
            <h6><span class="badge badge-warning">Status::   </span>{{$item->user_status}}</h6>
            <h6><span style="color: rgb(136, 214, 240);">Qty:: </span>{{$item->cart_qty}}</h3>
          </div> 
          <div class="col-md-4" style="padding-left:100px;padding-top:50px; ">    
            <h6><span style="color:  rgb(136, 214, 240);">Address::   </span>{{$item->address}}</h6>
            <h6><span style="color:  rgb(136, 214, 240);">Payment_status::   </span>{{$item->payment_status}}</h6>
            <h6><span style="color:  rgb(136, 214, 240);">Payment_method::   </span>{{$item->payment_method}}</h6>
         </div> 
        @endforeach
        <button><a href="/removelist">Clear History</a></button>
    </div>   
</div>
@endsection