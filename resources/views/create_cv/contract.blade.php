@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ</title>
    <link rel="stylesheet" href="{{ asset('page/css/style.css') }}">
</head>
<body>
  <div class="container">
    <div class="nav">
      <span class="active">CONTACT</span>
      <span>EXPERIENCE</span>
      <span>EDUCATION</span>
      <span>ABOUT</span>
      <span>FINISH IT</span>
    </div>

    <h2>Please enter your contact info</h2>
      <form action="{{ route('contract.store') }}" method="POST">
          @csrf
          <label>First Name (Mandatory)</label>
      <input type="text" name="first_name"  placeholder=" Nguyen">

      <label>Last Name (Mandatory)</label>
      <input type="text" name="last_name"  placeholder=" Thi Minh">

      <label>City</label>
      <input type="text" name="city"  placeholder=" Hanoi">

      <label>Postal Code</label>
      <input type="text" name="postal_code"  placeholder=" 100000">

      <label>Phone</label>
      <input type="text" name="phone"  placeholder=" +84 24 1234 5678">

      <label>Email (Mandatory)</label>
      <input type="email" name="email" placeholder=" example@email.com">


      
    <button type="submit" class="btn">Next to Experience</button>
    </form>
</div>
</body>
</html>
@endsection