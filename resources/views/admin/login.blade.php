<x-header/>
<body>
<div class='container'>
<div class='row'>
    <div class='col-md-6 offset-md-3'>
          <form action='/addlogin' method='post'>
          @csrf
                <div class='form-group'>
                     <label>Name</label>
                     <input type='text' name='name' class='form-control'>
                </div>
                <div class='form-group'>
                     <label>Email</label>
                     <input type='text' name='email' class='form-control'>
                </div>
                <div class='form-group'>
                     <label>Password</label>
                     <input type='password' name='password' class='form-control'>
                </div>
                <div class='form-group'>
                     <button type='submit' name='btn' class='btn btn-success'>Login</button>
                </div>
          </form>
    </div>
</div>
</div>
</body>