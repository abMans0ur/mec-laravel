<a href="{{ route('user.create') }}">Add</a>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Avatar</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Category</th>
        <th colspan="3">Action</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td><img src="{{ $user->avatar }}" alt="{{ $user->name }}" lazyload width="200" height="200"></td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->category }}</td>
            <td>view {{ $user->id }}</td>
            <td>update {{ $user->id }}</td>
            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                @csrf
                @method('delete')
                <td><button type="submit">Delete</button></td>
            </form>
        </tr>
    @endforeach
</table>
