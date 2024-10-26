<div>
    <a href="{{route('product.create')}}">Add Product</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Cat Name</th>
            <th>Price</th>
            <th colspan="2">Actions</th>
        </tr>
        @foreach ($products as $item):
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->category->name}}</td>
            <td>{{$item->price}}</td>
            <td><a href="{{route('product.edit',$item->id)}}">Update</a></td>
          <td>

              <form action="{{route('product.delete',$item->id)}}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit">Delete</button>
                </form>    
            </td>
        
        </tr>
        @endforeach
    </table>
</div>
