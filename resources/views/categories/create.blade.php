<form action="{{route('category.store')}}" method="post">
    @csrf
    <label for="cate">Name</label>
    <input type="text" name="catName" id="cate">
    <button type="submit">Add</button>
</form>