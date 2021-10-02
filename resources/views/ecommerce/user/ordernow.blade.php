@extends('ecommerce/user/master')
@section('content')
<div class="container" style="padding-top:150px;">
     <div class="row">
         <div class="col-md-6">
             <table class="table striped">
                 <thead>
                     <tr align="right">
                         <td><h5>Category</h5></td>
                         <td><h5>Product</h5></td>
                         <td><h5>Price Per Item</h5></td>
                         <td><h5>Quantity</h5></td>
                         <td><h5>Total Price</h5></td>
                         
                     </tr>
                     
                         @foreach ($product as $ite)
                         <tr>
                           <td align="end"><h6>{{$ite->category}}</h6></td>
                           <td align="end"><h6>{{$ite->product}}</h6></td>
                           <td align="end"><h6>{{$ite->price}} KS</h6></td>
                           <td align="end"><h6>{{$ite->cartqty}}</h6></td>
                           <td align="end"><h6>{{$ite->price*$ite->cartqty}}</h6></td>
                         </tr>
                         @endforeach
                 </thead>
                 <thead>
                     <tr class="bg-white" >
                         <td colspan="2"><h5>Total Amount</h5></td>
                         <td  align="end">
                             @foreach ($total as $item)
                                 <h5>{{$item->total}} KS</h5>
                             @endforeach
                             
                            </td>
                     </tr>
                 </thead>
             </table>
         </div>
         <div class="col-md-6">
           <form action="/addorderplace" method="post">
            @csrf
            <h3>Payment Method</h3>
            <input type="radio" name="cash" value="online-payment">
            <label for="online">Online Payment</label>
            <br>
            <input type="radio" name="cash" value="emi-payment">
            <label for="emi">Emi Payment</label>
            <br>
            <input type="radio" name="cash" value="payment-on-delivery">
            <label for="delivery">Payment On Delivery</label><br>
            <label for="address">Address</label>
            <textarea name="address"></textarea>
          <button class="btn btn-success" type="submit" style="margin-top:50px;">submit order</button>  
        </form>
         </div>
     </div>
</div>
@endsection