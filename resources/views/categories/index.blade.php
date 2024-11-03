<a href="{{route('category.create')}}">Add Category</a>
<a href="{{route('product.index')}}">Show Products</a>
<table border="1" width='100%'>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th colspan="2">Action</th>
    </tr>
    @foreach($categories as $data)
    <tr>
        <td>{{$data->id}}</td>
        <td>{{$data->name}}</td>
        <td><a href="{{route('category.edit',$data->id)}}">Edit</a></td>
        <td><form action="{{route('category.delete',$data->id)}}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Delete</button>    
        </form></td>
    </tr>
    @endforeach
</table>