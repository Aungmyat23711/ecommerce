<x-headeruser/>
@if($errors->any())
@foreach($errors->all() as $error)
<script>window.alert('{{$error}}')</script>
@endforeach
@endif
<div class='container'>
      <div class='row'>
            <div class='col-md-6 offset-md-3'>
                  <form action='/loguser' method='post'>
                      @csrf
                      <div class='form-group'>
                             <label>Name</label>
                              <input type='text' name='username' class='form-control'>
                         </div>
                         <div class='form-group'>
                             <label>Email</label>
                              <input type='text' name='useremail' class='form-control'>
                         </div>
                         <div class='form-group'>
                             <label>Password</label>
                              <input type='password' name='password' class='form-control'>
                         </div>
                         <button type='submit' class='btn btn-danger'>Login</button>
                  </form>
            </div>
      <div>
</div>