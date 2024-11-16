@extends('MainView')
{{-- @content --}}
@section('content')
    
<div>
    <a href="{{route('product.create')}}">Add Product</a>
    <a href="{{route('category.index')}}">Show Categorise</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th colspan="2">Actions</th>
        </tr>
        @foreach ($products as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->category->name}}</td>
            @if($item->is_discount)
            <td>
                <del>{{$item->price}}</del>
                {{((100-$item->discount)*$item->price)/100}}
            </td>
            @else
            <td>{{$item->price}}</td>
            @endif
            <td>{{$item->stock}} @if($item->stock<5)
            ⚠⚠
            @endif
            </td>
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
@endsection
