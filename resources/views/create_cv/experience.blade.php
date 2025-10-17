@extends('layouts.main')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kinh nghiệm</title>
    <link rel="stylesheet" href="{{ asset('page/css/style.css') }}">
</head>
<body>
  <div class="container">
    <div class="nav">
      <span>CONTACT</span>
      <span class="active">EXPERIENCE</span>
      <span>EDUCATION</span>
      <span>ABOUT</span>
      <span>FINISH IT</span>
    </div>

    <h2>Tell us about your experience</h2>
    <p>Start with your recent job.</p>


    <form action="{{ route('experience.store') }}" method="POST">
        @csrf
      <label>Job Title (Mandatory)</label>
        <input type="text" name="job_title" placeholder="Software Engineer">

        <label>Employer</label>
        <input type="text" name="employer" placeholder="FPT Corporation">

        <label>Start Date</label>
        <input type="date" name="start_date" >

        <label>End Date</label>
        <input type="date" name="end_date" >

        <label>City</label>
        <input type="text" name="city" placeholder="Ho Chi Minh City">

        <label>Description</label>
        <textarea name="description" placeholder="Worked as lead developer on several major projects, contributing to the overall success of the company."></textarea>

      <button type="button" class="back-btn" onclick="history.back()">← Back</button>
        <button type="submit" class="btn">Next to Education →</button>
      </form>
</div>
</body>
</html>
@endsection