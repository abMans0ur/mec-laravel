<div>
<form action="{{route('product.store')}}" method="post">
    @csrf
    <input type="text" name="name" id="" placeholder="Product Name">
    <input type="number" name="price" id="" placeholder="Product price">
    <input type="text" name="description" id="" placeholder="Product description">
    <input type="number" name="stock" id="" placeholder="Product stock">
    <input type="number" name="discount" placeholder="product Discount">
    <select name="category_id" id="">
        @foreach($categories as $row)
        <option value="{{$row->id}}">{{$row->name}}</option>
        @endforeach
    </select>
    <button type="submit">Add product</button>

</form>
</div>
