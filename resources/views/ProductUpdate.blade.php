<form action="{{ route('product.update', $product->id) }}" method="post">
    @csrf
    @method('put')
    <input type="text" name="name" id="" value="{{ $product->name }}" placeholder="Product Name">
    <input type="number" name="price" id="" placeholder="Product price" value="{{ $product->price }}">
    <input type="text" name="description" id="" placeholder="Product description"
        value="{{ $product->description }}">
    <input type="number" name="stock" id="" placeholder="Product stock" value="{{ $product->stock }}">
    <input type="number" name="discount" id="" placeholder="Product discount"
        value="{{ $product->discount }}">
    <select name="category_id" id="">
        @foreach ($categories as $row)
            <option value="{{ $row->id }}" @if ($row->id == $product->category_id) selected @endif>{{ $row->name }}
            </option>
        @endforeach
    </select>
    <button type="submit">update product</button>
</form>
@if($errors->isNotEmpty())
    {{ $errors }}
@endif
