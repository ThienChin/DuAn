<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>@yield('title','Lab 02')</title>
  <style>body{font-family:system-ui;margin:24px}</style>
</head>
<body>
  <nav style="margin-bottom:16px">
    <a href="{{ route('products.index') }}">Products</a>
    @auth
      | <a href="{{ route('products.create') }}">Create</a>
      | <form action="{{ route('logout') }}" method="POST" style="display:inline">@csrf<button type="submit">Logout</button></form>
      <span> ({{ auth()->user()->name }})</span>
    @else
      | <a href="{{ route('login') }}">Login</a>
      | <a href="{{ route('register') }}">Register</a>
    @endauth
  </nav>
  @if(session('success'))<div style="color:green">{{ session('success') }}</div>@endif
  @yield('content')
</body>
</html>
