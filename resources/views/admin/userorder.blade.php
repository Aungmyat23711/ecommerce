<x-header/>
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
             <br></h4>
          </div>
          <div class='col-md-4'>
              <div style='padding-top:50px'>
            <a href='approve' class='btn btn-danger' >Approve</a>
          </div>
</div>
     </div>
     @endforeach
     
</div>