<x-headeruser/>
<div class='container'>
    @foreach($order as $item)
     <div class='row'>
          <div class='col-md-4'>
             <img src="{{asset('images/'.$item->photo)}}" width='150' height='220'><br><br>
          </div>
          <div class='col-md-4 '>
              <h4 style='padding-top:50px;'>
             Name:  {{$item->name}}<br>
            Status: {{$item->status}}<br>
             Address:{{$item->address}}<br>
             payment_status:{{$item->payment_status}}<br>
             payment_method:{{$item->payment_method}}<br>
            </h4>
          </div>
          <div class='col-md-4'>
              <div style='padding-top:50px'>
            <a href='cancleorder/{$item->orderId}' class='btn btn-info' style='text-decoration:none;color:white;'>Cancle order</a>
          </div>
</div>
     </div>
     @endforeach
     <a href='/clearhistory' class='btn btn-danger' >Cancle all order</a>
</div>