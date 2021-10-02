@extends('ecommerce/user/master')
@section('content')
<div class="container my-3" style="padding-top:100px;">
    
     <div class="row">
        <div class="col-md-12">
             <form action="/loginfor" method="post">
                @csrf
                 <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" class="form-control" name="name">
                 </div>
                 <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password">
                 </div>
                 <button type="submit" class="btn btn-info">login</button>
             </form>
        </div>
     </div>
</div>
@endsection