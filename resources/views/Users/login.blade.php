<form action="{{route('login')}}" method="post">
    @csrf
    <input type="email" name="email" id="">
    <input type="password" name="password" id="">
    <button type="submit">Log in</button>
</form>