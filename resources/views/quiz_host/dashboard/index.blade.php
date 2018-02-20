<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>Quiz Host - Dashboard</title>
    </head>
<body>
<h4>Welcome back, {{ Auth::user()->username }}</h4>
<strong>Account details</strong>
<ul>
    <li>Username: {{ Auth::user()->username }}</li>
    <li>Email: {{ Auth::user()->email }}</li>
    <li>Sign up date: {{ Auth::user()->created_at }}</li>
</ul>
    <form action="{{ route('logout') }}" method="post">
        {{ csrf_field() }}
        <input type="submit" name="submit" value="Logout"/>
    </form>
</body>
</html>