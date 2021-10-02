<x-headeruser/>
<body style='background:#007bff80;color:#0062cc;'>
<div class='container'>
    <div class='row'>
          <div class='col-md-6 offset-md-3'>
               @if($errors->any())
               @foreach($errors->all() as $error)
                <script>window.alert('{{$error}}')</script>
               @endforeach
               @endif
                    <form action='/register' method='post'>
                    @csrf
                          <div class='form-group'>
                               <label>Name</label>
                               <input type='text' name='name' class='form-control'>
                          </div>
                          <div class='form-group'>
                               <label>Password</label>
                               <input type='password' name='password' class='form-control'>
                          </div>
                          <div class='form-group'>
                               <label>Confirm_Password</label>
                               <input type='password' name='confirm_password' class='form-control'>
                          </div>
                          <div class='form-group'>
                               <label>Email</label>
                               <input type='text' name='email' class='form-control'>
                          </div>
                          <div class='form-group'>
                               <button class='btn btn-success' name='btn' type='submit'>ADD</button>
                          </div>
                    </form>
                </div>
          
    </div>
</div>
</body>