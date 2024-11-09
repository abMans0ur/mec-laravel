<a href="{{ route('user.index') }}">Home</a>
<form action="{{ route('user.store') }}" method="post">
    @csrf
    <input type="text" placeholder="name" name="name">
    <input type="email" placeholder="email" name="email">
    <input type="tel" placeholder="phone" name="phone">
    <input type="password" placeholder="password" name="password">
    <input type="password" placeholder="password" name="password_confirmation">
    <select name="category" id="">
        <option value="admin">Admin</option>
        <option value="client">Client</option>
        <option value="merchant">Merchant</option>
    </select>
    <button type="submit">Add User</button>
</form>
