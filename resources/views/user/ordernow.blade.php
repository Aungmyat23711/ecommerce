<x-headeruser/>
<div class='container'>
      <div class='row'>
            <div class='col-md-6 offset-md-3'>
                  <table class='table'>
                        <tr>
                  <th scope='col'>Amount </th>
                  <td scope='col'>${{$total}}  </td>
</tr>
<tr>
      <th scope='col'>Tax</th>
      <td scope='col'>$0</td>
</tr>
<tr>
<th scope='col'>Delivery</th>
      <td scope='col'>$10</td>
</tr>
<tr>
<th scope='col'>Total Amount</th>
      <td scope='col'>${{$total+10}}</td>
</tr>
<form action='/orderplace' method='post'>
@csrf
<tr>
   <th scope='col'><input type='radio' name='payment' value='cash'>Online Payment</th>
</tr>
<tr>
   <th scope='col'><input type='radio' name='payment' value='cash'>EMI Payment</th>
</tr>
<tr>
   <th scope='col'><input type='radio' name='payment' value='cash'>Payment on delivery</th>
</tr>
<tr><th><textarea name='address' placeholder='Please Enter Your Address'></textarea></th></tr>
<tr><td></td><td><button class='btn btn-primary' name='submit'>Submit Order</button></td></tr>
</form>
                  </table>
            </div>
      </div>
</div>