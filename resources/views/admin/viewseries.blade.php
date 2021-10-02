<x-header/>
    <div class='container'>
    <div class='row'>
    <div class='col-md-12'>
        <table class='table table-striped'>
        <tr>
                <td colspan='7' align='right'><a href='series'><button class='btn btn-success'>GO ADD</button></a></td>
            </tr>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Type</td>
                <td>Image</td>
                <td>Genre</td>
                <td>Link</td>
                <td>Qty</td>
                <td>Price</td>
                <td>Action</td>
            </tr>
            @foreach($data as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['type']}}</td>
                <td>
                    <img src="{{asset('images/'.$item->photo)}}" width='100' height='150'>
                </td>
                <td>{{$item['genre']}}</td>
                <td>{{$item['link']}}</td>
                <td>{{$item['qty']}}</td>
                <td>{{$item['price']}}</td>
                <td><a href='delete/{{$item["id"]}}'><i class='fas fa-trash'></i></a> || 
                    <a href='edit/{{$item["id"]}}'><i class='fas fa-edit'></i></a>
            </td>
            </tr>
            @endforeach
        </table>
    </div>
    </div>
    </div>
</div>