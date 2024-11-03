<form action="{{route('category.update',$category->id)}}" method="post">
    @method('PUT')    
    @csrf
    <label for="">Name</label>
    <input type="text" name="catName" value="{{$category->name}}" id="">
    <button type="submit">Update</button>
</form>