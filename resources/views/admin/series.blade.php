<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Image Upload with Preview Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
</head>
<body>
    <x-header/>
   @if($errors->any())
   @foreach($errors->all() as $error)
   <script>window.alert('{{$error}}')</script>
   @endforeach
   @endif
    <div class='container'>
        <form method="POST" enctype="multipart/form-data"  action="/addseries" >
         @csrf                 
            <div class="row">
                <div class="col-md-6">
                  <div class='form-group'>
                    <label>Name</label>
                    <input type='text' name='name' class='form-control' >
                  </div>
                  <div class='form-group'>
                    <label>Type</label>
                    <select name='type' class='form-control'>
                      <?php
                       $connection=mysqli_connect('localhost','root','','series');
                       $query='select * from types';
                       $go_query=mysqli_query($connection,$query);
                       while($out=mysqli_fetch_array($go_query))
                       {
                         $name=$out['name'];
                         echo "<option value={$name}>{$name}</option>";
                       }
                      ?>
                    </select>
                  </div>
                    <div class="form-group">                     
                        <input type="file" name="photo" placeholder="Choose image" id="image" class='form-control'><br>
                        <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                        alt="preview image" style="max-height: 250px;">
                    </div>
                   
                </div>

                <div class='col-md-6'>
                  <div class="form-group">
                      <label>Genre</label>
                      <input type='text' name='genre' class='form-control'>
                  </div>
                  <div class="form-group">
                      <label>Link</label>
                      <input type='text' name='link' class='form-control'>
                  </div> 
                  <div class="form-group">
                      <label>Quantity</label>
                      <input type='text' name='qty' class='form-control'>
                  </div> 
                  <div class="form-group">
                      <label>Price</label>
                      <input type='text' name='price' class='form-control'>
                  </div> 
                   <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                  
               
            </div>     
        </form>
  <script type="text/javascript">
    $('#image').change(function(){
           
    let reader = new FileReader();
    reader.onload = (e) => { 
      $('#preview-image').attr('src', e.target.result); 
    }
    reader.readAsDataURL(this.files[0]); 
  
   });
  </script>
</div>    
</body>
</html>