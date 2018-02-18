<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>Quiz Host - Dashboard</title>
    </head>
<body>
    <form action="{{ route('logout') }}" method="post">
        {{ csrf_field() }}
        <input type="submit" name="submit" value="Logout"/>
    </form>
</body>
</html>