@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Học vấn</title>
    <link rel="stylesheet" href="{{ asset('page/css/style.css') }}">
</head>
<body>
  <div class="container">
    <div class="nav">
      <span>CONTACT</span>
      <span>EXPERIENCE</span>
      <span class="active">EDUCATION</span>
      <span>ABOUT</span>
      <span>FINISH IT</span>
    </div>

    <h2>Please enter your education information</h2>
    <p>Enter your last diploma first.</p>

    <form action="{{ route('education.store') }}" method="POST">
        @csrf
        <label>School</label>
    <input type="text" name="school" placeholder="Vietnam National University">

    <label>Degree</label>
    <select name="degree">
      <option value="">Select degree</option>
      <option value="Bachelor">Bachelor</option>
      <option value="Master">Master</option>
      <option value="PhD">PhD</option>
      <option value="Diploma">Diploma</option>
    </select>

    <label>Graduation Date</label>
    <input type="date" name="grad_date">

    <label>City</label>
    <input type="text" name="city" placeholder="Hanoi">

    <label>Description</label>
    <textarea name="description" placeholder="Graduated with a Bachelor of Science in Computer Science, specializing in software development."></textarea>


    <button type="button" class="back-btn" onclick="history.back()">← Back</button>
    <button type="submit" class="btn">Next to About →</button>

  </form>
</div>
</body>
</html>
@endsection