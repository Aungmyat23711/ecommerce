<!DOCTYPE html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<x-header/>

<div class='container'>
     <div class='row'>  
         <div class='col-md-6'>
             @if($errors->any())
             @foreach($errors as $error)
             <script>window.alert('{{$error}}')</script>
             @endforeach
             @endif
          <form action='/update' method='post' enctype='multipart/form-data'>
           @csrf
           @foreach($data as $item)
                    <div class='form-group'>
                        <label>Name</label>
                        <input type='text' name='name' class='form-control' value='{{$item->name}}'>
                        <input type='hidden' name='id' class='form-control' value='{{$item->id}}'>
                    </div>
                    <div class='form-group'>
                        <label>Type</label>
                        <select class='form-control' name='type'>
                            <?php 
                             $connection=mysqli_connect('localhost','root','','series');
                             $query="select * from types";
                             $go_query=mysqli_query($connection,$query);
                             while($out=mysqli_fetch_array($go_query))
                             {
                                 $type=$out['name'];
                                 echo "<option value='{$type}'>{$type}</option>";
                             }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="photo" placeholder="Choose image" id="image" class='form-control'><br> 
                        <table style='border:none;'>
                            <tr>
                                <td><img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                        alt="New Image" style="max-height: 250px;"></td>
                        <td width='50'></td>
                        <td><img src='{{asset("images/$item->photo")}}' alt='Old Image' style='max-height:250px;'></td>
                            </tr> 
                            <tr>
                               <td align='center'>New Image</td>
                               <td></td>
                               <td align='center'>Old Image</td> 
                            </tr>   
                        </table>                       
                    </div>
                    
          
         </div>
         <div class='col-md-6'>
              <div class='form-group'>
                  <label>Genre</label>
                  <input type='text' name='genre' class='form-control' value='{{$item->genre}}'>
              </div>
              <div class='form-group'>
                  <label>Link</label>
                  <input type='text' name='link' class='form-control' value='{{$item->link}}'>
              </div>
              <div class="form-group">
                      <label>Quantity</label>
                      <input type='text' name='qty' class='form-control'>
                  </div> 
                  <div class="form-group">
                      <label>Price</label>
                      <input type='text' name='price' class='form-control'>
                  </div> 
              <div class='form-group'>
                  <button class='btn btn-danger' type='submit' name='updatebtn'>Update</button>
                  
              </div>
            
         </div>
        </form>
         @endforeach
        
   </div>     
</div>
<script type='text/javascript'>
     $('#image').change(function(){
         let reader=new FileReader();
         reader.onload = (e) =>{
             $('#preview-image').attr('src',e.target.result);
         }
         reader.readAsDataURL(this.files[0]);
     });
    </script>
</body>
</html>