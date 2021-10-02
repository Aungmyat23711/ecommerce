<x-header/>
<div class='col-md-6 offset-md-3'>
    
    <form action='/updated' method='POST'>
        @csrf
        @foreach($data as $some)
        <input type='hidden' name='id' value="{{$some->id}}">
        
      <div class='form-group'>
        <label>Type</label>
        <input type='text' name='type' class='form-control' value="{{$some->name}}">
      </div>
     @endforeach 
      <div class='form-group'>
        <button type='submit' class='btn btn-danger' name='updatebtn'>Update</button>      
      </div> 
      
    </form>

</div>
</div>