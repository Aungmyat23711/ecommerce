<!doctype html>
<head>
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
$("#edit").click(function(){
  $("#hide").toggle();
});
  });

</script>
</head>
<body>
 
<x-header/>
<div class='container'>
  <?php
  session_start();
  if(empty($_SESSION['message']))
  {
    $message= $_SESSION['message']='';
  }else{
    $message= $_SESSION['message'];
  }
  ?>
  <div class='row'>
       <div class='col-md-6 offset-md-3'>
         <div class='card'>
         <h2 class='text-danger text-center'>{{$message}}</h2>
        </div>
       </div>
  </div>
</div><br>
    <div class='container'>
          <div class='row'>
              
               <div class='col-md-6'>
                     
                            <form action='typeadd' method='post'>
                                @csrf
                              <div class='form-group'>
                                <label>Type</label>
                                <input type='text' name='type' class='form-control'>
                              </div>
                              <div class='form-group'>
                                <button type='submit' class='btn btn-danger' name='addtype'>ADD</button>
                              </div> 
                            </form>
                     
               </div>

               
         
               <div class='col-md-6'>
               <table class='table table-striped'>
                 <tr>
                     <td>ID</td>
                     <td>Name</td>
                     <td>Action</td>
                 </tr>
                @foreach($data as $item)
                <tr>
                  <td>{{$item['id']}}</td>
                  <td>{{$item['name']}}</td>
                  <td>
                    <a href="deleted/{{$item['id']}}"><i class='fas fa-trash'></i></a> || 
                    <a href="edited/{{$item['id']}}"><i class='fas fa-edit'></i></a>
                  </td>
                </tr> 
                @endforeach                
                </table>
               </div>
         </div>
    </div>

</body>
<script>
  
</script>
</html>
            