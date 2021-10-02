<x-headeruser/>
<div class='container'>
    @foreach($product as $item)
     <div class='row'>
          <div class='col-md-4'>
             <img src="{{asset('images/'.$item->photo)}}" width='150' height='220'><br><br>
          </div>
          <div class='col-md-4 '>
              <h4 style='padding-top:50px;'>
             Name:  {{$item->name}}<br>
            Genre: {{$item->genre}}<br>
             Type:{{$item->type}}<br></h4>
          </div>
          <div class='col-md-4'>
              <div style='padding-top:50px'>
            <a href='removecart/{{$item->cart_id}}' class='btn btn-info' style='text-decoration:none;color:white;'>Remove Cart</a>
          </div>
</div>
     </div>
     @endforeach
     <a href='ordernow' class='btn btn-danger' >Order Now</a>
</div>